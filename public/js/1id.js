$(document).ready(function(){
$(".layoutfour").trigger( "click" );
    // Initiate Help
    var help = readCookie('help');
    
        if (help == 1) {
           helpFunction('show');
        }
        else {
            helpFunction('hide');
        }
    


    // Create select box for revision control
   // createRevision("init");

    //$('.revision-name').keyup(function(){
    //    createRevision("keyup");
    //});

    $( "body" ).on( "change", "#mySelect", function( event ){
        var index = $(this).val();
        $("#revisions .revision").hide();
        $("#revisions .revision[data-id="+ index +"]").show();
    });



    // Activate toolstips
    $('[data-toggle="tooltip"]').tooltip();

    // Remove hyperlink from the last breadcrumb
    $(".breadcrumb a").last().contents().unwrap();


    $( ".datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy',
        // showButtonPanel: true,
        yearRange: "1950:2050",
        changeMonth: true,
        changeYear: true,
        onSelect: function(date, inst){
         //   alert(date);
         //   if(date=="31/12/9999") $("#" + inst.id).val("Current");
        }
    });
    if(typeof alerts != "undefined"){
    for(var i=0; i<alerts.length; i++) {
        alertify.log(alerts[i].text, alerts[i].type);
        }
    }
    $('.datepicker').attr('autocomplete', 'off');

    $('#language').change(function(){
        createCookie('lang', $(this).val(), 30);
    });

    var lan = readCookie('lang');
    if(lan) {
        $('#language').val('lan');
    }

    $('#navbar ul li.langs ul li a').on('click', function(){
        createCookie('lang',$(this).data('id'),30);
        location.reload();
    });


    // Adding new field in Reading List
    $('.add-tag').click(function(){
            var input = $('.tags-form:first input').attr('name');
            var select = $('.tags-form:first select').attr('name');
            var p = (Math.random().toString(16)+"000000000").substr(2,8);
            var newInputName = input.replace('[0]', '[' + p + ']');
            var newSelectName = select.replace('[0]', '[' + p + ']');
            $('.tags-form:first').clone()
                                    .find("input").val("").attr('name', newInputName).end()
                                    .find("select").attr("name", newSelectName).end()
                                    .appendTo('.new-tags-form');
        
            oneTag();
            removeTag();
            removeContactField();
    });
            // Removes Tag
            removeTag();

            // Removes Contact Field
            removeContactField();

    $('.help').click(function(){
        var temp = $(this).find('span:hidden').data('id');
        createCookie('help', temp, 30);
        
        if (temp == 1) {
            helpFunction('show');
        }
        else 
            helpFunction('hide');
    });
	
    oneTag();
	
	/** resume genarotor **/
	
	$(".single-row-btn").click(function(){
		var sectionId = $(this).data("section");
		$("#" + sectionId + "-2").hide();
		$("#" + sectionId + "-1").show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	$(".double-row-btn").click(function(){
		var sectionId = $(this).data("section");
		$("#" + sectionId + "-2").show();
		$("#" + sectionId + "-1").hide();
		$(this).addClass("active").siblings().removeClass("active");
	});
	// resume generator dropdown for revisions
	$("#revision-selector").change(updateTemplateLinks);
	updateTemplateLinks();
	
    
	


    $('.label-required').each(function(){

        $(this).append("<span>&nbsp;*</span>");

    });
	
}); // end document.ready

/**
 * Updates GET param in links for downloading templates
 */
function updateTemplateLinks() {
	$("#revision-selector").each(function(){
		var val = $(this).val();
		$(".download-populated-template").each(function(){
			var href = $(this).attr("href").split('?')[0];
			$(this).attr("href", href + "?revision=" + val);
		});
	});
}
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function createRevision(mode){

    var prev = $('#mySelect').val();
    if(!prev) prev = 0;
    $('#mySelect').remove();

    $('#revision-selector').prepend('<select id="mySelect"></select>');
    var i = 1;
    $('.revision').each(function(){
        var x = i;
        // var x = $(this).find('input').val();
        //if(!x) x = "-"
        $('#mySelect').append($('<option>', {
            value: i,
            text: "Version " + x,
        }));
        //var y = $(".revision").find('.revision-name').val();
        if(i!=1) $(this).hide();
        i++;
    });
    // $('#mySelect').val(prev);
}

// Removing text field in Reading List
function removeTag(){
    $('.remove-tag').click(function(){
        var num = $('.tags-form').length;
        //
            if (num == 1) {
                return false;
        }
            $(this).parent('.form-group').parent('.tags-form').remove();
        });
}

function removeContactField(){
    $('.remove-tag').click(function(){
        var num = $('.tags-form').length;
        //
            if (num == 1) {
                return false;
        }
            $(this).parent('.tags-fields').parent('.form-group').parent('.tags-form').remove();
        });
}

function helpFunction(mode){
    if ($('.sidebar').length){
        
    if (mode == 'show'){

        $('#page').addClass('show-help');
        $('.close-help').show();
        $('.open-help').hide();
        $('.sidebar').addClass('sidebar-show');
    }
    if (mode == 'hide') {
        $('#page').removeClass('show-help');
        $('.close-help').hide();
        $('.open-help').show();
        $('.sidebar').removeClass('sidebar-show');

        $('#playerid').each(function(){
            this.contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*')
        });
    }
}
    else return false;
}

function oneTag() {
    var num = $('.tags-form').length;
    if (num > 1){
        $('.tags-form .form-group .control-label label:not(:first)').text("");
    }
}

$(document).on('click','.showChild', function(){
	var id = $(this).attr('data-id');
	var type = $(this).attr('data-type');
	if(type == 'parent'){
		$(".hidechild").hide();
	} 
	else {
		$(".hdchl").hide();
	}
	$("#show-"+id).show();
});

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

$(document).on('click','.changeLayout', function(){
	$(".tablinks").removeClass('active');
	$(this).addClass('active');
	var layout = $(this).attr('data-layout');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'get',    
		url: 'Customize/layout/'+layout,
		cache: false,
		data:null, 
		async: false,
		success: function(result){
			$('#displayLayout').html(result);
		}
	});
});


