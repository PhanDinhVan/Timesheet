@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<link href="css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="js/datepicker/bootstrap-datepicker.js"></script>

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Project
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger" id="error">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success customer_fr">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/project/edit/{{$project->id}}" method="POST" id="edit_project">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group start_date_fr">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{$project->name}}" placeholder="Please enter project name" />
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Department </label>
                                <select class="form-control" name="department">
                                    @foreach($employee_type as $value)
                                    <option 
                                        @if($value->type == $project->department) {{"selected"}} @endif 
                                        value="{{$value->type}}">{{$value->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group start_date_fr">
                                <label>Start Date</label>
                                <input class="date form-control" type="text" name="start_date" value="{{$project->start_date}}">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
                                $('.date').datepicker({  
                                   format: 'yyyy-mm-dd',
                                   autoclose: true
                                 });  
                            </script>

                            <div class="form-group end_date_fr">
                                <label>End Date</label>
                                <input class="enddate form-control" type="text" name="end_date" value="{{$project->end_date}}">
                            </div>
                            <!-- datepicker -->
                            <script type="text/javascript">
                                $('.enddate').datepicker({  
                                   format: 'yyyy-mm-dd',
                                   autoclose: true
                                 });  
                            </script>

                            <div class="form-group customer_fr">
                                <label>Customer Name </label>
                                <select class="form-control" name="customer_id">
                                    @foreach($customer as $value)
                                    <option 
                                        @if($value->id == $project->customer_id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
							
                            <div class="form-group">
                                <label style="margin-right: 2%">Status</label>
                                <label class="radio-inline">
                                    <input name="status" value="1" type="radio"
                                        @if($project->status == 1)
                                            {{"checked"}}
                                        @endif
                                    >Active
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0" type="radio"
                                        @if($project->status == 0)
                                            {{"checked"}}
                                        @endif
                                    >Close
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
                            <!-- <button type="reset" class="btn btn-default">Reset</button> -->
                            <a class="btn btn-default btn-close" href="{{ URL::to('admin/project/list') }}">Cancel</a>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@include('error.messages')        

<!-- /#page-wrapper -->	

@endsection

@section('script')
    <!-- <script src="../resources/views/error/error.js"></script> -->
    <script src="{{asset('js/error/error.js')}}"></script>
    <script type="text/javascript">
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'projectname_exits') {
                $('#projectname_exits').modal('show');
            }
        }
    </script>
@endsection

