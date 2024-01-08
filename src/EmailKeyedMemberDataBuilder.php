<?php
declare(strict_types=1);
namespace SocietyTools;

class EmailKeyedMemberDataBuilder {

/*
Regex meaning. See https://regex101.com:
--------------------------
1st Capturing Group (\d{5})
  \d matches a digit (equivalent to [0-9])
  {5} matches the previous token exactly 5 times
Non-capturing group (?:-|(?:-\d{4}))?
? matches the previous token between zero and one times, as many times as possible, giving back as needed (greedy)
  1st Alternative -
  - matches the character - with index 4510 (2D16 or 558) literally (case sensitive)
  2nd Alternative (?:-\d{4})
    Non-capturing group (?:-\d{4})
    - matches the character - with index 4510 (2D16 or 558) literally (case sensitive)
      \d matches a digit (equivalent to [0-9])
     {4} matches the previous token exactly 4 times
\s matches any whitespace character (equivalent to [\r\n\t\f\v ])
  * matches the previous token between zero and unlimited times, as many times as possible, giving back as needed (greedy)
$ asserts position at the end of a line
-----------------------
*/
   private static$zipcode_regex = '/(\d{5})(?:-|(?:-\d{4}))?\s*$/';

   // Member data. Array key is their email.
   private $members = array();

   public function __construct()
   {
   }

   private function extract_zip(string $locality) : string
   {
      $matches = array();
      
      $rc = preg_match(self::$zipcode_regex, $locality, $matches);

      if ($rc === false)
        throw new \LogicException("The regular expression failed. Check this locality for a missing zipcode: $locality.\n");
      
      $zipcode = ($rc === 1) ? $matches[1] : '00000'; // No zipcode implies perhaps non-US address? We use '00000'.
          
      return $zipcode;
   }

   public function __invoke(array $arr)
   {
       $zipcode = $this->extract_zip( $arr[2] );

       $a = array('zipcode' => $zipcode, 'locality' => $arr[2], 'name' => $arr[0], 'address' => $arr[1]);

       $this->members[$arr[3]] = $a; 
   }

   public function get_sorted_emails() : array
   {
      $emails = array_keys($this->members);

      sort($emails);

      return $emails;
   }  

   public function get_member_array() : array
   {
      return $this->members;
   }  
}
