$(document).ready(function(){
$("#s_slert").hide();
$('#taskUpdateBtn').hide();
fetch_me ();

$("#showData").sortable({connectWith:"#showData1"});
$("#showData1").sortable({connectWith:"#showData2"});
$("#showData2").sortable({connectWith:"#showData3"});

$('#showData1').sortable({
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        $.ajax({
        	url : 'action.php',
        	method : 'POST',
            data : data,
            success:function(data) {
            	fetch_me ();
            }
        });
    }
});

$('#showData2').sortable({
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
        data += '&listing_id=' + 1;
        console.log(data);
        $.ajax({
        	url : 'action.php',
        	method : 'POST',
            data : data,
            success:function(data) {
            	fetch_me ();
            }
        });
    }
});

$('#showData3').sortable({
    update: function (event, ui) {
        var data = $(this).sortable('serialize');
      
    }
});


/*Fetch Record*/
function fetch_me () {
$.ajax({
		url : "action.php",
		method : "POST",
		data : {stat:1},
		dataType:"json",
		success :function(data){
			var html = '';
			var html1 = '';
			var html2 = '';
        	var i;
        	for (i=0;i<data.length;i++){
        		if (data[i].status == 0) {
        			html +='<li id='+'item-'+data[i].id+'><div class="card">'+
						  '<div class="card-body">'+
						    '<h6 class="card-title" id="todo_title">'+data[i].title+
						    	' <i class="fa fa-circle to-do" aria-hidden="true"></i></h6>'+
						    '<p>'+data[i].description+'</p>'+
						    
						    '<div class="btn-group btn-group-sm">'+
							  '<button type="button" class="btn btn-light btn-edit"  id="btn_edit" value='+data[i].id+'>'+
							  	'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'+
							  '</button>'+
							  '<button type="button" id="btn_delete" class="btn btn-light btn-delete" value='+data[i].id+'>'+
							  	'<i class="fa fa-trash" aria-hidden="true"></i>'+
							  '</button>'+
							'</div>'+
						  '</div>'+
						'</div>'+'</li>'			
        		} 
        		$("#showData").html(html);
        		if(data[i].status == 1) {
        			html1 += '<li id='+'item-'+data[i].id+'><div class="card" id="doingFetch">'+
						  '<div class="card-body">'+
						    '<h6 class="card-title" id="todo_title">'+data[i].title+
						    	' <i class="fa fa-circle doing" aria-hidden="true"></i></h6>'+
						    '<p>'+data[i].description+'</p>'+
						    
						    '<div class="btn-group btn-group-sm">'+
							  '<button type="button" class="btn btn-light btn-edit" value='+data[i].id+'>'+
							  	'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'+
							  '</button>'+
							  '<button type="button" class="btn btn-light btn-delete" value='+data[i].id+'>'+
							  	'<i class="fa fa-trash" aria-hidden="true"></i>'+
							  '</button>'+
							'</div>'+
						  '</div>'+
						'</div>'+'</li>'		
        		} 
        		$("#showData1").html(html1); 
        		if (data[i].status == 2){
        			html2 += '<li id='+'item-'+data[i].id+'><div class="card card-transparent" id="doneFetch">'+
						  '<div class="card-body" style="background-color: rgba(245, 245, 245, 0.4);">'+
						    '<h6 class="card-title" id="todo_title">'+data[i].title+
						    	' <i class="fa fa-circle done" aria-hidden="true"></i></h6>'+
						    '<p>'+data[i].description+'</p>'+
						   	'<small class="text-success font-italic font-weight-light"  >This task has been marked done</small>'+
						  '</div>'+
						'</div>'+'</li>'		
        		}
        		$("#showData2").html(html2);	 
        	}
		}
	});
}

