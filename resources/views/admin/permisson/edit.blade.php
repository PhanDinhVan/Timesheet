@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> -->

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Permisson
                        <small>Edit</small>
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

                        @if(session('error'))
                            <div class="alert alert-danger" id="error">
                                {{session('error')}}
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success customer_fr">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/permisson/edit/{{$permisson->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group customer_fr">
                                <label>Username</label>
                                <select class="form-control" name="username">
                                    @foreach($user as $value)
                                    <option 
                                        @if($value->id == $permisson->user_id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group customer_fr">
                                <label>Project Name </label>
                                <select class="form-control" name="projectname">
                                    @foreach($project as $value)
                                    <option 
                                        @if($value->id == $permisson->project_id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div class="form-group customer_fr">
                                <button type="submit" class="btn btn-success right_add">Save</button>
                                <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/permisson/list') }}">Cancel</a>
                            </div>
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
    <script type="text/javascript">
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'permission_exits') {
                $('#permission_exits').modal('show');
            }
        }
    </script>
@endsection


