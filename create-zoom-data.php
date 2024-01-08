<?php
declare(strict_types=1);
use SocietyTools\{EmailKeyedMemberDataBuilder,BinarySearch};

include "vendor/autoload.php";
include "src/binary_search.php";

function is_allen_count($zip) : bool
{
// sorted static array of Allen county zip codes.
static $allenzips= array(46704,46706,46723,46733,46741,46743,46745,46748,46765,46773,46774,46777,46783,46788,46797,46798,46802,46803,46804,46805,46806,46807,46808,46809,46814,46815,46816,46818,46819,46825,46835,46845);
 
   $index = binary_search($allenzips, $zip, function(int $left, int $right) {
       if ($left == $right)
           return 0;      
       else if ($left < $right)
           return -1;
       else 1;
        });

   return ($index === -1) ? false : true;
}


$csvfile = new SplFileObject("member-list.csv", "r");

$csvfile->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

$ebuilder = new EmailKeyedMemberDataBuilder();

foreach ($csvfile as $no => $arr) $ebuilder($arr);  

$member_array = $ebuilder->get_member_array();

$member_zipcodes = array();

$members = $non_members = 0;

$comparator = function(string $left, string $right) { return strcmp($left, $right); };

$csvfile = new SplFileObject($zoom_csv, "r");

$csvfile->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

foreach ($file as $zoom_arr) { // Read zoom file.

   $email = $zoom_arr[$email_index];

   // Are they a ACGSI member?    
   $index = binary_search($ebuilder->get_sorted_emails(), $email, $comparator);

   if ($index == -1) { // Viewer was not an ACGSI member 

       ++$non_member;

   } else { // Store ACGSI memeber's zip code in $member_zipcodes

      $member_zipcodes[] = $member_array[$email]['zipcode'];
     
      // note those in allen county 
      if (is_allen_county($member_array[$email]['zipcode'])
 
          $allen_county[] = $member_array[$email]['zipcode']; 
   }
}

