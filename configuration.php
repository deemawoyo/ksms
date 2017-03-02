<?php
/************************************************************
* @author Delight Mawoyo
*
* Contains basic site configuration used for connecting to the database, school name etc.
*************************************************************/
//security is amust in EVERY PAGE !
require_once("php/session.php");
require_once("php/users.php");
require_once("php/security.php");




//start session



class Config{
 public $school_name= "Founders High School";
 public $school_motto= "Hinc-Orior"; 
 public $school_address = "14 St Martins Avenue NorthEnd";
 
 public $db_host="localhost";
 public $db_name="school";
 public $db_user="root";
 public $db_password="";
 
 public $year= 0;
 public $term=1;
 
 public $version="1.0.0 Alpha B. Release 3 ";
 public $licensed=false;
 
 public $tracker;
 
 public $last_backup=0;//timestamp
 

 public $max_form=6; //number of forms at that school (1-6)

public function printOptionForms(){
print "<option>Select </option>\n";
for($x = 1 ; $x <= $this->max_form ; $x++ )
print "<option value='$x'>$x</option>\n"; 

}

//Detects the curent school term using months
function termDetect(){
$curr_term = date('m');
//now check term
//assuming terms are 3 months long and holidays are one month each
if( $curr_term <= 4 ){
$this->term = 1;
}else if( $curr_term <= 8 ){

$this->term = 2;
}else{
$this->term = 3;
}
return $this->term; 
}

public function __construct(){
$this->year = date("Y");
//detect term
$this->termDetect();
$this->tracker = intval( "{$this->year}{$this->term}" );
if(! defined("CURRENT_TRACKER") )
define( 'CURRENT_TRACKER' , $this->tracker );



}
};

//format money for displaying
function formatMoney($number, $fractional=true) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 




global $config;
$config= new Config();

//THe following defines are for fpdf

define('RELATIVE_PATH','php/');
define('FPDF_FONTPATH','php/font/');
//start session
global $sess;
$sess = new Session( );

require_once('php/configreader.php');

//now we need to connect to get config values




?>