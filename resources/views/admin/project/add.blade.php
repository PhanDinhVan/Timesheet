@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Project
                        <small>Add new</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/project/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please enter project name" />
                            </div>
                            <div class="form-group">
                                <label>Department </label>
                                <select class="form-control" name="department">
                                    @foreach($employee_type as $value)
                                    <option value="{{$value->type}}">{{$value->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
   								<select class="form-control" name="status">
                                    <option value="{{$value=1}}">{{"Active"}}</option>
                                    <option value="{{$value=0}}">{{"Close"}}</option>
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

							<div class="form-group">
                                <label>Customer Name </label>
                                <select class="form-control" name="customer_id">
                                    @foreach($customer as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper -->	

@endsection


