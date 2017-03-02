<br />
<center><h1 id='trdtf' >Classes</h1>
<p id="descr" style="color: red; " >
<br />
</p>

<script>
var selected_class = 0;
var selected_form = 0;


function selectClass(){
Messi.load( "pages/classes/select.php" , {title: 'Student Info', titleClass: 'info', modal: true , buttons: [{id: 0, label: 'Close', val: 'X'  } , {id: 1, label: 'Select', val: 'Y' , class: 'btn-success' } ] 
, callback: 
function(data){if(data == 'Y' ){

//code to load page goes here
var url = "pages/classes/list_class.php?form=" + selected_form + "&class=" + selected_class;
$('#trdtf').fadeOut();
$('#descr').fadeOut();
$('#class_list').load( url );	
	
 } } 
}
);



}





</script>
<div id='class_list' >
<div class="submenu"  >
<table width='100%' >
<tr><td>
<center>
<a onmouseover='$("#descr").html("Select a class" ) ;'  onmouseout='$("#descr").html("<br />");' onclick="selectClass();" id="student" title="Select a class to view, update records"><img src="images/view.png"  /><br /><b><h2>Select Class</h2></b></a>    
</center>
</td><td>
<center>
<a onmouseover='$("#descr").html("View records of transferred and deleted student by class and year" ) ;' onclick="new Messi('Feature not available in demo version' , {title: 'Demo' , modal: true });" onmouseout='$("#descr").html("<br />");' id="payments" title="Archive"><img src="images/library.ico"   /><br /><b><h2>View Archive</h2></b></a> 
</center>
</td>
</tr>
</table>
</div>

</div>

</center>

