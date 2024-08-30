<?php
/*
Plugin Name: Navigate ID
Plugin URI: https://navigate.id/plugins
Description: A plugin that fetches data from an API and displays it on a page.
Version: 0.5
Author: navigate.id
Author URI: https://navigate.id
*/

// This code is executed when the plugin is activated.

require_once (dirname(__FILE__) . '/inc/define.php');

function my_api_plugin_activate()
{
  global $wpdb;
  $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}tripgo_api`  (
        `id` int NOT NULL AUTO_INCREMENT,
        `api_key` varchar(255) NOT NULL,
        `secret_key` varchar(255) NOT NULL,
        `settings` text NULL,
        PRIMARY KEY (`id`)
      );";

  $wpdb->query($sql);
}
register_activation_hook(__FILE__, 'my_api_plugin_activate');

// This code is executed when the plugin is deactivated.
function my_api_plugin_deactivate()
{
  global $wpdb;
  $sql = "DROP TABLE IF EXISTS `{$wpdb->prefix}tripgo_api`;";
  $wpdb->query($sql);
}
register_deactivation_hook(__FILE__, 'my_api_plugin_deactivate');

function register_my_session()
{
  if (!session_id()) {
    session_start();
  }
}
add_action('init', 'register_my_session');

function enx_get_tripgo_api_settings()
{
  global $wpdb;

  $sql = "SELECT * FROM `{$wpdb->prefix}tripgo_api` LIMIT 1;";
  $result = $wpdb->get_row($sql);

  return $result;
}

function enx_update_tripgo_api_settings($apikey, $secret, $setting = null)
{
  global $wpdb;
  $getdata = enx_get_tripgo_api_settings();
  if ($getdata) {
    $sql = "UPDATE `{$wpdb->prefix}tripgo_api` SET 
    `api_key` = '$apikey',
    `secret_key` = '$secret'";
    if ($setting)
      $sql .= ", `settings` = '{$setting}'";
    $sql .= " WHERE id = '{$getdata->id}';";
  } else {
    $sql = "INSERT INTO `{$wpdb->prefix}tripgo_api` (`api_key`, `secret_key`) VALUES ('$apikey', '$secret');";
  }
  $result = $wpdb->query($sql);
}

function enx_plugin_setup_menu()
{
  add_menu_page('Tripgo API Settings', 'Tripgo API', 'manage_options', 'tripgo-api-setting', 'admin_tripgo_init');
}
add_action('admin_menu', 'enx_plugin_setup_menu');

function admin_tripgo_init()
{
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    enx_update_tripgo_api_settings($_POST['api_key'], $_POST['secret_key']);
  }
  $setting = enx_get_tripgo_api_settings();
  require_once (dirname(__FILE__) . '/inc/dashboard.php');
  enx_admin_dashboard($setting);
}


function generate_404_tripgo_somehow()
{
  $url = explode("/", substr(explode("?", $_SERVER['REQUEST_URI'])[0], 1));
  if ($url[0] === NAVIGATE_LINK || $url[0] === TRIPGO_LINK || $url[0] === AIRPORT_SERVICE_LINK || $url[0] === ACTIVITY_LINK) {
    global $wp_query;
    $wp_query->is_404 = false;
    $wp_query->is_page = true;
    status_header(200);
  }
}
add_action('wp', 'generate_404_tripgo_somehow');

function change_template_tripgo($original_template)
{
  global $wp_query;

  $url = explode("/", substr(explode("?", $_SERVER['REQUEST_URI'])[0], 1));


  if ($url[0] == NAVIGATE_LINK) {
    if ($_GET['currency']) {
      setcookie(CURRENCY_COOKIE, $_GET['currency'], time() + (86400 * 365), "/"); // 86400 = 1 day

      if ($_SERVER['HTTP_REFERER'])
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      else
        header('Location: /');
    }
    exit();
  } else if ($url[0] === TRIPGO_LINK || $url[0] === AIRPORT_SERVICE_LINK || $url[0] === ACTIVITY_LINK) {

    add_filter('wp_enqueue_scripts', 'enx_load_style_and_script', 99);

    return dirname(__FILE__) . '/page.php';
  } else if ($url[0] == 'api' && $url[1] == 'fasttrack') {
    $wp_query->is_404 = false;
    $wp_query->is_page = true;
    status_header(200);

    require_once (dirname(__FILE__) . '/inc/function.php');
    require_once (dirname(__FILE__) . '/fasttrack/api.php');
    $data = enx_get_data_api();

    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
  } else if ($url[0] == 'api' && $url[1] == 'activity') {
    $wp_query->is_404 = false;
    $wp_query->is_page = true;
    status_header(200);

    require_once (dirname(__FILE__) . '/inc/function.php');
    require_once (dirname(__FILE__) . '/activity/api.php');
    $data = enx_get_data_api();
    // var_dump("TESDS");

    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
  } else {
    return $original_template;
  }
}
add_filter('template_include', 'change_template_tripgo');

function enx_load_style_and_script()
{
  wp_enqueue_style('font-awesome', plugins_url('/assets/css/fontawesome.min.css', __FILE__), array(), '6.4.2');
  wp_enqueue_style('font-awesome-solid', plugins_url('/assets/css/solid.min.css', __FILE__), array(), '6.4.2');
  wp_enqueue_style('font-awesome-brands', plugins_url('/assets/css/brands.min.css', __FILE__), array(), '6.4.2');
  wp_enqueue_style('tripgo-main', plugins_url('/assets/css/main.css', __FILE__), array(), VERSION);

  wp_enqueue_script('tripgo-iconify', plugins_url('/assets/js/iconify.min.js', __FILE__), array(), VERSION, true);
  wp_enqueue_script('tripgo-magnific', plugins_url('/assets/js/jquery.magnific-popup.min.js', __FILE__), array(), VERSION, true);
  wp_enqueue_script('tripgo-main', plugins_url('/assets/js/main.js', __FILE__), array(), VERSION, true);
  wp_enqueue_script('tripgo-alpinejs', plugins_url('/assets/js/alpinejs.min.js', __FILE__), array(), VERSION, true);
  wp_enqueue_script('tripgo-fasttrack', plugins_url('/assets/js/fasttrack.js', __FILE__), array(), VERSION, true);
  wp_enqueue_script('activity-js', plugins_url('/assets/js/activity.js', __FILE__), array(), VERSION, true);

  wp_enqueue_style('select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css');
  wp_enqueue_script('jquery');
  wp_enqueue_script('select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js', array('jquery'), null, true);
}

function myplugin_add_css_to_head()
{
  ?>
  <style type="text/css" media="screen">
    :root {
      --color-text-primary: 52, 78, 65 !important;
      --color-text-secondary: 218, 215, 205 !important;
      --color-primary: 52, 78, 65 !important;
      --color-secondary: 218, 215, 205 !important;
      --swiper-theme-color: #344e41 !important;
      --swiper-navigation-size: 40px !important;
    }

    .enx-container .enx-description * {
      --tw-text-opacity: 1 !important;
      color: rgba(var(--color-text-primary), var(--tw-text-opacity)) !important;
    }

    .enx-container .text-primary {
      --tw-text-opacity: 1 !important;
      color: rgba(var(--color-text-primary), var(--tw-text-opacity)) !important;
    }

    .enx-container .text-secondary {
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-secondary), var(--tw-text-opacity)) !important;
    }

    .enx-container .text-primary\/60 {
      color: rgba(var(--color-text-primary), 0.6) !important;
    }

    .enx-container .text-secondary {
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-secondary), var(--tw-text-opacity)) !important;
    }

    .enx-container .text-primary\/80 {
      color: rgba(var(--color-text-primary), 0.8) !important;
    }

    .enx-container .text-primary\/70 {
      color: rgba(var(--color-text-primary), 0.7);
    }

    .enx-container .text-primary\/90 {
      color: rgba(var(--color-text-primary), 0.9) !important;
    }

    .enx-container .text-opacity-70 {
      --tw-text-opacity: 0.7 !important;
    }

    .enx-container .text-opacity-50 {
      --tw-text-opacity: 0.5 !important;
    }

    .enx-container .text-opacity-90 {
      --tw-text-opacity: 0.9 !important;
    }

    .enx-container .text-opacity-20 {
      --tw-text-opacity: 0.2 !important;
    }

    .enx-container .hide-primary {
      color: rgba(0, 0, 0, 0) !important;
      background-color: transparent !important;
    }

    .enx-container .bg-transparent {
      background-color: transparent !important;
    }

    .enx-container .hide-primary.text-primary\/90>option {
      color: rgba(var(--color-text-primary), 0.9) !important;
    }

    .enx-container .btn-primary {
      --tw-bg-opacity: 1;
      background-color: rgba(var(--color-primary), var(--tw-bg-opacity)) !important;
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-secondary), var(--tw-text-opacity)) !important;
      --tw-border-opacity: 1;
      border-width: 0;
    }

    .enx-container .btn-primary:hover {
      --tw-text-opacity: 1;
      color: rgba(var(--color-primary), var(--tw-text-opacity)) !important;
    }

    .enx-container .btn-secondary {
      --tw-bg-opacity: 1;
      background-color: rgba(var(--color-secondary), var(--tw-bg-opacity)) !important;
      --tw-text-opacity: 1;
      color: rgba(var(--color-primary), var(--tw-text-opacity)) !important;
    }

    .enx-container .btn-disable,
    .enx-container .btn-disable:hover {
      background-color: rgb(110, 110, 110) !important;
      color: white !important;
      cursor: default !important;
    }

    .enx-container .border-primary {
      --tw-border-opacity: 1;
      border-color: rgba(var(--color-primary), var(--tw-border-opacity)) !important;
    }

    .enx-container .border-secondary {
      --tw-border-opacity: 1;
      border-color: rgba(var(--color-secondary), var(--tw-border-opacity)) !important;
    }

    .enx-container .border-secondary\/30 {
      border-color: rgba(var(--color-secondary), 0.3) !important;
    }

    .enx-container .border-primary\/10 {
      border-color: rgba(var(--color-primary), 0.1) !important;
    }

    .enx-container .border-opacity-30 {
      --tw-border-opacity: 0.3 !important;
    }

    .enx-container .border-opacity-10 {
      --tw-border-opacity: 0.1 !important;
    }

    .enx-container .border-opacity-40 {
      --tw-border-opacity: 0.4 !important;
    }

    .enx-container .border-opacity-20 {
      --tw-border-opacity: 0.2 !important;
    }

    .enx-container .bg-primary {
      --tw-bg-opacity: 1;
      background-color: rgba(var(--color-primary), var(--tw-bg-opacity)) !important;
    }

    .enx-container .bg-primary\/10 {
      background-color: rgba(var(--color-primary), 0.1) !important;
    }

    .enx-container .bg-secondary {
      --tw-bg-opacity: 1;
      background-color: rgba(var(--color-secondary), var(--tw-bg-opacity)) !important;
    }

    .enx-container .bg-secondary\/90 {
      background-color: rgba(var(--color-secondary), 0.9) !important;
    }

    .enx-container .to-primary {
      --tw-gradient-to: rgb(var(--color-primary)) !important;
    }

    .enx-container .group:hover .group-hover\:bg-primary {
      --tw-bg-opacity: 1;
      background-color: rgba(var(--color-primary), var(--tw-bg-opacity)) !important;
    }

    .enx-container .group:hover .group-hover\:bg-secondary {
      --tw-bg-opacity: 1;
      background-color: rgba(var(--color-secondary), var(--tw-bg-opacity)) !important;
    }

    .enx-container .group:hover .group-hover\:bg-primary\/80 {
      background-color: rgba(var(--color-primary), 0.8) !important;
    }

    .enx-container .group:hover .group-hover\:text-secondary {
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-secondary), var(--tw-text-opacity)) !important;
    }

    .enx-container .group:hover .group-hover\:text-white {
      --tw-text-opacity: 1;
      color: rgba(255, 255, 255, var(--tw-text-opacity)) !important;
    }

    .enx-container .group:hover .group-hover\:text-primary {
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-primary), var(--tw-text-opacity)) !important;
    }

    .enx-container .group:hover .group-hover\:text-green {
      --tw-text-opacity: 1;
      color: rgba(88, 129, 87, var(--tw-text-opacity)) !important;
    }

    .enx-container .group:hover .group-hover\:text-green-light {
      --tw-text-opacity: 1;
      color: rgba(163, 177, 138, var(--tw-text-opacity)) !important;
    }

    .enx-container .hover\:text-primary:hover {
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-primary), var(--tw-text-opacity));
    }

    .enx-container .hover\:text-secondary:hover {
      --tw-text-opacity: 1;
      color: rgba(var(--color-text-secondary), var(--tw-text-opacity));
    }

    .enx-container h4 {
      font-size: 1em !important;
    }

    .enx-container .payment-type .types .input-payment-method:checked+.type,
    .enx-container .payment-type .types .type.selected {
      border-color: rgb(var(--color-primary)) !important;
      background: rgba(64, 179, 255, 0.1) !important;
    }

    .enx-container .payment-type .types .input-payment-method:checked+.type .logo,
    .enx-container .payment-type .types .type.selected .logo {
      color: rgb(var(--color-primary)) !important;
    }

    .enx-container .payment-type .types .input-payment-method:checked+.type::after,
    .enx-container .payment-type .types .type.selected::after {
      border: 2px solid rgb(var(--color-primary)) !important;
    }
  </style>
  <?php
}
add_action('wp_head', 'myplugin_add_css_to_head');

function initialize_654_select2()
{
  ?>
  <script>
    // jQuery(document).ready(function($) {
    //   $('#phone_code_select2').select2();

    //   $('#airline_arrival').select2();
    //   var codeAirlineArrival = $('#airline_arrival').find('option:selected').data('code');
    //   $('#label-arrival-for-code').html(codeAirlineArrival || "---");
    //   $('#airline_arrival').on('change', function() {
    //     const selectedOption = $(this).find('option:selected');
    //     console.log(selectedOption);
    //     const code = selectedOption.data('code');
    //     const val = code || "---";
    //     $('#label-arrival-for-code').html(val);
    //   });

    //   $('#airline_departure_select2').select2();
    //   var codeAirlineDeparture = $('#airline_departure_select2').find('option:selected').data('code');
    //     $('#label-departure-for-code').html(codeAirlineDeparture || "---");
    //   $('#airline_departure_select2').on('change', function() {
    //     const selectedOption = $(this).find('option:selected');
    //     const code = selectedOption.data('code');
    //     const val = code || "---";
    //     $('#label-departure-for-code').html(val);
    //   })

    //   $('#country_select2').select2();
    //   $('#country_select2').on('change', function() {
    //     const selectedOption = $(this).find('option:selected');
    //     const code = selectedOption.data('code');
    //     const codephone = "+" + code;
    //     if($('#phone_code_label').html() !== "-Code-") return;
    //     $('#phone_code_label').html(codephone);
    //     $('#phone_code_select2').val(code);
    //   });

    //   $('label[for="phone_code_select2"]').on('click', function() {
    //     $('#phone_code_select2').select2('open');
    //   });

    //   $("#phone_code_select2").on('change', function(e) {
    //     const val = e.target.value === "" ? "--Code--" : "+" + e.target.value;
    //     $('#phone_code_label').html(val);
    //   })

    //   var lastName = $('#firstname').val();
    //   var firstName = $('#lastname').val();
    //   $('#firstname').on('keyup', function () {
    //     firstName = $('#firstname').val();
    //     var fullName = firstName + ' ' + lastName;
    //     $('#adult_name_0').val(fullName);
    //   })
    //   $('#lastname').on('keyup', function () {
    //     lastName = $('#lastname').val();
    //     var fullName = firstName + ' ' + lastName;
    //     $('#adult_name_0').val(fullName);
    //   })

    //   $('#the-guest-book').change(function() {
    //       if ($('#the-guest-book').is(':checked')) {
    //           $('#adult_name_0').prop('readonly', true);
    //           var fullName = firstName + ' ' + lastName;
    //           $('#adult_name_0').val(fullName);
    //         } else {
    //           $('#adult_name_0').prop('readonly', false);
    //           $('#adult_name_0').val("");
    //       }
    //   });

    //   $('#submit-booking').on('click', function() {
    //     $('#loading-654').css("display", "flex");
    //   });

    // });
  </script>
  <?php
}
add_action('wp_footer', 'initialize_654_select2');
