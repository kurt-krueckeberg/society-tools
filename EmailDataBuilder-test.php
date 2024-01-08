<?php
declare(strict_types=1);
use namespace SocietyTools\{EmailDataBuilder};

if ($argc != 2)
   die("Enter the CSV that has the list of members.\n";

$csvname = $argv[1]; // "csv-member-list.csv";

$file = new SplFileObject($csvname, "r");

$file->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

$ebuilder = new EmailDataBuilder();

foreach ($file as $arr)
     $ebuilder($arr);  

print_r($ebuilder->get_sorted_emails());

echo "----------------------------\n";

print_r($ebuilder->get_member_list());

$ebuilder->get_member_list();
