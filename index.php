<?php 
include "action.php"; 
require "tbl_create.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Todo - Application</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
  	<script src="https://use.fontawesome.com/d04a2cff2e.js"></script>
  	<script src="main.js"></script>
  	<style type="text/css">
  		.text-head {
  			color: white;
  		}
  		.to-do {
  			color: grey;
  			font-size: 13px;
  		}
  		.doing {
  			color: skyblue;
  			font-size: 13px;
  		}
  		.done {
  			color: lightgreen;
  			font-size: 13px;
  		}

  	</style>
</head>
</head>
<body>
<div class="container-fluid">

	<nav class="navbar navbar-expand-sm bg-light">
		<h3>TODO APPLICATION</h3>
		<h6>&nbsp organize work and life with Todo</h6>
	</nav><br>
	
	<div class="row">
		<div class="col-sm-3">
			<div class="card ">
				<div class="card-header">Add your new task here..</div>
			  <div class="card-body">
			  	
			  	<div class="alert alert-success" role="alert" id="s_slert" ></div>
			  	<form onsubmit="return false" id="taskForm">
			  		<input type="hidden" id="hiddID" name="hiddID">
				  <div class="form-group">	
				    <label for="toDotitle">Title</label>
				    <input type="text" class="form-control" name="toDotitle" placeholder="Enter your to-do heading" id="toDotitle">
				    <small id="t_error"></small>
				  </div>

				  <div class="form-group">
				    <label for="toDoDes">Description</label>
				    <textarea class="form-control" id="toDoDes" name="toDoDes" placeholder="Describe your task" rows="3"></textarea>
				  </div>

				  <div class="form-group">
				    <label for="toDotitle">Date</label>
				    <input type="date" class="form-control" name="toDoDate" id="toDoDate">
				    <small id="d_error"></small>
				  </div>
		
				  <button type="submit" class="btn btn-info" id="taskAddBtn">
				  	<i class="fa fa-plus" aria-hidden="true"></i> Add Task</button>

				  <button type="submit" class="btn btn-danger" id="taskUpdateBtn">
				  	<i class="fa fa-plus" aria-hidden="true"></i> Update</button>

				</form>
			  </div>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="card" id="containerCard">
			  <div class="card-body" style="height: 600px">
			  	<div class="row">
			  	<div class="col-sm-4">
			  		<div class="card" id="todoCard">
					  <div class="card-header bg-secondary text-head">Todo</div>
					  <div class="card-body overflow-auto" style="max-height: 500px;">
					  	<!-- To-do Items -->
					  	<ul id="showData" style="list-style-type:none;min-height: 100px"></ul>
						<!-- *** -->
					  </div>
					</div>
			  	</div>
			  	<div class="col-sm-4">
			  		<div class="card"  id="doingCard">
					  <div class="card-header bg-info text-head">Doing</div>
					  <div class="card-body overflow-auto" style="max-height: 500px;">
					  	<!-- Doing Items -->
					  	<ul id="showData1" style="list-style-type:none;min-height: 100px"></ul>
						<!-- *** -->
					  </div>
					</div>
			  	</div>
			  	<div class="col-sm-4">
			  		<div class="card" id="doneCard">
					  <div class="card-header bg-success text-head">Done</div>
					  <div class="card-body overflow-auto" style="max-height: 500px;">
					  	<!-- Done Items -->
					  	<ul id="showData2" style="list-style-type:none;min-height: 100px;">
					  	</ul>
						<!-- *** -->
					  </div>
					</div>
			  	</div>
			  </div>
			  </div>
			</div>
		</div>
	</div>
</div>

	<div class="modal" tabindex="-1" role="dialog" id="delMOdal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	         Are you sure want to Delete <h5 id="delText"></h5>
	         <button type="button" class="btn btn-primary btn-sm right" id="delConfirm">Confirm</button>
	      </div>
	    </div>
	  </div>
	</div>


<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
     
    </div>
  </div>
</div>

</body>
</html>