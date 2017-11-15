@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Task
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
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/task/edit/{{$task->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Project Name</label>
                                <select class="form-control" name="project_id">
                                    @foreach($project as $value)
                                    <option 
                                        @if($task->project_id == $value->id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Task Name</label>
                                <input class="form-control" name="taskname" value="{{$task->taskname}}" placeholder="Please enter employee type" />
                            </div>
                            
                            <div class="form-group">
                                <label>Comments</label>
                                <input class="form-control" name="comments" value="{{$task->comments}}" placeholder="Please enter employee type" />
                            </div>
                            <div class="form-group">
                                <label>Availability</label>
                                <select class="form-control" name="availability">
                                    <option value=0
                                        @if($task->availability == 0) {{"selected"}} @endif 
                                        >No
                                    </option>
                                    <option value=1
                                        @if($task->availability == 1) {{"selected"}} @endif 
                                        >Yes
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Save</button>
                            <!-- <button type="reset" class="btn btn-default">Reset</button> -->
                            <a class="btn btn-default btn-close" href="{{ URL::to('admin/task/list') }}">Cancel</a>
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


