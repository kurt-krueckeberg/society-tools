# Society Tools

## Setup

  * clone the repository using git
  * download the zipped version and unzip

Build the class autoloader from the command line:

`composer dump-autoload`

Include `vendor/autoload.php` as in those described below.

## Example Code Descriptions

* create-csv.php - The input is `list-of-members.txt`, a protected file created from the PDF file of members available on the ACGSI website.
It outputs a .CSV of member data that consists of four comma separated fields:
  
  * name
  * address
  * city state and zip
  * member's email

* build-email-arrays.php - demonstrates the use the EmailKeyedMemberData class. It takes the .CSV file created above and creates a map whose
key is the email and whose value is an array consisting of:
  * zipcode
  * locality (city, state and zip)
  * name 
  * address
 
* create-zoom-data.php - Builds the array of data for the Apexcharts like acgsi.html in the subdir apex-charts/. Not yet complete 
