<?php
declare(strict_types=1);
use SocietyTools\{EmailKeyedMemberDataBuilder,BinarySearch,CreateMemberCSVFile, AllenZipSearch};

include "vendor/autoload.php";

//include "src/binary_search.php";
include "config.php";

function is_allen_county(int $zip) : bool
{
// sorted static array of Allen county zip codes.
static $allenzips= array(46704,46706,46723,46733,46741,46743,46745,46748,46765,46773,46774,46777,46783,46788,46797,46798,46802,46803,46804,46805,46806,46807,46808,46809,46814,46815,46816,46818,46819,46825,46835,46845);
 
   $index = binary_search($allenzips, $zip, function(int $left, int $right) { // closure returns: -1. 0 or 1.
       if ($left == $right)
           return 0;      
       else if ($left < $right)
           return -1;
       else 1;
        });

   return ($index === -1) ? false : true;
}

function create_member_csv(string $memberfileName, string $outputcsvName)
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

function build_arrays(string $csvFile)
{
  $csvfile = new SplFileObject($csvFile, "r");

  $csvfile->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

  $builder = new EmailKeyedMemberDataBuilder();

  foreach ($csvfile as $no => $arr)
     $builder($arr);  

  return $builder;
}


if (file_exists($config['member-list']) === false)
  create_member_csv($config['member-csv'], $csvName);

$built_arrays = build_arrays($config['member-csv']);

$member_array = $built_arrays->get_member_array();

$sored_member_emails = $built_arrays->get_sorted_emails();

// Next section of code.
$member_zipcodes = array();

$members = $non_members = 0;

$comparator = function(string $left, string $right) { return strcmp($left, $right); };

$zoomcsv = new SplFileObject("./zoom-csv/sept-data.csv", "r");

$zoomcsv->setFlags(\SplFileObject::READ_CSV| \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);

$allen_county_cnt = 0;

$email_index = 2;

$non_member_cnt = 0;

$cmp = function (int $left, int $right) { // closure returns: -1. 0 or 1.
       if ($left == $right)
           return 0;      
       else if ($left < $right)
           return -1;
       else 1;
        };

$is_allen_county = new AllenZipSearch($cmp);

foreach ($zoomcsv as $zoom_arr) { // Read zoom file.

   $email = $zoom_arr[$email_index];

   // Are they a ACGSI member?    
   $email_finder = new BinarySearch($ebuilder->get_sorted_emails(), $cmp);

   $index = $email_finder($email);

   if ($index == -1) { // Viewer was not an ACGSI member 

       ++$non_member_cnt;

   } else { // Store ACGSI memeber's zip code in $member_zipcodes

      $member_zipcodes[] = $member_array[$email]['zip'];
     
      // note those in allen county 
      if ($is_allen_county((int) $member_array[$email]['zip']))
 
          ++$allen_county_cnt;
   }
}

