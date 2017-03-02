<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>KSMS | Students | Founders High School Admin</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>

		<h1 id="head">Founders High School</h1>

		<ul id="navigation">
			<li><a href='index.php'>Overview</a></li>
			<li><a href="payments.php">Payments</a></li>
			<li><a href="students.php" class="active">Students</a></li>
			<li><a href="classes.php" >Classes</a></li>
			<li><a href="users.php" >Users</a></li>
			<li><a href="staff.php" >Staff</a></li>
		</ul>
			<div id="content" class="container_16 clearfix">
				<div class="grid_16">
					<h2>Submit News Article</h2>
					<p class="error">Something went wronk.</p>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">Title <small>Must contain alpha-numeric characters.</small></label>
						<input type="text" name="title" />
					</p>
				</div>

				<div class="grid_5">
					<p>
						<label for="title">Slug <small>Must contain alpha-numeric characters.</small></label>
						<input type="text" name="title" />
					</p>
						
				</div>
				<div class="grid_6">
					<p>
						<label for="title">Category</label>
						<select>
							<option>Draft</option>
							<option>Published</option>
							<option>Private</option>
						</select>
					</p>
				</div>

				<div class="grid_16">
					<p>
						<label>Summary <small>Will be displayed in search engine results.</small></label>
						<textarea></textarea>
					</p>
				</div>

				<div class="grid_16">
					<p>
						<label>Article <small>Markdown Syntax.</small></label>
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
