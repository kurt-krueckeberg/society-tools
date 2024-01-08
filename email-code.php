<?php
declare(strict_types=1);

$csvname = "csv-member-list.csv";

$file = new SplFileObject($csvname, "r");

$file->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

$ebuilder = new EmailListBuilder();

foreach ($file as $arr)
     $ebuilder($arr);  

print_r($ebuilder->get_sorted_emails());

echo "----------------------------\n";

print_r($ebuilder->get_member_list());
$ebuilder->get_member_list();
