<?php
require_once('../configuration.php');
require_once('../php/database.php');
require_once('../php/student.php');
require_once('../php/configreader.php');
require_once('../php/users.php');


$db->connect();


$us = new Users();

$users = $us->listUsers();

$count = sizeof( $users ); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>KSMS | Users | Founders High School Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		 <link rel="stylesheet" href="../styles/messi.css">
	  <script src="../js/messi.js"></script>
  		
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>

		<h1 id="head">Founders High School</h1>

		<ul id="navigation">
			<li><a href='index.php' >Overview</a></li>
			<li><a href="payments.php">Payments</a></li>
			<li><a href="students.php">Students</a></li>
			<li><a href="classes.php" >Classes</a></li>
			<li><a href="users.php" class="active">Users</a></li>
			<li><a href="staff.php" >Staff</a></li>
		</ul>
			<div id="content" class="container_16 clearfix">
					<div class="grid_16">
					<h2>Current Users</h2>
					<table>
						<thead>
							<tr>
								<th>Fullname</th>
								<th>Username</th>
								<th>Priviledges</th>
								
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
$row = $users[$x];
$priv = 'Normal User';

if( $row['is_admin'] == 1 ){
$priv = 'Administrator';	
}

echo "						
							<tr>
								<td>{$row['title']} {$row['fullname']}</td>
								<td>{$row['username']}</td>
								<td>{$priv}</td>
								
								<td><a onclick=\"editUser('{$row['username']}');\" class=\"edit\">Edit</a></td>
								<td><a onclick=\"deleteUser('{$row['username']}')\" class=\"delete\">Delete</a></td>
							</tr>
	";
}	
?>						
						</tbody>
					</table>
				</div>
				<div class="grid_16">
					<h2>Add Office User</h2>
					<p class="error">An office user can login to the database and record payments, view student records, but cannot perform administrative tasks.</p>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">Title + Fullname <small>e.g Mr Delight Mawoyo</small></label>
						<input type="text" name="title" />
					</p>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">Username <small>Must be letters only.</small></label>
						<input type="text" name="title" />
					</p>
						
				</div>
				<div class="grid_6">
					<p>
						<label for="title">Priviledges</label>
						<select>
							<option>Normal User</option>
							
						</select>
					</p>
				</div>

					<p class="submit">
						
						<input type="submit" value="Add User" />
					</p>
				</div>
			</div>
		
		<div id="foot">
					<a href="#">Contact Me</a>
		</div>
	</body>
</html>
