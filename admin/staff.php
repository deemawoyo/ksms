<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>KSMS | Staff | Founders High School Admin</title>
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
			<li><a href='index.php'>Overview</a></li>
			<li><a href="payments.php">Payments</a></li>
			<li><a href="students.php" >Students</a></li>
			<li><a href="classes.php" >Classes</a></li>
			<li><a href="users.php" >Users</a></li>
			<li><a href="staff.php" class="active">Staff</a></li>
		</ul>
			<div id="content" class="container_16 clearfix">
				<div class="grid_16">
					<h2>Add Staff Member</h2>
					<p class="error">Add a new staff member</p>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">Title + Fullname  <small>e.g Mr Delight Mawoyo</small></label>
						<input type="text" name="title" />
					</p>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">National ID Number <small></small></label>
						<input type="text" name="title" />
					</p>
						
				</div>
				<div class="grid_6">
					<p>
						<label for="title" >Department</label>
						<select name='dept'>
							<option>Administration</option>
							<option>Teacher</option>
							<option>Janitor / Other</option>
						</select>
					</p>
				</div>

				<div class="grid_16">
					<p>
						<label>Contact Details: <small>Enter employee address and phone number(s) here</small></label>
						<textarea></textarea>
					</p>
				</div>

				<div class="grid_16">
					<p>
						<label>Extra Notes <small>Markdown Syntax.</small></label>
						<textarea class="big"></textarea>
					</p>
					<p class="submit">
						<input type="reset" value="Reset" />
						<input type="submit" value="Post" />
					</p>
				</div>
			</div>
		
		<div id="foot">
					<a href="#">Contact Me</a>
		</div>
	</body>
</html>
