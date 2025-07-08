<?php

function array2hash(mixed $array)
{
    $tmp = array();
    $i = 0;
    while ($i < count($array))
    {
        $name = $array[$i][0];
        $age = $array[$i][1];
        $tmp[$age] = $name;
        $i++;
    }
    return $tmp;
}

?>