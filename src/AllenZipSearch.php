<?php
declare(strict_types=1);
namespace SocietyTools;

class AllenZipSearch { 

   private static $allenzips= array(46704,46706,46723,46733,46741,46743,46745,46748,46765,46773,46774,46777,46783,46788,46797,46798,46802,46803,46804,46805,46806,46807,46808,46809,46814,46815,46816,46818,46819,46825,46835,46845);

   private $bsearch;

   public function __construct(callable $cmp)
   {
      $this->bsearch = new BinarySearch(self::$allenzips,  function(int $left, int $right) { // closure returns: -1. 0 or 1.
       if ($left == $right)
           return 0;      
       else if ($left < $right)
           return -1;
       else 1;
        });
   }

   public function __invoke(int $zipcode) : bool
   {
      return ($this->bsearch($zipcode) !== -1) ? true : false; 
   }
}  
