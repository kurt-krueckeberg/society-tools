<?php
declare(strict_types=1);
use SocietyTools\{CreateMemberCSVFile};

include "vendor/autoload.php";

if ($argc != 2)
   die("Enter the member list that is the expected format.\n");

$builder = new CreateMemberCSVFile($argv[1]);

//$input = "list-of-members.txt";

$in = new SplFileObject("list-of-members.txt", "r");

$in->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

foreach($in as $line) {

       echo "Input: $line\n.";

       $builder($line);
}

echo $argv[1] . " created.\n"; 
