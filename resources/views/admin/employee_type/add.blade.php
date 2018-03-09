@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> new employee type </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

                        @if(session('thongbao'))
                            <div class="alert alert-success customer_fr">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/employee_type/add" method="POST" id="add_employee_type">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group customer_fr">
                                <label>Employee Type</label>
                                <input class="form-control" name="emp_type" placeholder="Please enter employee type" />
                            </div>
                            <div class="form-group customer_fr">
                                <a href="javascript:document.getElementById('add_employee_type').reset();">Clear all</a>
                            </div>
                            <div class="form-group customer_fr">
                                <button type="submit" class="btn btn-success right_add">Add</button>
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
       
<!-- /#page-wrapper -->	

@endsection


@section('script')
    <!-- <script src="../resources/views/error/error.js"></script> -->
    <script src="{{asset('js/error/error.js')}}"></script>
@endsection


