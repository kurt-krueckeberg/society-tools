#!/usr/bin/env php
<?php
declare(strict_types=1);
namespace Vocab;

class BinarySearch { // Enables binary search from Linux command line.

   private array | \ArrayIterator $a;
   private $comparator;

   private function binary_search(mixed $key)
   {
     $lo = 0;  
     $hi = count($this->a) - 1; 
  
      while ($lo <= $hi) {
  
          $mid = $lo + (int) (($hi - $lo) / 2);

          $cmp = ($this->comparator)($this->a[$mid], $key);
  
          if ($cmp < 0)             

              $lo = $mid + 1;
  
          elseif ($cmp > 0)

              $hi = $mid - 1;
  
          else 
              return $mid; 
          
      }
      return -1;
   }

   public function __construct(array | \ArrayAccess $arr, callable $cmp)
   {
      $this->a = $arr;

      $this->comparator = $cmp;
   }

   public function __invoke(string $key) : int
   {
      return $this->binary_search($key); 
   }
}  
