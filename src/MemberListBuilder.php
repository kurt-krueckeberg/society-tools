<?php
declare(strict_types=1);
namespace SocietyTools;

class MemberListBuilder {

   private \SplFileObject $out;

   private array $a;

   public function __construct(string $fname)
   {
      $this->out = new \SplFileObject($fname, "w");
   }

   public function __invoke(string $line) : void
   {     
      if (strpos($line, '----') === 0) {
         
         $str = implode(",", $this->a);
   
         $this->out->fwrite($str . "\n");
   
         unset($this->a);
         return; 
      }
      
      $this->a[] = '"' . trim($line) . '"';
   }   
}
