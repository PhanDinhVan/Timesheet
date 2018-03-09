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
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}} <br>
                    @endforeach
                </div>
            @endif
            <h2 class="m-t-0 header-titles"> <b>edit users</b></h2>
            <form action="admin/user/edit/{{$user->id}}" method="POST" id="edit_user">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-3 offset-md-3">
                        <label class="col-form-label">First Name</label>
                        <input class="form-control" name="firstname" value="{{$user->firstname}}" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Last Name</label>
                        <input class="form-control" name="lastname" value="{{$user->lastname}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <label class="col-form-label">Username</label>
                        <input class="form-control" type="email" name="email" value="{{$user->username}}" readonly="" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Employee Type</label>
                        <select class="form-control" name="employee_type_id">
                            @foreach($employee_types as $value)
                            <option 
                                @if($user->employee_type_id == $value->id) {{"selected"}} @endif 
                                value="{{$value->id}}">{{$value->type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <label class="col-form-label">Start Date</label>
                        <input class="date form-control" type="text" name="start_date" value="{{date('Y-m-d', strtotime($user->start_date))}}">
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
                        <input class="enddate form-control" type="text" name="end_date" value="{{date('Y-m-d', strtotime($user->end_date))}}">
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
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label class="col-form-label">Change Password</label>
                        <input class="form-control password" type="password" name="password" id="password" placeholder="Please enter your password" disabled="" />
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label">Re Password</label>
                        <input class="form-control password" type="password" name="passwordAgain" placeholder="Please confirm password" disabled="" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <div>
                            <label class="col-form-label">Position</label>
                        </div>

                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio1"  name="quyen" value="1" 
                                @if($user->position == 1)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio1"> Admin </label>
                        </div>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio2" name="quyen" value="0" 
                                @if($user->position == 0)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio2"> User </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div>
                            <label class="col-form-label">Status</label>
                        </div>

                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio3"  name="status" value="1" 
                                @if($user->status == 1)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio3"> Active </label>
                        </div>
                        <div class="radio radio-info form-check-inline">
                            <input type="radio" id="inlineRadio4" name="status" value="0" 
                                @if($user->status == 0)
                                    {{"checked"}}
                                @endif
                            >
                            <label for="inlineRadio4"> Close </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('edit_user').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Save</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/user/list') }}">Cancel</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('js/error/error.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
 @endsection
