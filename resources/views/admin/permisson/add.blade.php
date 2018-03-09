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
            <h2 class="m-t-0 header-titles"> <b>new permisson</b></h2>
            <form action="admin/permisson/add" method="POST" id="add_permisson">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-6 offset-md-3">
                        <label class="col-form-label">Username</label>
                        <select class="form-control" name="username">
                            <option></option>
                            @foreach($user as $value)
                            <option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class=" col-md-6 offset-md-3">
                        <label class="col-form-label">Project Name</label>
                        <select class="form-control" name="projectname">
                            <option></option>
                            @foreach($project as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('add_permisson').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Add</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/permisson/list') }}">Cancel</a>
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
            if(err == 'permission_exits') {
                $('#permission_exits').modal('show');
            }
        }
    </script>
@endsection


