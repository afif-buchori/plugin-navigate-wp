<?php
function renderInputNumber($name, $value, $min = 0, $max = 9999)
{
    echo '<div class="custom-number-input flex flex-row rounded-lg relative bg-transparent mt-1 ">
        <button data-action="decrement" class="bg-gray-light4/60 text-primary/90 hover:bg-gray-light w-20 rounded-l-lg cursor-pointer outline-none">
            <span class="m-auto text-2xl font-thin">−</span>
        </button>
        <input type="number" name="' . $name . '" min="' . $min . '" max="' . $max . '" readonly class="outline-none focus:outline-none bg-gray-light4/60 border-none py-2 w-full font-numbers font-medium text-center text-primary/90 text-sm placeholder-gray-400 flex" value="' . $value . '"/>
        <button data-action="increment" class="bg-gray-light4/60 text-primary/90 hover:bg-gray-light w-20 rounded-r-lg cursor-pointer">
            <span class="m-auto text-2xl font-thin">+</span>
        </button>
    </div>';
}

function renderSelect($name, $value, $min = 0, $max = 9999, $withZero = true, $attr = "")
{
    $html = '<select name="' . $name . '" class="rounded-lg outline-none focus:outline-none bg-gray-light4/60 border-none py-2 w-full font-numbers font-medium text-center text-primary/90 text-sm placeholder-gray-400 flex" ' . $attr . '>';
    if ($min < 0) $i = 0;
    if ($min > 0 && $withZero)
        $html .= '<option value="0">Not selected</option>';
    for ($i = $min; $i <= $max; $i++) {
        $html .= '<option value="' . $i . '" ' . ($value === $i ? 'selected' : '') . '>' . ($i <= 0 ? "Not selected" : $i) . '</option>';
    }
    $html .= '</select>';
    echo $html;
}

function renderInputReadonly($name, $value)
{
    $html = '<input type="number" name="' . $name . '" readonly class="outline-none focus:outline-none bg-gray-light4/60 border-none py-2 w-full font-numbers font-medium text-center text-primary/90 text-sm placeholder-gray-400 flex" value="' . $value . '"/>';
    echo $html;
}
