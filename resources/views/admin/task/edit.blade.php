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
                        <form action="admin/task/edit/{{$task->id}}" method="POST" id="edit_task">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group start_date_fr">
                                <label>Project Name</label>
                                <select class="form-control" name="project_id">
                                    @foreach($project as $value)
                                    <option 
                                        @if($task->project_id == $value->id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group end_date_fr">
                                <label>Task Name</label>
                                <input class="form-control" name="taskname" value="{{$task->taskname}}" placeholder="Please enter employee type" />
                            </div>
                            
                            <div class="form-group customer_fr">
                                <label>Comments</label>
                                <textarea class="form-control" name="comments" placeholder="Please enter employee type" rows="4" cols="80" id="myTextArea">
                                    {{$task->comments}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label class="availability">Availability</label>
                                <label class="radio-inline">
                                    <input name="availability" value="0" type="radio"
                                        @if($task->availability == 0)
                                            {{"checked"}}
                                        @endif
                                    >No
                                </label>
                                <label class="radio-inline">
                                    <input name="availability" value="1" type="radio"
                                        @if($task->availability == 1)
                                            {{"checked"}}
                                        @endif
                                    >Yes
                                </label>
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

        // function remove space of textarea
        removeTextAreaWhiteSpace();
        function removeTextAreaWhiteSpace() {
            var myTxtArea = document.getElementById('myTextArea');
            myTxtArea.value = myTxtArea.value.replace(/^\s*|\s*$/g,'');
        }
    </script>
@endsection


