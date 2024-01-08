<?php
declare(strict_types=1);
namespace SocietyTools;

class EmailKeyedMemberDataBuilder {

    private bool $is_sorted;
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
   //private static$zipcode_regex = '/(\d{5})(?:-|(?:-\d{4}))?\s*$/';
   private static$regex = '/([^,]+),\s*([A-Z]{2,})\s+(\d{5})(?:-|(?:-\d{4}))?\s*$/';

   // Maps member's email to an array whose keys are: 'zip', 'city' and 'state'
   private $members = array();
  
   // Sorted array of member emails that are the keys of $this->members.
   private $member_emails = array();

   public function __construct()
   {
   }

   private function extract_zip(string $locality) : array
   {
      $results = array();

      $matches = array();
      
      $rc = preg_match(self::$regex, $locality, $matches);

      if ($rc === false)
        throw new \LogicException("The regular expression failed. Check this locality for a missing zipcode: $locality.\n");
      
      $results['city']  = isset($matches[1]) ? $matches[1] : 'city unknown';
      $results['state'] = isset($matches[2]) ? $matches[2] : 'state unknown';
      $results['zip']   = isset($matches[3]) ? $matches[3] : 'zip unknown';

      return $results;
   }

   public function __invoke(array $arr)
   {
       $results = $this->extract_zip( $arr[2] );

       $a = array('zip' => $results['zip'], 'city' => $results['city'], 'state' => $results['state']);

       // $arr[3] is the member's email. 
       $this->members[$arr[3]] = $a; 
   }

   public function get_sorted_emails() : array
   {
      if (count($this->member_emails) == 0) {

         $emails = array_keys($this->members);

         sort($emails);

         $this->member_emails = $emails;
      }  

      return $this->member_emails;
   }  

   public function get_member_array() : array
   {
      return $this->members;
   }  
}
