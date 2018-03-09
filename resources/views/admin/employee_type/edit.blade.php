@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Employee Type
                        <small>Edit</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                        
                        @if(count($errors) > 0)
                            <div class="alert alert-danger" id="error">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                    @break
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success customer_fr">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/employee_type/edit/{{$employee_type->id}}" method="POST" id="edit_employee_type">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group customer_fr">
                                <label>Employee Type</label>
                                <input class="form-control" name="emp_type" value="{{$employee_type->type}}" placeholder="Please enter employee type" />
                            </div>
                            <div class="form-group customer_fr">
                                <button type="submit" class="btn btn-success right_add">Save</button>
                                <a class="btn btn-default btn-close right_add cancel" href="{{ URL::to('admin/employee_type/list') }}">Cancel</a>
                            </div>
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


