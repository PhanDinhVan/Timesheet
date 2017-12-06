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
                        <small>Add new</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

                        @if(session('error'))
                            <div class="alert alert-danger" id="error">
                                {{session('error')}}
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/task/add" method="POST" id="add_task">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Task Name</label>
                                <input class="form-control" name="taskname" placeholder="Please enter task name" />
                            </div>
                            <div class="form-group">
                                <label>Project Name</label>
                                <select class="form-control" name="project_id">
                                    <option></option>
                                    @foreach($project as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Comments</label>
                                <input class="form-control" name="comments" placeholder="Please enter comments" />
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a class="btn btn-default btn-close" href="{{ URL::to('admin/task/list') }}">Cancel</a>
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
    <script src="{{asset('js/error/error.js')}}"></script>
    <script type="text/javascript">
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'taskname_exits') {
                $('#taskname_exits').modal('show');
            }
        }
    </script>
@endsection


