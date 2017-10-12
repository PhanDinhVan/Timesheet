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
                            <th class="thcenter">ID</th>
                            <th class="thcenter">Employee Type</th>
                            <th class="thcenter">Delete</th>
                            <th class="thcenter">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employee_type as $value)
                        <tr class="odd gradeX" align="center">
                          <td class="thcenter">{{$value->id}}</td>
                          <td class="thcenter">{{$value->type}}</td>
                          <td class="thcenter"><i class="fa fa-trash-o"></i><a href="admin/user/delete/{{$value->id}}"> Delete</a></td>
                          <td class="thcenter"><i class="fa fa-pencil-square-o"></i> <a href="admin/user/edit/{{$value->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper --> 

 @endsection

<style type="text/css">
    .thcenter{
        text-align: center;
        font-size: 13px;
    }
</style>