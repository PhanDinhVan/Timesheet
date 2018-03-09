@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<link href="css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="js/datepicker/bootstrap-datepicker.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            @if(count($errors) > 0)
                <div class="alert alert-danger errors" id="error">
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                </div>
            @endif
            <h2 class="m-t-0 header-titles"> <b>new project</b></h2>
            <form action="admin/project/edit/{{$project->id}}" method="POST" id="edit_project">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" name="name" value="{{$project->name}}" placeholder="Please enter project name" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Customer Name</label>
                        <select class="form-control" name="customer_id">
                            @foreach($customer as $value)
                            <option 
                                @if($value->id == $project->customer_id) {{"selected"}} @endif 
                                value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Start Date</label>
                        <input class="form-control date" type="text" name="start_date" value=" <?php if($project->start_date) echo date('Y-m-d', strtotime($project->start_date)); else echo ' '; ?> ">
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">End Date</label>
                        <input class="form-control date" type="text" name="end_date" value=" <?php if($project->end_date) echo date('Y-m-d', strtotime($project->end_date)); else echo ' '; ?> ">
                    </div>
                    <!-- datepicker -->
                    <script type="text/javascript">
                        $('.date').datepicker({  
                           format: 'yyyy-mm-dd',
                           autoclose: true
                         });  
                    </script>
                </div>

                <div class="form-group row">
                    <div class=" col-md-6 offset-md-3">
                        <label class="col-form-label">Department </label>
                        <select class="form-control" name="department">
                            @foreach($employee_type as $value)
                            <option 
                                @if($value->type == $project->department) {{"selected"}} @endif 
                                value="{{$value->type}}">{{$value->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <div>
                            <label class="col-form-label">Status</label>
                        </div>

                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio1"  name="status" value="1"
                                @if($project->status == 1)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio1"> Active </label>
                        </div>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio2" name="status" value="0" 
                                @if($project->status == 0)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio2"> Close </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('edit_project').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Save</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/project/list') }}">Cancel</a>
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

