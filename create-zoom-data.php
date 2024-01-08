<?php
declare(strict_types=1);
use SocietyTools\{EmailKeyedMemberDataBuilder,BinarySearch};

include "vendor/autoload.php";

if ($argc != 2)
   die("Enter the .csv file build using MemberListBuilder.\n");

$csvname = $argv[1]; // "csv-member-list.csv";

$file = new SplFileObject($csvname, "r");

$file->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

$ebuilder = new EmailKeyedMemberDataBuilder();

$cnt = 0;

foreach ($file as $no => $arr) 

     $ebuilder($arr);  

Echo "Printing the sorted emails:\n";

print_r($ebuilder->get_sorted_emails());

echo "----------------------------\n";

echo "Printing the member list array whose key is the member's email.\n";

$bsearch = new BinarySearch($ebuilder->get_sored_emails());

$member_array = $ebuilder->get_member_list();

$member_zipcodes = array();

$members = $non_members = 0;

function is_allen_count($zip) : bool
{

}

foreach ($file as $line) {

   $email = $line[??email_index];

   // Are they a ACGSI member?    
   $index = BinarySearch($email);

   if ($index == -1) { // not an ACGSI member 

       ++$non_member;

   } else {

      $member_zipcodes[] = $member_array[$email]['zipcode'];
     
      if (is_allen_county($member_array[$email]['zipcode'])
          $allen_county[] = $member_array[$email]['zipcode']; 
   }

}

