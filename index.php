<?php
require_once('configuration.php');

//check if user is logged in
//logout if not
if(! $sess->isLoggedIn() ){
$sess->StartNew();
header('Location: login.php');
exit;
}

?>
<!DOCTYPE html>
<!-- saved from url=(0044)http://1stwebdesigner.com/demos/burnstudio/# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Kings School Manager | <?php echo $config->school_name; ?></title>
  <link rel="stylesheet" href="styles/style.css.php">
  <link rel="stylesheet" href="styles/messi.css">  
  <link rel="icon" href="favicon.png" type="image/x-icon" />
  
  <script data-jsfiddle="common" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/ajaxSuggestions.js"></script>
 

 
  <script src="js/messi.js"></script>

  <script data-jsfiddle="common" src="js/jquery.handsontable.full.js"></script>
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="styles/jquery.handsontable.full.css">

  
  <script src="js/slides.min.jquery.js"></script>
  <script language="javascript" type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>

<script language="javascript" type="text/javascript">

	// Notice: The simple theme does not use all options some of them are limited to the advanced theme

	tinyMCE.init({

		mode : "textareas",

		theme : "simple"

	});

</script>

  <!-- this cssfile can be found in the jScrollPane package -->
   <script type="text/javascript" src="js/common.js.php" />
   
   
<script type="text/javascript">

//Disable right click script
var message="Sorry, right-click has been disabled";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->





</SCRIPT>

	
	
	<!-- the jScrollPane script -->
	<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
	
	<!--instantiate after some browser sniffing to rule out webkit browsers-->
	
	<!--instantiate after some browser sniffing to rule out webkit browsers-->
	

	<script type="text/javascript">
	
	  $(document).ready(function () {
	      if (!$.browser.webkit) {
	          $('.container').jScrollPane();
	      }
	  }
	 
	
	</script>
	
	
	<!--[if IE]>
	<script type="text/javascript">
	(function(){
	var html5elmeents = "address|article|aside|audio|canvas|command|datalist|details|dialog|figure|figcaption|footer|header|hgroup|keygen|mark|meter|menu|nav|progress|ruby|section|time|video".split('|');
	for(var i = 0; i < html5elmeents.length; i++){
	document.createElement(html5elmeents[i]);
	}
	}
	)();
	</script>
	<![endif]-->
</head>

<body onload=' goBack(); '  style='width: 1000px; height: 800px;'>
  <noscript style="padding-bottom: 1000px; margin: 1000px; position: fixed;">
 
  <h1 color="red" >Please enable JavaScript in your browser settings</h1>
 
  </noscript> 
   <script type="text/javascript">
       $(document).ready(function(){
           
       });
   </script>
   
<script type="text/javascript">
<?php	

if( isset($_SESSION['show_login'] ) ){
print "

new Messi('<center><h2>{$sess->name}</h2><br>Last login: Today<br>' , { title: 'Logged in' , autoclose: 5000 , titleClass: 'info'} );

";
unset( $_SESSION['show_login']);

}

?>
</script>
	<div id="header-wrap" class="menuBar" style=" background-color: white; padding-top: 0px;" >
	
		<center>
			<nav class="group">
				<ul>
					<li ><a onclick="loadPage('');" style="margin:  0 0 0 15px;" title=""><img src="images/home.png" />Home</a></li>
					<li><a onclick="loadPage('payments');" title=""><img src="images/budget32.png" />Accounting</a></li>
					<li><a onclick="loadPage('students');" title=""><img src="images/man-32.png" />Students</a></li>
					<li><a onclick="loadPage('classes');" title=""><img src="images/couple32.png" />Classes</a></li>
			<li><a onclick="showStaff();" title=""><img src="images/sign-up32.png" />Staff</a></li>
		
									
													
<li><a onclick="loadPage('settings');" title=""><img src="images/settings.png"  />Settings</a></li>
	
				<li class="last" >
				<div>
			<form method="get" action="search/search.php" style="padding-bottom:20px; " >
							<input class="ajax-suggestion url-search/student.php" type="text" name="search" placeholder="Find a Student">
							<input type="submit" name="search" value="go" class="search"><br />			</form>
		</div>					
		<div id="search-result-suggestions">
		<h4>Search Suggestions</h4>
		<div id="search-results" style="color: black; background-color: white;" >
			
		</div>
				</li>	
				</ul>
				
			</nav>
			
			
							
		</center>	
		</header>
		<br />
		<div style='padding-left: 150px;' >
		<marquee behavior="slide" direction="left">
		<center>
		<b style=''>
		<?php
		echo "<a style='color: black; font-size: 24px; ' >{$config->school_name} Administration</a> 
		
		";
		
		?>
		
		</b>
		</marquee>
		</center>
		
		</div>
	</div><!-- end header wrap -->

<div class="sidebar" >
<center>
	

<a  ><img src='images/blank.png'  /></a>
<a  ><img src='images/blank.png'  /></a>
<a  ><img src='images/blank.png'  /></a>
<a  ><img src='images/blank.png'  /></a>
<a  title="Delete the student payment" ><img src='images/blank.png'  /></a>
<div id="static_back" style="float: right; ">
<a onclick="goBack();" title="Navigate to previous page" ><img src="images/back.png" /></a>
</div>
</div>	

<!-- Main Content Dividor -->
<div class="content"  id="main" >

<div class="menu"  >

</div>
<!--- Student Info -->


</center>
</div>
<center>
<p class="footer" >
<p>Logged in as 
<?php
echo $sess->name;
?>
</p>

<h2>Powered by <a style="color: blue; font-weight: bold; cursor: pointer;" onclick='Messi.load("info.php",{title: "About Kings Software" , modal: true , titleClass: "success" } );'  >Kings School Management System</a> (c) 2016 <b style='color: green; font-weight: bold;' > [ <?php echo "$config->year / $config->term";  ?>  ] </b>


</h2>
</body></html>
