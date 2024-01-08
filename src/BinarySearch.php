#!/usr/bin/env php
<?php
declare(strict_types=1);
namespace SocietyTools;

class BinarySearch { // Enables binary search from Linux command line.

  private function binary_search(array $a, string $key, callable $comparator)
  {
     $lo = 0;  
     $hi = count($a) - 1; 
  
      while ($lo <= $hi) {
  
          $mid = $lo + (int) (($hi - $lo) / 2);
     
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

   /* 
     Below is a recursive version of binary search.
     Search for the first param in the range [$low, $end) of the 2nd param, a sorted array.

   private function bsearch(string $needle, array $haystack, int $low, int $high) : int
   {
      if ($high < $low) // We have examine all subarrays and haystack was not found. return -1
          return -1;
   
      // Calculate the middle index to divide the search 
      // space in half 
      $mid = $low + (int) (($high - $low) / 2); 
    
      // If the middle element is equal to needle, we have 
      // found the element, return its index 
      $rc = strcmp($haystack[$mid], $needle);
   
      if ($rc === 0) 
          return $mid; 
    
      // If the middle element is greater than needle, search 
      // in the left half of the array 
      if ($rc >= 1) 
          return $this->bsearch($needle, $haystack, $low, $mid - 1); 
    
      // Otherwise $rc <= 0 ... the middle element is less than needle, so 
      // search in the right half of the array. 
      return $this->bsearch($needle, $haystack, $mid + 1, $high); 
   }
   */
   
   public function __construct(array $emails)
   {
      $this->emails = $emails;
   }

   public function __invoke(string $email) : int
   {
      return $this->binary_search(self::$emails, $email, function(string $left, string $right) { return strcmp($left, $right);}); 
   }
}  
