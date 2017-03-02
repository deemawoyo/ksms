<?php
require_once('../configuration.php');
require_once('../php/database.php');
require_once('../php/student.php');
require_once('../php/configreader.php');
require_once('../php/payment.php');


$db->connect();

$st = new Student(0);

$sp = new Payment( $st);

$sql = "SELECT type , name , for_year , for_term , amount FROM payment_list ORDER BY for_year DESC";

$res = mysql_query($sql );

$count = mysql_affected_rows();
 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>KSMS | School Fees Structure | Founders High School Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		 <link rel="stylesheet" href="../styles/messi.css">
	 	<script data-jsfiddle="common" src="../js/jquery.js"></script>
	 	 <script src="../js/messi.js"></script>
  	
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>
<script type="text/javascript" >

function confirmAdd(){
	
new Messi( 'WARNING: You are bout to change the school\'s fees payment structure.  This action will affect all students !' , {title: 'Do you understand ?' ,
 modal : true , 
  titleClass: 'error',
   buttons: [{id: 0, label: 'Close', val: 'X'} ,
    {id: 1, label: 'I Understand', val: 'Y' , class: 'btn-success'} ] , callback:  function(ret){
if( ret == 'Y'){
addPayment();	
}	

}    
    
   } );
    
	
}


function addPayment(){
	
Messi.alert('Hello');	
}
</script>
		<h1 id="head">Founders High School</h1>

		<ul id="navigation">
			<li><a href='index.php' >Overview</a></li>
			<li><a href="payments.php" class="active" >Payments</a></li>
			<li><a href="students.php">Students</a></li>
			<li><a href="classes.php" >Classes</a></li>
			<li><a href="users.php" >Users</a></li>
			<li><a href="staff.php" >Staff</a></li>
		</ul>
		
			<div id="content" class="container_16 clearfix">
			
		
				<div class="grid_16">
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Amount</th>
								<th>Year / Term</th>
								<th colspan="2" width="10%">Actions</th>
							</tr>
						</thead>
						<!-- PAge numbers
						<tfoot>
							<tr>
								<td colspan="5" class="pagination">
									<span class="active curved">1</span><a href="#" class="curved">2</a><a href="#" class="curved">3</a><a href="#" class="curved">4</a> ... <a href="#" class="curved">10 million</a>
								</td>
							</tr>
						</tfoot>
						-->
						<tbody>
<?php

for( $x = 0; $x < $count ; $x++){
$row = mysql_fetch_row($res);
$row[4] = formatMoney( $row[4] );
echo "						
							<tr>
								<td>{$row[1]}</td>
								<td>{$row[4]}</td>
								<td>{$row[2]} / {$row[3]}</td>
								<td><a onclick=\"editPayment('{$row[0]}');\" class=\"edit\">Edit</a></td>
								<td><a onclick=\"deletePayment('{$row[0]}')\" class=\"delete\">Delete</a></td>
							</tr>
	";
}	
?>						
						</tbody>
					</table>
				</div>
			
	<form id='add_p_s' >
	<h3>Add Payment</h3>
				<div class="grid_4">
					<p>
						<label>Name<small></small></label>
						<input type="text" id='name' name='name' />
					</p>
				</div>
				<div class="grid_5">
					<p>
						<label>Amount: $</label>
						<input id='amount' name='amount' type="text" value='0.00' />
					</p>
				</div>
				<div class="grid_5">
					<p>
						<label>Year</label>
						<select id='year' name='year'>
						<?php
						$x = date('Y');
						for($y = 0; $y < 3; $y++ ){
						print '<option>' . ($x + $y) . '</option>';
						}
						?>
						</select>
					</p>
				</div>
				<div class="grid_5">
					<p>
						<label>Term</label>
						<select id='term' name='term'>
							<option value='0'>Select Term(s)</option>
							<option value='1'>1 only</option>
							<option value='12'>1 and 2 only</option>
							<option value='13'>1 and 3 only</option>
							<option value='2'>2 only</option>
							<option value='23'>2 and 3 only</option>
							<option value='3'>3 Only</option>
							<option value='123'>1 , 2 and 3 only</option>
							
						</select>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<label>&nbsp;</label>
						
					</p>
				</div>
				</form>	
				<br />	<button onclick="confirmAdd();" >Add Fee</button>	
			</div>
		
		<div id="foot">
					<a href="#">Contact Me</a>
				
		</div>
	</body>
</html>
