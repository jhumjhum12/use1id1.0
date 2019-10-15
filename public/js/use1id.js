$(document).on('click','#showDialogBox',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			$("#dialogBox").show().html(result);
			$("#fade").show();
		}
	});
	
	
});

$(document).on('click','#closeDialogBox',function(){
	$("#dialogBox").hide().html('');
	$("#dialogBox1").hide().html('');
	$("#dialogBox3").hide().html('');
	$("#dialogBox2").hide().html('');
	$("#fade").hide();
	
});

$(document).on('click','#editVersion',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			$("#verName").focus();
			$("#verName").val(result.name);
			$("#verDesc").val(result.desc);
			$("#post-form").attr('action','biography/edit-version-data');
			$("#versionId").val(id);
		}
	});
});


$(document).on('click','#deleteData',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	var dmsg = $(this).attr('data-msg');
	
	//alert(dmsg.replace(/\\n/g,"\n"));
	
	if(dmsg != ''){
		var con = dmsg.replace(/\\n/g,"\n");
	} else {
		var con = 'Do you Really Want to Delete?';
	}
	
	if (confirm(con)) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: type,    
			url: url,
			cache: false,
			data:{id:id}, 
			async: false,
			success: function(result){
				$("#row-"+id).remove();
				setTimeout(function (){
					alert('Deleted Successfully!');
				},10);	
			}
		});
	}
});

$(document).ready(function () {
    $(".updown").click(function () {
        $('li > ul').not($(this).children("ul").toggle()).hide();
        
    });
});
///////////datepicker/////////////

$( function() {
    $( ".datepicker" ).datepicker(
	{
		changeYear: true,
		changeMonth: true,
		yearRange: "-100:+0",
		dateFormat: 'yy-mm-dd'
	}
	);
  } );
  
  
  
///////////work experience edit delete function 13.12.18//////////


$(document).on('click','#editWork',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			$("#JobTitle").focus();
			$('#VersionList').val(result.version);
			$("#JobTitle").val(result.job);
			$("#Description").val(result.desc);
			$("#CompanyName").val(result.company);
			$("#StartDate").val(result.startdate);
			$("#EndDate").val(result.enddate);
			$("#post-form").attr('action','edit-work-data');
			$("#WorkId").val(id);
		}
	});
});


///////////project edit delete function 13.12.18//////////


$(document).on('click','#editProject',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			$("#JobTitle").focus();
			$('#VersionList').val(result.version);
			$('#WorkList').val(result.work_exp);			
			$("#Cname").val(result.customer);			
			$("#Pname").val(result.pname);
			$("#JobTitle").val(result.job);
			$("#Des").val(result.desc);
			$("#StartDate").val(result.startdate);
			$("#EndDate").val(result.enddate);
			$("#post-form").attr('action','edit-project-data');
			$("#ProjectId").val(id);
		}
	});
});



$(document).on('click','#editEducation',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			
			$('#VersionList').val(result.version);						
			$("#CourseName").val(result.course);			
			$("#Insname").val(result.institute);
			$("#des").val(result.des);			
			$("#StartDate").val(result.startdate);
			$("#EndDate").val(result.enddate);
			$("#post-form").attr('action','edit-education-data');
			$("#EducationId").val(id);
		}
	});
});



$(document).on('click','#editInterest',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			
			$('#VersionList').val(result.version);						
			$("#Interest").val(result.interest);			
			$("#des").val(result.des);			
			$("#post-form").attr('action','edit-interest-data');
			$("#InterestId").val(id);
		}
	});
});



$(document).on('click','#editQualification',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			
			$('#VersionList').val(result.version);						
			$("#Qualification").val(result.qualification);			
			$("#des").val(result.des);			
			$("#post-form").attr('action','edit-qualification-data');
			$("#QualificationId").val(id);
		}
	});
});


$(document).on('click','#addRow',function(){
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	var val = $(this).attr('data-val');
	var newval = parseInt(val) + parseInt(1);
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{val:newval}, 
		async: false,
		success: function(result){
			$("#rowAdd").append(result);
			$("#addRow").attr('data-val',newval);
		}
	});
});

$(document).on('click','#deleteRow',function(){
	$(this).parent().parent().remove();
});

$(document).on('click','#editReference',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			$("#JobTitle").focus();
			$('#VersionList').val(result.version);
			$("#Cname").val(result.customer);			
			$("#Pname").val(result.pname);
			$("#JobTitle").val(result.job);
			$("#JobPosition").val(result.jobpos);
			$("#Des").val(result.desc);
			$("#Date").val(result.date);
			$("#post-form").attr('action','edit-reference-data');
			$("#ReferenceId").val(id);
		}
	});
});

