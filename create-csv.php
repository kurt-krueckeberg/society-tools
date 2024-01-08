<?php
declare(strict_types=1);
use SocietyTools\{MemberListBuilder};

include "vendor/autoload.php";

if ($argc != 2)
   die("Enter the member list that is the expected format.\n");

$builder = new MemberListBuilder($csvname);

$input = "list-of-members.txt";

$in = new SplFileObject($input, "r");

$in->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

foreach($in as $line) {

       echo "Input: $line\n.";

       $builder($line);
}

echo "list-of-members.txt created.\n";
