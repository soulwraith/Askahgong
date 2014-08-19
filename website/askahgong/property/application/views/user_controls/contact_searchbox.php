


<div class="contact-searchbox border-radius clearfix">
	<form onsubmit="search_contacts(this);return false;">
		<input class="left watermark" mark="Search for any user."autocomplete="off" name="keyword" type="text"  onkeyup="$(this).parents('form').submit()">
		<a class="submit-button icons right" data-toggle="tooltip" title="Search Now" onclick="$(this).parents('form').submit()"></a>
		<a class="back-button icons right" data-toggle="tooltip" title="Back To Contact List" onclick="clear_search_contact($(this).parents('form'))"></a>
		
	</form>
	 

</div>

<script type="text/javascript">

var CONTROL_CONTACT_SEARCHBOX_container_class,
    CONTROL_CONTACT_SEARCHBOX_container_child,
    CONTROL_CONTACT_SEARCHBOX_xhr;

	var CONTROL_CONTACT_SEARCHBOX_xhr;
	var CONTROL_CONTACT_SEARCHBOX_container_class="<?=$container?>";
	<?php if(isset($child)):?>
	var CONTROL_CONTACT_SEARCHBOX_container_child="<?=$child?>";
	<?php endif?>
</script>




