@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

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
            <h2 class="m-t-0 header-titles"> <b>edit employee type</b></h2>
            <form action="admin/employee_type/edit/{{$employee_type->id}}" method="POST" id="edit_employee_type">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-6 offset-md-3">
                        <label class="col-form-label">Employee Type</label>
                        <input class="form-control" name="emp_type" value="{{$employee_type->type}}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('add_employee_type').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add">Save</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/employee_type/list') }}">Cancel</a>
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
            if(err == 'employee_exits') {
                $('#employee_exits').modal('show');
            }
        }
    </script>
@endsection


