# Society Tools

Tools for getting statistics on Zoom attendance. Things like: 

* member vs non-member
* If in Allen county, are member or non member
* zipcode of all member attendees.

## Setup

  * clone the repository using git
  * download the zipped version and unzip

Build the class autoloader from the command line:

`composer dump-autoload`

Include `vendor/autoload.php` as in those described below.

## Example Code Description

These PHP files call the `SocietyTools` code in `/src` and are building blocks for the `create-zoom-data.php`, which is not fully complete and tested.

* create-csv.php - The input is `list-of-members.txt`, a protected file created from the PDF file of members available on the ACGSI website.
It outputs a .CSV of member data that consists of four comma separated fields:
  
  * name
  * address
  * city state and zip
  * member's email

* build-email-arrays.php - demonstrates the use the `EmailKeyedMemberData` class. It takes the .CSV file created above and creates a map whose
key is the email and whose value is an array consisting of:

  * zipcode
  * locality (city, state and zip)
  * name 
  * address
 
* create-zoom-data.php - Builds the array of input data for the free, open-source Apexcharts javascript libary, which is used in [acgsi.html](apex-charts/acgsi.html)
in the subdir [apex-charts/](apex-charts/). The code is not yet complete.
