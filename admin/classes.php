<?php
require_once('../configuration.php');
require_once('../php/database.php');
require_once('../php/student.php');
require_once('../php/configreader.php');
require_once('../php/payment.php');


$db->connect();

 $st = new Student(0);

$sp = new Payment( $st);

$sql = "SELECT form , class FROM class_list ORDER BY form ";

$res = mysql_query($sql );

$count = mysql_affected_rows();
 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>KSMS | Classes | Founders High School Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>

		<h1 id="head">Founders High School</h1>

		<ul id="navigation">
			<li><a href="index.php">Overview</a></li>
			<li><a href="payments.php">Payments</a></li>
			<li><a href="students.php">Students</a></li>
			<li><a href="classes.php" class='active' >Classes</a></li>
			<li><a href="users.php" >Users</a></li>
			<li><a href="staff.php" >Staff</a></li>
		</ul>

		<div id="content" class="container_16 clearfix">
		
		
				<div class="grid_16">
					<table>
						<thead>
							<tr>
								<th>Form</th>
								<th>Class</th>
								
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

echo "						
							<tr>
								<td>{$row[0]}</td>
								<td>{$row[1]}</td>
								
								<td><a onclick=\"editClass({$row[0]} , '{$row[1]}');\" class=\"edit\">Edit</a></td>
								<td><a onclick=\"deletePayment({$row[0]} , '{$row[1]}');\" class=\"delete\">Delete</a></td>
							</tr>
	";
}	
?>						
						</tbody>
					</table>
				</div>		
		
				<form id='add_p_s' >
	<h3>Add Class</h3>
				<div class="grid_5">
					<p>
						<label>Form</label>
						<select id='year' name='year'>
						<?php
						$config->printOptionForms();
						?>
						</select>
					</p>
				</div>
				<div class="grid_5">
					<p>
						<label>Name</label>
						<input id='amount' name='amount' type="text" value='' />
					</p>
				</div>
		
				<div class="grid_2">
					<p>
						<label>&nbsp;</label>
						
					</p>
				</div>
				</form>	
				
				<br />	<button onclick="confirmAdd();" >Add Class</button>	


<br />
			
		</div>
	</body>
</html>
