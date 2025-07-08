<?php

function capital_city_from(mixed $state)
{
    $states = [
        'Oregon' => 'OR',
        'Alabama' => 'AL',
        'New Jersey' => 'NJ',
        'Colorado' => 'CO',
    ];

    $capitals = [
        'OR' => 'Salem',
        'AL' => 'Montgomery',
        'NJ' => 'trenton',
        'KS' => 'Topeka',
    ];

    reset($states);
    reset($capitals);

    while(key($states) != null)
    {
        $key = key($states);
        $value = current($states);
        if ($key == $state)
        {
            $capital = current($capitals);
            echo($capital);
            echo("\n");
            return ;
        }
        next($capitals);
        next($states);
    }
    echo("Unknown");
    echo("\n");
}

?>