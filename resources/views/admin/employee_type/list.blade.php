@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
    
<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7">
                  @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}    
                    </div>
                  @endif
                </div>
                
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Employee Type</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employee_type as $value)
                        <tr class="odd gradeX">
                          <td>{{$value->id}}</td>
                          <td>{{$value->type}}</td>
                          <td><i class="fa fa-trash-o"></i><a href="admin/employee_type/delete/{{$value->id}}"> Delete</a></td>
                          <td><i class="fa fa-pencil-square-o"></i> <a href="admin/employee_type/edit/{{$value->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="float: right;">{{ $employee_type->links() }}</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper --> 

@endsection
