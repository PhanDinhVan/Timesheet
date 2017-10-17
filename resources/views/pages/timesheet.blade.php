@extends('layout.index')

<head>
    <link href="admin_asset/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="admin_asset/build/css/custom.min.css" rel="stylesheet">
</head>

<div class="top_nav" style="margin-top: -5.5%;">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="images/img.jpg" alt="">@if(Auth::check()) {{Auth::user()->lastname}} @endif
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            @if(Auth::check())
            <li><a href="#"><i class="fa fa-cog pull-right"></i> Settings </a></li>
            <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out </a></li>
            @else
                return redirect('login'); 
            @endif
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<!-- Page Content --> 


<div class="row">
  	<div class="col-md-6">
    	
      	<div class="x_content">
        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#yourModal">
        		<i class="fa fa-plus pull-left" style="margin-top: 5%;"></i>Add Time
        	</button>
      	</div>
    </div>
    <div class="btn-group" data-toggle="buttons" style="float: right; padding-right: 2%;">
    	<label class="btn btn-default active">
      		<input type="radio" name="options" id="option1"> Day
    	</label>
    	<label class="btn btn-default">
      		<input type="radio" name="options" id="option2"> Week
    	</label>
    	<label class="btn btn-default">
      		<input type="radio" name="options" id="option3"> Month
    	</label>
  	</div>
               
</div>


<!-- Model trong laravel -->
<div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{"Add entry"}}</h4>
      </div>
      <div class="modal-body">
       <form action="admin/user/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Project Name</label>
                                <select class="form-control" name="project_id">
                                    @foreach($project as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Task Name</label>
                                <select class="form-control" name="taskname">
                                    @foreach($task as $value)
                                    <option value="{{$value->id}}">{{$value->taskname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <select class="form-control" name="username">
                                    
                                    <option value="{{Auth::user()->username}}">{{Auth::user()->lastname}}</option>
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
   								<input class="date form-control" type="text" name="start_date">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
							    $('.date').datepicker({  
							       format: 'yyyy-mm-dd'
							     });  
							</script>

							<div class="form-group">
                                <label>End Date</label>
   								<input class="enddate form-control" type="text" name="end_date">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
							    $('.enddate').datepicker({  
							       format: 'yyyy-mm-dd'
							     });  
							</script>
                        <form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- /#page-wrapper -->	

@endsection