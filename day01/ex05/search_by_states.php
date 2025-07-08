<?php

function search_by_states(mixed $array)
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
    $result = array();
    $tmp = explode(",", $array, PHP_INT_MAX);
    $i = 0;
    $found = false;

    while($i < count($tmp))
    {
        while(key($states) != null)
        {
            if (trim($tmp[$i]) == trim(key($states)))
            {
                if (current($states) == key($capitals))
                {
                    $short = trim(current($capitals));
                    $result[] = "$short is the capital of : $tmp[$i]";
                    $found = true;
                    next($result);
                }
            }
            else if (trim($tmp[$i]) == trim(current($capitals)))
            {
                if (current($states) == key($capitals))
                {
                    $short2 = trim(key($states));
                    $state = trim($tmp[$i]);
                    $result[] = "$state is the capital of : $short2";
                    $found = true;
                    next($result);
                }
            }
            next($states);
            next($capitals);
        }
        reset($states);
        reset($capitals);

        if (!$found)
        {
            $short3 = trim($tmp[$i]);
            $result[] = "$short3 is neither a capital or a state";
        }

        $found = false;

        $i++;
    }
    return $result;
}

?>