$(document).on('click','#editVerLang',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: type,    
		url: url,
		cache: false,
		data:{id:id}, 
		async: false,
		success: function(result){
			$("#addRow").hide();
			$("#VersionList").focus();
			$('#VersionList').val(result.version);
			$('#langList').val(result.lang);
			if(result.listening == '1'){
				$('#listening').prop('checked', true);
			} else {
				$('#listening').prop('checked', false);
			}
			if(result.speaking == '1'){
				$('#speaking').prop('checked', true);
			} else {
				$('#speaking').prop('checked', false);
			}
			if(result.reading == '1'){
				$('#reading').prop('checked', true);
			} else {
				$('#reading').prop('checked', false);
			}
			if(result.writing == '1'){
				$('#writing').prop('checked', true);
			} else {
				$('#writing').prop('checked', false);
			}
			$("#post-form").attr('action','edit-language-data');
			$("#LangId").val(id);
		}
	});
});

$(document).on('click','#qrLogin',function(){
	var qmail = $(".chkemail").val();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'POST',    
		url: 'qrcode',
		cache: false,
		data:{qmail:qmail}, 
		async: false,
		success: function(result){
			$("#dialogBox1").show().html(result);
			$("#fade").show();
		}
	});
});



///////// 1st august/////////

//fetchversion("init");

function fetchversion(mode){
	
	var segments='';
	var curl=window.location.href;
	if (curl.indexOf(',') > -1) { 
	
		segments1 =curl.split(',') ;
		segments =segments1[1];	
	
	}
	
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'POST',    
		url: 'getVersion',
		cache: false,
		data:{}, 
		async: false,
		success: function(result){
			
			var listItems = "";
			for(i=0;i< (result.length);i++){
		
				if(segments==result[i].id)
				{
						listItems += "<option value='" + result[i].id+ "' selected>" + result[i].name + "</option>";	
				}
					else{
						listItems += "<option value='" + result[i].id+ "'>" + result[i].name + "</option>";	
					}
			

			}
			
			$('#mySelect').append(listItems);			
		}
	});

 
    
}

var id = $("#version-selector option:first").val();
$("#versionId").val(id);

$(".downloadResume").each(function(){
	var template = $(this).attr('data-template');
	var verId = $("#versionId").val();
	if(verId != ''){
	    verId = verId;
	} else {
	    verId = '0';
	}
	var linkadd = 'resume-generator/download/'+template+'/'+verId;	
	$(this).attr('href',linkadd);	
});
var template = $(".downloadResume").attr('template');

$('#version-selector').change(function() {
    //alert($(this).val()); //will work here
	$('#versionId').val($(this).val());
	$(".downloadResume").each(function(){
		var template = $(this).attr('data-template');
		var verId = $("#versionId").val();
		if(verId != ''){
    	    verId = verId;
    	} else {
    	    verId = '0';
    	}
		var linkadd = 'resume-generator/download/'+template+'/'+verId;	
		$(this).attr('href',linkadd);	
	});
});

$('#version_id').change(function() {
   
	var selectedvaersion=$(this).val()
	var selectedtable=$('#table_name').val();
	var segmentid=$('#segment_id').val();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'POST',    
		url: 'getdataversionwise',
		cache: false,
		data:{selectedvaersion:selectedvaersion,selectedtable:selectedtable,segmentid:segmentid}, 
		async: false,
		success: function(result){
			
			$('#filter_row').html(result)			
		}
	});
}); 



$("#template").change(function(){
	$.ajax({
                url: 'get-template',
                type: 'post', 				
				cache: false,				
				async: false,               
                data: '',
                success: function(data) {
                    $("#dialogBox3").show().html(data);
                    $("#fade").show();
                }
        });
	
});



$('#version-selector').change(function() {
   
	var selectedvaersion=$(this).val();
	
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'POST',    
		url: 'getversiondetails',
		cache: false,
		data:{selectedvaersion:selectedvaersion}, 
		async: false,
		success: function(result){
			
			$('#version_details').html(result)			
		}
	});
}); 


function openpopup(popupid)
{
	var versionid =$("#version-selector option:selected").val();
	var url='get-template';
	
	
	$.ajax({
                url: url,
                type: 'post', 				
				cache: false,				
				async: false,               
                data: {popupid:popupid,versionid:versionid},
                success: function(data) {
                    $("#dialogBox3").show().html(data);
					$("#fade").show();
                }
        });
}