function shownew(elem_id)
{	
	$('span').removeClass('select');
	$('ul li').removeClass('select');
	$('#'+elem_id).addClass('select');
	var dclass=$('#'+elem_id).attr('class');
	var url = 'get-layouttree-data';
	//var layout=$('#'+elem_id).attr('data-layout');
	var layout=$('.active').attr('data-layout');
	//alert(elem_id);
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'post',    
		url: url,
		cache: false,
		data:{id:elem_id,dclass:dclass,layout:layout}, 
		async: false,
		success: function(result){
			//alert(result);
			if(layout == 'Customizing(Inline)'){
				$('#result').html(result);
			} else {
				$("#dialogBox").show().html(result);
				$("#fade").show();
			}
			
		}
	});
}

$(document).on('keyup','#searchLayoutData', function(){
    var value = $(this).val().toLowerCase();
	$("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

$(document).on('click','.editData', function(){
    // $(".main").removeClass('big-section');
	// $(".main").addClass('medium-section');
	// $(".right").removeClass('hide-section');
	// $(".right").addClass('small-section');
	$(".allrow").removeClass('highlight-color');
	$(this).parent().parent().addClass('highlight-color');
	$(".allspan").show();
	$(".allinput").hide();
	$(".editData").show();
	$(".copyData").show();
	$(".saveData").addClass('hide-section').hide();
	$(".closeEditData").addClass('hide-section').hide();
	var id = $(this).attr('data-id');
	$(this).hide();
	$("#copy"+id).hide();
	$("#deleteCustomizeData"+id).hide();
	$("#save"+id).removeClass('hide-section').show();
	$("#closeEditData"+id).removeClass('hide-section').show();
	$(".span"+id).hide();
	$(".input"+id).show();
});  

$(document).on('click','.closeEditData',function(){
	var id = $(this).attr('data-id');
	$(this).parent().parent().removeClass('highlight-color');
	$(".input"+id).hide();
	$(".span"+id).show();
	$("#edit"+id).show();
	$("#copy"+id).show();
	$("#deleteCustomizeData"+id).show();
	$(".saveData").addClass('hide-section').hide();
	$(".closeEditData").addClass('hide-section').hide();
});

$(document).on('click','.closeSection', function(){
    $(".main").removeClass('medium-section');
	$(".main").addClass('big-section');
	$(".right").removeClass('small-section');
	$(".right").addClass('hide-section');
});

$(document).on('click','.saveData', function(){
    var id = $(this).attr('data-id');
	var namearray = [];
	var valarray = [];
	$('.inputs'+id).each(function(){
        namearray.push($(this).attr('name'));
		valarray.push($(this).val());
	});
	var table_name=$('#table_name').val();
	var table_id=$('#table_id').val();
	var layout=$('.active').attr('data-layout');
	var url = $(this).attr('data-url');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: "POST",    
		url: url,
		data:{table_name:table_name,namearray:namearray,valarray:valarray,tabId:id}, 
		success: function(result){					
			
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'get',    
				url: 'Customize/layout/'+layout,
				cache: false,
				data:null, 
				async: false,
				success: function(result){
					$('#displayLayout').html(result);
					shownew(table_id);
				}
			});
			
		}
	});
});

