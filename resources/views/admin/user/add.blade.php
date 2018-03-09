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
            <h2 class="m-t-0 header-titles"><b>new users</b> </h2>
            <form action="admin/user/add" method="POST" id="add_user">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">First Name</label>
                        <input class="form-control" name="firstname" placeholder="Please enter your name">
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Last Name</label>
                        <input class="form-control" name="lastname" placeholder="Please enter your name" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <label class="col-form-label">Username</label>
                        <input class="form-control" type="email" name="email" placeholder="Please enter your email" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Employee Type</label>
                        <select class="form-control" name="employee_type_id">
                            <option></option>
                            @foreach($employee_types as $value)
                            <option value="{{$value->id}}">{{$value->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <label class="col-form-label">Start Date</label>
                        <input class="date form-control" type="text" name="start_date">
                    </div>
                    <!-- datepicker -->
                    <script type="text/javascript">
                        $('.date').datepicker({  
                           format: 'yyyy-mm-dd',
                           autoclose: true
                         });  
                    </script>

                    <div class="col-md-3">
                        <label class="col-form-label">End Date</label>
                        <input class="enddate form-control" type="text" name="end_date">
                    </div>
                    <!-- datepicker -->
                    <script type="text/javascript">
                        $('.enddate').datepicker({  
                           format: 'yyyy-mm-dd',
                           autoclose: true
                         });  
                    </script>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <label class="col-form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Please enter your password" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Re Password</label>
                        <input class="form-control" type="password" name="passwordAgain" placeholder="Please confirm password" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <div>
                            <label class="col-form-label">Position</label>
                        </div>

                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio1"  name="quyen" value="1">
                            <label for="inlineRadio1"> Admin </label>
                        </div>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio2" name="quyen" value="0" checked>
                            <label for="inlineRadio2"> User </label>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('add_user').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Add</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/user/list') }}">Cancel</a>
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
    <script src="js/error/error.js"></script>
    <script type="text/javascript">
        // var err = document.getElementById('error').innerText;
        var error = document.getElementById('error');
        if(error != null) {
            //err = document.getElementById('error').innerText;
            var err = $('#error').text();
            //cut space
            err = err.replace(/\s+/g, '');
            if(err == 'email_exits') {
                $('#user_exits').modal('show');
            }
        }
    </script>
    
@endsection




