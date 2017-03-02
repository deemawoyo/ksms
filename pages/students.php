<br />
<center>
<h1>Students</h1>
<p id="descr" style="color: red; " >
<br />
</p>

<div class="submenu"  >
<table>
<tr>
<td>
<center>
<a onmouseover='$("#descr").html("Select a student to view or edit their records" ) ;' onmouseout='$("#descr").html("<br />");' onclick="loadPage('select.student');" id="student" title="Select a student to view, update records"><img src="images/view.png"  /><br /><b><h2>Select Student</h2></b></a>    
</center>
</td><td>
<center>
<a onmouseover='$("#descr").html("View records of transferred and deleted student" ) ;' onclick="new Messi('Feature not available in demo version' , {title: 'Demo' , modal: true });" onmouseout='$("#descr").html("<br />");' id="payments" title="Record, update, delete payment records "><img src="images/library.ico"   /><br /><b><h2>View Archive</h2></b></a> 
</center>
</td><td>
<center>
<a onmouseover='$("#descr").html("Enroll a student into the school database" ) ;' onclick="Messi.load('pages/students/enroll/index.php' , {title: 'Enroll Student' , titleClass: 'info' } );" onmouseout='$("#descr").html("<br />");'   id="classes" title="Enroll student into database"><img src="images/data-add.png"  /><br /><b><h2>Enroll Student</h2></b></a> 
</center>
</td>
</tr>
</table>
</div>


</center>

