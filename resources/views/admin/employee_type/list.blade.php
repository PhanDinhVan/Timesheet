@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Employee Type List</b></h2>

            <div class="table-responsive">
                <div class="col-lg-7">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif
                </div>

                <table class="table table-striped add-edit-table" id="employee_type">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Type</th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($employee_type as $value)
                            <tr class="id{{$value->id}} gradeX">
                                <td>{{$value->id}}</td>
                                <td>{{$value->type}}</td>
                                <td class="actions center">
                                    <a href="<?=Request::root()?>/admin/employee_type/edit/{{$value->id}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ $value->id }}" class="on-default remove-row delete-employee-type" data-toggle="modal" data-target="#delete_employee_type" data-placement="top" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.modal.modal_delete')

<!-- /#page-wrapper --> 

@endsection
