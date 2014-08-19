<style type="text/css">
.admin-container{
	width:66px;
	height:62px;
	position:fixed;
	right:5px;
	bottom:70px;
	cursor:pointer;
	z-index:30;
}	

.admin-container .error-counter{
   position:absolute;
   right:2px;
   top:0px;
    background-color: red;
    padding: 1px 5px;
    color: white;
    font-weight: bold;
    border: 1px solid rgb(150, 12, 12);
    border-radius: 6px;

}

.admin-container .admin-links{
	width:90px;
	position:absolute;
	left:-20px;
	top:-120px;
	display:none;
}

.admin-container .admin-links > a{
	display:block;
	font-size:0.7em;
	background-color:white;
	padding:5px;
	border:1px solid black;
	text-align:center;
	font-weight:bold;
	
}

</style>

<div class="admin-container" onmouseover="$('.admin-links').show();" onmouseout="$('.admin-links').hide();" onclick="direct_to_url('admin/error_learning','_blank')">
	<div class="admin-links">
		<a href="admin/error_learning" target="_blank" onclick="eventStopPropagation(event)">Error Learning</a>
		<a href="admin/cms" target="_blank" onclick="eventStopPropagation(event)">About's CMS</a>
		<a href="admin/discussion_manage" target="_blank" onclick="eventStopPropagation(event)">Discussion</a>
		<a href="admin/user_manage" target="_blank" onclick="eventStopPropagation(event)">Users List</a>
	</div>
	
	<div class="error-counter">
		<?=$totalcount?>
	</div>
	
	<img class="img-responsive" src="image/admin.png">
</div>




