<?php

function style()
{
    return '<link rel="stylesheet" type="text/css" href="' . plugins_url('/contents/style.css', __FILE__) . '">';
}

function script()
{
    return '<script src="' . plugins_url('/contents/script.js', __FILE__) . '" defer></script>';
}
function huhu($datas)
{
    $style = style();
    $script = script();
    $cek = $style . $script . '
    <div>
    <ul>
    ';
    foreach ($datas as $key => $value) {
        $cek .= '
            <li class="font-bold testing-font">' . $value . '</li>
        ';
    }
    '
    </ul>
    </div>';
    return $cek;
}