<div class="col-md-12">
<div class="col-md-10"><h4></h4></div>
 
<div class="col-md-2">
<button id="closeDialogBox"  class="btn btn-primary cur_pointer">X</button> 
</div>
</div>
<div class="col-md-12">
<textarea   class=" form-control editor" id="txtareaData">{{$val}}</textarea>
<button id="submitTxtareaData" data-id="{{$id}}" class="btn btn-primary cur_pointer">Submit</button> 
</div>
<script src="{{ URL::asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">

    tinyMCE.init({
        selector: 'textarea',
		mode : "textareas",
        editor_selector : "mceEditor",
        menu: {
            file: {title: 'File', items: 'newdocument'},
            edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
            insert: {title: 'Insert', items: 'link media | template hr'},
            view: {title: 'View', items: 'visualaid'},
            format: {title: 'Format', items: 'bold italic underline | formats | removeformat'},
            table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
            tools: {title: 'Tools', items: 'spellchecker code'}
        }
    });
	
	
$(document).on('click','#submitTxtareaData',function(){
    var id = $(this).attr('data-id');
	var data=tinyMCE.get('txtareaData').getContent();
	$(".popupdata"+id).val(data);
	$("#dialogBox2").hide().html('');
	$("#fade").hide();
	tinyMCE.execCommand("mceRepaint");
});


</script>