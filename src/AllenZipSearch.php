<?php
declare(strict_types=1);
namespace Vocab;

class AllenZipSearch { 

   private static $allenzips= array(46704,46706,46723,46733,46741,46743,46745,46748,46765,46773,46774,46777,46783,46788,46797,46798,46802,46803,46804,46805,46806,46807,46808,46809,46814,46815,46816,46818,46819,46825,46835,46845);

   private $functor;

   private function binary_search(mixed $key)
   {
     $lo = 0;  
     $hi = count(self::$allenzips) - 1; 
  
      while ($lo <= $hi) {
  
          $mid = $lo + (int) (($hi - $lo) / 2);

          $cmp = ($this->functor)(self::$allenzips[$mid], $key);
  
          if ($cmp < 0)             

              $lo = $mid + 1;
  
          elseif ($cmp > 0)

              $hi = $mid - 1;
  
          else 
              return $mid; 
          
      }
      return -1;
   }

   public function __construct(callable $cmp)
   {
      $this->functor = $cmp;
   }

   public function __invoke(string $key) : int
   {
      return $this->binary_search($key); 
   }
}  
