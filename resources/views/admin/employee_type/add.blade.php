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
            <h2 class="m-t-0 header-titles"> <b>new employee type</b></h2>
            <form action="admin/employee_type/add" method="POST" id="add_employee_type">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group row">
                    <div class=" col-md-6 offset-md-3">
                        <label class="col-form-label">Employee Type</label>
                        <input class="form-control" name="emp_type" placeholder="Please enter employee type" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <a href="javascript:document.getElementById('add_employee_type').reset();">Clear all</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info right_add" id="target">Add</button>
                        <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/employee_type/list') }}">Cancel</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<!-- /#page-wrapper -->	

@endsection


@section('script')
    <!-- <script src="../resources/views/error/error.js"></script> -->
    <script src="{{asset('js/error/error.js')}}"></script>
@endsection


