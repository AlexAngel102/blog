<?php

function myArrowFunc(int $num) : string
{

    $arrows = ['<', '>',];
    $arrowsString = '';
    if($num <= 0){
        return 'Number must be more than 0';
    }
    foreach ($arrows as $arrow){
        $arrowsString = $arrowsString.str_repeat($arrow, $num);
    }
    return($arrowsString);

}

echo myArrowFunc(10);