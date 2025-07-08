<?php

function array2hash_sorted(mixed $array)
{
    $tmp = array();
    $i = 0;

    while ($i < count($array))
    {
        $name = $array[$i][1];
        $age = $array[$i][0];
        $tmp[$age] = $name;
        $i++;
    }
    krsort($tmp);
    return $tmp;
}

?>