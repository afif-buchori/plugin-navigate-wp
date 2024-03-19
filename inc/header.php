<?php
function enx_get_header($buffer)
{
    $components = preg_split("/<body.*?>/", $buffer);
    $res = "";
    $res .= $components[0];
    $res .= enx_get_startBody_tag($buffer);
    $res .= $components[1];
    return $res;
}

function enx_get_startBody_tag($buffer)
{
    $start = strpos($buffer, "<body");
    $finish = strpos($buffer, ">", $start);
    $res = substr($buffer, $start, $finish - $start + 1);
    // $res = explode(">",$res[1],2)[0];
    return ($res);
}

function enx_header($title, $keyword = "", $description = "", $imageurl = "")
{
    ob_start();
?>
    <title><?php echo $title ?></title>
    <meta name="keyword" content="<?php echo $keyword ?>">
    <meta name="description" content="<?php echo $description ?>">
    <meta property="og:image" content="<?php echo $imageurl ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
<?php
    $newheader = ob_get_contents();
    ob_end_clean();

    ob_start();
    get_header();
    $wp_header = ob_get_contents();
    ob_end_clean();

    $wp_header = enx_get_header($wp_header);

    $wp_header = preg_replace('/<title.+?>/', $newheader, $wp_header);
    echo $wp_header;
}
