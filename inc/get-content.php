<?php

function enx_get_global_page()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['old_post_data'] = ConvertToString($_POST);
    } else {
        if (!isset($_SESSION['old_post_data'])) {
            define('OLD', null);
            define('ERROR_DATA', null);
        } else {
            define('OLD', $_SESSION['old_post_data']);
            define('ERROR_DATA', $_SESSION['error_post_data']);
            unset($_SESSION['old_post_data']);
            unset($_SESSION['error_post_data']);
        }
    }
    $url = explode("/", substr(explode("?", $_SERVER['REQUEST_URI'])[0], 1));
    if ($url[0] == AIRPORT_SERVICE_LINK) {
        require_once(dirname(__FILE__) . '/../fasttrack/get-data.php');
        if ($url[1] == null) {
            require_once(dirname(__FILE__) . '/../fasttrack/fasttrack-list.php');
            $data = enx_get_list_data();
            $head_title = $data->meta->title;
        } elseif ($url[1] == 'postdata') {
            if ($url[2] == 'fd') {

                $url = API_FASTTRACK_URL . "/get/rate" . createParamsFromGet();
                $req = json_decode(json_encode($cart = [
                    'type' => AIRPORT_SERVICE_LINK,
                    'sid' => $_POST['sid'],
                    'date' => $_POST['date'],
                    'adult' => $_POST['adult'],
                    'child' => $_POST['child'],
                    'infant' => $_POST['infant'],
                    'location' => $_POST['location'],
                    'total' => $_POST['total'],
                ]));
                $data = fetchPost($url, $req);
                if ($data->error) {
                    unset($_SESSION[NAVIGATE_CART]);
                    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?errormessage=' . $data->message . '&type=' . $data->type);
                    exit;
                }

                if ($_SERVER['REQUEST_METHOD'] != 'POST') exit();
                $cart = [
                    'type' => AIRPORT_SERVICE_LINK,
                    'sid' => $_POST['sid'],
                    'date' => $_POST['date'],
                    'adult' => $_POST['adult'],
                    'child' => $_POST['child'],
                    'infant' => $_POST['infant'],
                    'location' => $_POST['location'],
                    'total' => $_POST['total'],
                ];
                $data = ['main_service' => $cart];
                $_SESSION[NAVIGATE_CART] = $data;
                $isHaveAddon = enx_service_have_addon($_POST['sid']);
                if ($isHaveAddon > 0)
                    header('Location: /' . AIRPORT_SERVICE_LINK . '/addon');
                else
                    header('Location: /' . AIRPORT_SERVICE_LINK . '/checkout');

                exit();
            } else if ($url[2] == 'addon') {
                if ($_SERVER['REQUEST_METHOD'] != 'POST') exit();
                $cartSession = json_decode(json_encode($_SESSION[NAVIGATE_CART]), true);
                if (!$cartSession)
                    header('Location: /' . AIRPORT_SERVICE_LINK);

                $selectedService = json_decode(html_entity_decode(stripslashes($_POST['selected_service'])), true);

                $cartSession['addons'] = $selectedService;
                $_SESSION[NAVIGATE_CART] = $cartSession;

                header('Location: /' . AIRPORT_SERVICE_LINK . '/checkout');
            } else if ($url[2] == 'checkout') {
                if ($_SERVER['REQUEST_METHOD'] != 'POST') exit();
                $cartSession = json_decode(json_encode($_SESSION[NAVIGATE_CART]), true);
                if (!$cartSession)
                    header('Location: /' . AIRPORT_SERVICE_LINK);

                $selectedService = json_decode(html_entity_decode(stripslashes($_POST['selected_service'])), true);

                enx_post_checkout($_POST);
            }
            exit();
        } elseif ($url[1] == 'addon') {
            require_once(dirname(__FILE__) . '/../fasttrack/addon.php');
            $head_title = "Additional Service";
            $cartSession = json_decode(json_encode($_SESSION[NAVIGATE_CART]));
            if (!$cartSession)
                header('Location: /' . AIRPORT_SERVICE_LINK);
            else
                $data = enx_service_get_addon($cartSession->main_service->sid);
        } elseif ($url[1] == 'checkout') {
            require_once(dirname(__FILE__) . '/../fasttrack/checkout.php');
            $head_title = "Checkout";
            $cartSession = json_decode(json_encode($_SESSION[NAVIGATE_CART]));
            if (!$cartSession)
                header('Location: /' . AIRPORT_SERVICE_LINK);
        } elseif ($url[1] == 'payment') {
            if ($url[2] == 'success') {
                $head_title = "Payment Success";
                require_once(dirname(__FILE__) . '/../fasttrack/order-success.php');
            }
        } elseif ($url[1] == 'upload') {
            $head_title = "Upload Documents";
            require_once(dirname(__FILE__) . '/../fasttrack/upload-documents.php');
        } else {
            require_once(dirname(__FILE__) . '/../fasttrack/fasttrack-detail.php');
            $data = enx_get_detail_data();
            $data_meta = $data->meta;
        }
    }
    $content = enx_get_page_content($data ?? null);
    enx_get_content($head_title ?? $data_meta->title, $content, $data_meta ?? null);
}

function enx_post_checkout($post)
{
    $cartdata = json_decode(json_encode($_SESSION[NAVIGATE_CART]));
    $cart = $cartdata->main_service;
    $addons = $cartdata->addons ?? null;
    $data = $post;
    $data['addons'] = $addons;
    $data['cart'] = $cart;
    $data['client_data'] = [
        'host_http' => get_bloginfo('url'),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'client_ip' => getClientIp(),
    ];

    $url = API_FASTTRACK_URL . "/post/checkout";
// print_r($url);
// echo "\n\r";
// print_r(json_encode($data));
// exit;
    $res = fetchPost($url, $data);
    // print_r(json_encode($res));
    // exit;
    if ($res->message == 'success' && ($res->url ?? null) != null) {
        unset($_SESSION[NAVIGATE_CART]);
        header('Location: ' . $res->url);
    } else {
        $_SESSION['error_post_data'] = ConvertToString($res->message ?? null);

        header('Location: /' . AIRPORT_SERVICE_LINK . '/checkout');
    }
}

function enx_get_content($header_title, $content, $meta = null)
{
    $url = explode("/", substr(explode("?", $_SERVER['REQUEST_URI'])[0], 1));
    // if ($url[0] === AIRPORT_SERVICE_LINK) {
    //     if ($url[1] == 'addon') $header_title = 'Additional Service';
    //     else if ($url[1] == 'checkout') $header_title = 'Checkout';
    //     else $header_title = $data_meta->title;
    // }
    // if ($url[0] === TRIPGO_LINK) {
    //     $header_title = $data_meta->title;
    // }

    enx_header($header_title . " – " . get_bloginfo('name'), $meta->keyword ?? "", $meta->description ?? "", $meta->image_url ?? "");
?>
    <main id="primary" class="site-main">
        <article id="tripgo-list" <?php post_class(); ?>>
            <header class="entry-header">
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php echo $content ?>
            </div><!-- .entry-content -->

            <footer class="entry-footer">
                <span class="edit-link"></span>
            </footer><!-- .entry-footer -->
        </article>
    </main>
<?php
    get_footer();
}
