
<h1>Founders High School | Students</h1>
<?php

require_once("pages/core/student.info.div.php");

?>
<center>
<div class="student_actions" style="margin: 20px; width: 600px; overflow: auto; float: right; ">
<div class="submenu"  >
<table>
<tr>
<td>
<a onclick="loadStudentSection('info');" title="Generate a pdf report of the student's records"><img src="images/pdf.png"  /><b><h2>Student Info</h2></b></a>    
</td><td>
<a onclick="loadStudentSection('payment_info');"  title="Edit student records"><img src="images/pdf.png"   /><b><h2>Payments</h2></b></a> 
</td>
</tr><tr>
<td>
<a onclick="loadStudentSection('academic_info');"   title="Payments, View student payments"><img src="images/test_report48.png"  /><b><h2>Academic </h2></b></a> 
</td>
<td>
<a onclick="loadStudentSection('textbook_info');"   title="Payments, View student payments"><img src="images/textbook.jpg"  /><b><h2>TextBooks</h2></b></a> 
</td>
</tr><tr>
<td><h2 style="color: orange;" >Payments</h2></td>
<td></td>
</tr><tr>
<td>
<a onclick="loadStudentSection('add_payment');" title="Generate a pdf report of the student's records"><img src="images/add.png"  /><b><h2>Record</h2></b></a>    
</td><td>
<a onclick="loadStudentSection('edit_payment');"  title="Edit student records"><img src="images/pencil48.png"   /><b><h2>Edit </h2></b></a> 
</td>
</tr><tr>
<td>
<a onclick="loadStudentSection('payment_report');"   title="Payments, View student payments"><img src="images/pdf.png"  /><b><h2>Report</h2></b></a> 
</td><td>
<a onclick="loadStudentSection('payment_audit');" title="Generate a pdf report of the student's records"><img src="images/chart.jpg"  /><b><h2>Audit</h2></b></a>    
</td>
</tr><tr>
<td><h2 style="color: orange;" >TextBooks</h2></td>
<td></td>
</tr><tr>
<td>
<a onclick="loadStudentSection('textbooks_view');"  title="Edit student records"><img src="images/view.png"   /><b><h2>View</h2></b></a> 
</td><td>
<a onclick="loadStudentSection('textbooks_assign');"  title="Payments, View student payments"><img src="images/data-add.png"  /><b><h2>Assign Book</h2></b></a> 
</td><td>
</tr><tr>
<td><h2 style="color: orange;" >Academic Records</h2></td>
<td></td>
</tr>
<tr>
<td>
<a onclick="loadStudentSection('academic_info');"  title="View a student's enrollment details"><img src="images/view.png"   /><b><h2>Enrollment Info</h2></b></a> 
</td>
</tr>
<tr>
<td>
<a onclick="loadStudentSection('academic_info');"  title="Edit student records"><img src="images/view.png"   /><b><h2>View</h2></b></a> 
</td><td>
<a onclick="loadStudentSection('academic_add');"   title="Payments, View student payments"><img src="images/data-add.png"  /><b><h2>Add Report</h2></b></a> 
</td><td>
</tr>
</table>
</div>

</div>
</center>
