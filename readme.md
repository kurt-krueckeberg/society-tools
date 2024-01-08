# Society Tools

Either:

  * clone the repository using git
  * download the zipped version and unzip

Build the class autoloader:

`composer dump-autoload'

* create-csv.php - creates a .CSV of member data with four fields:
  * name
  * address
  * city state and zip
  * member's email

* build-email-arrays.php - takes the .CSV file and use the email as the key that maps to an array consisting of the member's:
  * 'zip' 'locality' => $arr[2], 'name' => $arr[0], 'address' => $arr[1]);
  
