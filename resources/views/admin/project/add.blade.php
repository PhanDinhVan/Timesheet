@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

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
            <form action="admin/project/add" method="POST" id="add_project">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" name="name" placeholder="Please enter project name" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Customer Name</label>
                        <select class="form-control" name="customer_id">
                            <option></option>
                            @foreach($customer as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">Start Date</label>
                        <input class="form-control date" type="text" name="start_date" placeholder="Please select start date">
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">End Date</label>
                        <input class="form-control date" type="text" name="end_date" placeholder="Please select end date">
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
                        <label class="col-form-label">Department</label>
                        <select class="form-control" name="department">
                            <option></option>
                            @foreach($employee_type as $value)
                            <option value="{{$value->type}}">{{$value->type}}</option>
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
                            <input type="radio" id="inlineRadio1"  name="status" value="1">
                            <label for="inlineRadio1"> Active </label>
                        </div>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio2" name="status" value="0" checked>
                            <label for="inlineRadio2"> Close </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('add_project').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Add</button>
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


