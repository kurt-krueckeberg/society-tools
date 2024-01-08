<?php
declare(strict_types=1);
use SocietyTools\{CreateMemberCSVFile};

include "vendor/autoload.php";

if ($argc != 2)
   die("Enter the member list that is the expected format.\n");

function create_member_csv(string $memberfileName, string $ouputcsvName)
{
  $builder = new CreateMemberCSVFile($outputcsvName);

  //$input = "list-of-members.txt";

  $in = new SplFileObject($memberfileName, "r");

  $in->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  foreach($in as $line) {

       echo "Input: $line\n.";

       $builder($line);
  }

  echo $outputcsvName . " created.\n"; 
}