/*Add Data*/
$("#taskAddBtn").click(function(){
	var data = $('#taskForm').serialize();
	var valSuccess ="";

	var title = $("#toDotitle").val();
	var description = $('#toDoDes').val();
	var t_date = $("#toDoDate").val();

	if (title == '') {
		$("#toDotitle").addClass('is-invalid');
		$("#t_error").html("Title cannot be empty");
		$("#t_error").addClass('invalid-feedback');

	} else {
		$("#toDotitle").addClass('is-valid');
		$("#toDotitle").removeClass('is-invalid');
		$("#t_error").removeClass('invalid-feedback');
		$("#t_error").html("");
		valSuccess +='1';
	} if (t_date == '') {
		$("#toDoDate").addClass('is-invalid');
		$("#d_error").html("Please choose a date");
		$("#d_error").addClass('invalid-feedback');
	} else {
		$("#toDoDate").addClass('is-valid');
		$("#toDoDate").removeClass('is-invalid');
		$("#d_error").removeClass('invalid-feedback');
		$("#d_error").html("");
		valSuccess +='2';
	}

	if (valSuccess == "12") {
		$.ajax({
			url : "action.php",
			method : "POST",
			data : data,
			success :function(data){
					$('#taskForm')[0].reset();
					$("#toDoDate").removeClass('is-valid');
					$("#toDotitle").removeClass('is-valid');
					$("#s_slert").show();
					$("#s_slert").html('Successfully added new task.. !');
					$("#s_slert").fadeOut(3000);
					fetch_me ();
			}
		});
	}
});

/*Edit*/
$('#showData,#showData1').on('click', '.btn-edit', function () {
	var editVal = $(this).val();

	$.ajax({
		url : "action.php",
		method : "post",
		data : {val:editVal},
		dataType:"json",
		success:function(data){
        	var i;
        	for (i=0;i<data.length;i++){
        		$('#hiddID').val(data[i].id);
        		$('#toDotitle').val(data[i].title);
        		$('#toDotitle').attr('name','updateTitle');
        		$('#toDoDes').val(data[i].description);
        		$('#toDoDate').val(data[i].t_date);
        		$('#taskAddBtn').hide();
        		$('#taskUpdateBtn').show();        		
        	}
		}	
	})
});

/*Edit Update*/
$("#taskUpdateBtn").click(function(){
	var data = $('#taskForm').serialize();
	var valSuccess ="";

	var title = $("#toDotitle").val();
	var description = $('#toDoDes').val();
	var t_date = $("#toDoDate").val();

	if (title == '') {
		$("#toDotitle").addClass('is-invalid');
		$("#t_error").html("Title cannot be empty");
		$("#t_error").addClass('invalid-feedback');

	} else {
		$("#toDotitle").addClass('is-valid');
		$("#toDotitle").removeClass('is-invalid');
		$("#t_error").removeClass('invalid-feedback');
		$("#t_error").html("");
		valSuccess +='1';
	} if (t_date == '') {
		$("#toDoDate").addClass('is-invalid');
		$("#d_error").html("Please choose a date");
		$("#d_error").addClass('invalid-feedback');
	} else {
		$("#toDoDate").addClass('is-valid');
		$("#toDoDate").removeClass('is-invalid');
		$("#d_error").removeClass('invalid-feedback');
		$("#d_error").html("");
		valSuccess +='2';
	}

	if (valSuccess == "12") {
		var action = "update";
		$.ajax({
			url : "action.php",
			method : "POST",
			data : data,
			success :function(data){
				console.log(data)
				$('#toDotitle').attr('name','toDotitle'); 
				$('#taskForm')[0].reset();
				$("#toDoDate").removeClass('is-valid');
				$("#toDotitle").removeClass('is-valid');
				$("#s_slert").show();
				$("#s_slert").html('Successfully Updated.. !');
				$("#s_slert").fadeOut(3000);
				$('#taskAddBtn').show();
        		$('#taskUpdateBtn').hide()

				fetch_me ();

			}
		});
	}
});

/*Delete Record*/ 
$('#showData,#showData1').on('click', '.btn-delete', function () {
	var deleteVal = $(this).val();
	$("#delMOdal").modal('show');

	$("#delConfirm").click(function(){
		$("#delMOdal").modal('hide');
		$.ajax({
			url :"action.php",
			method : "post",
			data : {st:deleteVal},
			dataType : 'json',
			success:function(data) {
				fetch_me ();
			}
		})
	})
});

});