$(document).on('click','.deleteCustomizeData',function(){
	var id = $(this).attr('data-id');
	var url = $(this).attr('data-url');
	var type = $(this).attr('data-method');
	var table_name=$('#table_name').val();
	
	var con = 'Do you Really Want to Delete?';
	
	if (confirm(con)) {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: type,    
			url: url,
			cache: false,
			data:{table_name:table_name,tabId:id}, 
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

$(document).on('click','#closeDialogBox',function(){
	$("#dialogBox").hide().html('');
	$("#dialogBox1").hide().html('');
	$("#dialogBox2").hide().html('');
	$("#fade").hide();
});

$(document).on('click','#addNewData',function(){
	$("#addData").removeClass('hide-section');
	$("#addData").addClass('highlight-color');
	$("#saveAddNew").show().removeClass('hide-section');
	$(".inputnew").val('');
});

$(document).on('click','#closeAddData',function(){
	$("#addData").addClass('hide-section');
	$("#addData").removeClass('highlight-color');
});




// $(document).on('click','#tableexport',function(){
	// var table_name=$('#table_name').val();
	// var table_id=$('#table_id').val();
	
		// var url = $(this).attr('data-url');
	// $.ajax({
		// headers: {
			// 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// },
		// type: "POST",    
		// url: url,
		// data:{table_name:table_name,tabId:table_id}, 
		// success: function(result){					
			
			
			
		// }
	// });
// });
// $(document).on('click','#closeDialogBox',function(){
	// $("#dialogBox").hide().html('');
	// $("#dialogBox1").hide().html('');
	// $("#fade").hide();

$(document).on('click','.copyData',function(){
	var id = $(this).attr('data-id');
	$("#addData").removeClass('hide-section');
	$("#addData").addClass('highlight-color');
	$("#saveAddNew").show().removeClass('hide-section');
	$('.inputs'+id).each(function(){
		var nme = $(this).attr('name');
		var val = $(this).val();
		$('.cls'+nme).val(val);
	});

	
});





$(document).on('click','#export',function(){	
  var titles = [];
  var data = [];
 var table_name=$('#table_name').val();
  /*
   * Get the table headers, this will be CSV headers
   * The count of headers will be CSV string separator
   */
  $('.table th.col').each(function() {
    titles.push($(this).text());
  });

  /*
   * Get the actual data, this will contain all the data, in 1 array
   */
  $('.table td span').each(function() {
    data.push($(this).text());
  });
  
  
  
  /*
   * Convert our data to CSV string
   */
  var CSVString = prepCSVRow(titles, titles.length, '');
  CSVString = prepCSVRow(data, titles.length, CSVString);

  /*
   * Make CSV downloadable
   */
  var downloadLink = document.createElement("a");
  var blob = new Blob(["\ufeff", CSVString]);
  var url = URL.createObjectURL(blob);
  downloadLink.href = url;
  downloadLink.download = table_name+".csv";

  /*
   * Actually download CSV
   */
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);
});

   /*
* Convert data array to CSV string
* @param arr {Array} - the actual data
* @param columnCount {Number} - the amount to split the data into columns
* @param initial {String} - initial string to append to CSV string
* return {String} - ready CSV string
*/
function prepCSVRow(arr, columnCount, initial) {
  var row = ''; // this will hold data
  var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
  var newLine = '\r\n'; // newline separator for CSV row

  /*
   * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
   * @param _arr {Array} - the actual array to split
   * @param _count {Number} - the amount to split
   * return {Array} - splitted array
   */
  function splitArray(_arr, _count) {
    var splitted = [];
    var result = [];
    _arr.forEach(function(item, idx) {
      if ((idx + 1) % _count === 0) {
        splitted.push(item);
        result.push(splitted);
        splitted = [];
      } else {
        splitted.push(item);
      }
    });
    return result;
  }
  var plainArr = splitArray(arr, columnCount);
 
  // don't know how to explain this
  // you just have to like follow the code
  // and you understand, it's pretty simple
  // it converts `['a', 'b', 'c']` to `a,b,c` string
  plainArr.forEach(function(arrItem) {
    arrItem.forEach(function(item, idx) {
		if (item.indexOf(',') == -1) {
			row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
		}
		else{
				item='"'+item+'"';
				row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
		}
    });
    row += newLine;
  });
  return initial + row;
}



function exportF(elem) {
	
  // var table = document.getElementById("table");
	// $(table).find('th:last-child, td:last-child').remove();
  // var html = table.outerHTML;
 
  // var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
  // elem.setAttribute("href", url);
  // elem.setAttribute("download", "export.xls"); // Choose the file name
  // return false;
  var table_name=$('#table_name').val();
  $("#table").table2excel({
		exclude: ".hidedata",
		filename: table_name+".xls"
	});
}



$(document).on('click','#import',function(){
	var table_name=$('#table_name').val();
	var table_id=$('#table_id').val();
	
		var url = $(this).attr('data-url');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: "POST",    
		url: url,
		data:{table_name:table_name,tabId:table_id}, 
		success: function(result){					
			
			
			
		}
	});
});


