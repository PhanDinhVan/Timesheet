@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            @if(session('error'))
                <div class="alert alert-danger errors" id="error">
                    {{session('error')}}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                </div>
            @endif
            <h2 class="m-t-0 header-titles"> <b>edit tasks</b></h2>
            <form action="admin/task/edit/{{$task->id}}" method="POST" id="edit_task">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Project Name</label>
                        <select class="form-control" name="project_id">
                            @foreach($project as $value)
                            <option 
                                @if($task->project_id == $value->id) {{"selected"}} @endif 
                                value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Task Name</label>
                        <input class="form-control" name="taskname" value="{{$task->taskname}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-6 offset-md-3">
                        <label class="col-form-label">Comments</label>
                        <textarea class="form-control" name="comments" rows="4" cols="80" id="myTextArea">
                            {{$task->comments}}
                        </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <div>
                            <label class="col-form-label">Availability</label>
                        </div>
                        
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio2" name="availability" value="1" 
                                @if($task->availability == 1)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio2"> Yes </label>
                        </div>

                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio1"  name="availability" value="0" 
                                @if($task->availability == 0)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio1"> No </label>
                        </div>
                    </div>
                    
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('edit_task').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Save</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/task/list') }}">Cancel</a>
                    </div>
                </div>
                
            </form>
        </div>
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


