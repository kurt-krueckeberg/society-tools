<?php
decclare(strict_types=1);

function binary_search(array $a, string $key, callable $comparator)
{
   $lo = 0;  
   $hi = count($a) - 1; 

    while ($lo <= $hi) {

        $mid = $lo + (int)(($hi - $lo) / 2);
   
        $cmp = $comparator($a[$mid], $key);

        if ($cmp < 0)             
            $lo = $mid + 1;

        elseif ($cmp > 0) 
            $hi = $mid - 1;

        else 
            return $mid;
        
    }
    return -1;
}