$(document).on('click','#import-data',function(e){
	var table_name=$('#table_name').val();
	var table_id=$('#table_id').val();
	var url = $(this).attr('data-url');
	 var form = new FormData();
    var image1 = $('#importdataval')[0].files[0];
    form.append('image', image1);
	form.append('table_id', table_id);
	form.append('table_name', table_name);

	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: "POST",    
		url: url,
		processData: false,
		contentType: false,
		//data:{table_name:table_name,tabId:table_id,importdata:form1},
		data: form,		
		success: function(result){					
			alert(result);
			if(result=='done')
			{
				
				$("#importmodal .close").click();
				alert('Data uploaded successfully.');
				$('#importdataval').val('');
				shownew(table_id);
				
			}
			
			else{
				alert('please check your file.');
			}
			
			
		}
	});
	
});

$(document).on('click','.chkParent',function(e){
	if($(this).prop("checked") == true){
		$(".chkChild").prop('checked', true);
		$(".chkChild").each(function(){
			var favorite = [];
			$.each($(".chkChild:checked"), function(){            
				favorite.push($(this).val());
			});
			var ids = favorite.join(",");
			var linkcsv = 'downloadcustomizetables/csv/'+ids;	
			var linkexcel = 'downloadcustomizetables/xlsx/'+ids;	
			$("#exportAllCsv").attr('href',linkcsv);
			$("#exportAllExcel").attr('href',linkexcel);		
		});
	} else {
		$(".chkChild").prop('checked', false);
		$("#exportAllCsv").removeAttr("href");
		$("#exportAllExcel").removeAttr("href");
	}
});



$(document).on('click','.chkChild',function(e){
	$(this).each(function(){
		var favorite = [];
		$.each($(".chkChild:checked"), function(){            
			favorite.push($(this).val());
		});
		var ids = favorite.join(",");
		var linkcsv = 'downloadcustomizetables/csv/'+ids;	
		var linkexcel = 'downloadcustomizetables/xlsx/'+ids;	
		$("#exportAllCsv").attr('href',linkcsv);
		$("#exportAllExcel").attr('href',linkexcel);		
	});
});

$(document).on('click','.exportAll',function(){
	var favorite = [];
	$.each($(".chkChild:checked"), function(){            
		favorite.push($(this).val());
	});
	var ids = favorite.join(", ");
	if(ids == '') { 
		alert('No tables were selected!');
	} 
});

$(document).on('mouseover','.info-icon',function(){
   
	var id=$(this).attr('data-id');
	var layout=$('.active').attr('data-layout');
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'GET',    
		url: 'Customize/info/'+id,
		cache: false,
		data:{layout:layout}, 
		async: false,
		success: function(result){
			
			if(layout == 'Customizing(Inline)'){
				$('#result').html(result);
			} else {
				$("#dialogBox").show().html(result);
				$("#fade").show();
			}	
		}
	});
}); 

// $(document).on('mouseout','.info-icon',function(){
   // $("#dialogBox").hide().html('');
// });

$(document).on('click','#openTxtAreaBox',function(){
   
	var id=$(this).attr('data-id');
	var val = $(this).val();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'POST',    
		url: 'Customize/opentxtareapopup',
		cache: false,
		data:{id:id,val:val}, 
		async: false,
		success: function(result){
			
			$("#dialogBox2").show().html(result);
			$("#fade").show();	
		}
	});
});

