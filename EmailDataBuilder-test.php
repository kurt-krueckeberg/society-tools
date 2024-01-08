<?php
declare(strict_types=1);
use SocietyTools\{EmailDataBuilder};

include "vendor/autoload.php";

if ($argc != 2)
   die("Enter the .csv file build using MemberListBuilder.\n");

$csvname = $argv[1]; // "csv-member-list.csv";

$file = new SplFileObject($csvname, "r");

$file->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

$ebuilder = new EmailDataBuilder();

$cnt = 0;

foreach ($file as $no => $arr) {

     echo "Line no: $no.\n";
     $ebuilder($arr);  
}

print_r($ebuilder->get_sorted_emails());

echo "----------------------------\n";

print_r($ebuilder->get_member_list());

$ebuilder->get_member_list();
