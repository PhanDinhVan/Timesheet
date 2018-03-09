@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Users List</b></h2>

            <div class="table-responsive">
                <div class="col-lg-7">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif
                </div>

                <table class="table table-striped add-edit-table" id="users_list">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Employee Type</th>
                            <th>Position </th>
                            <th class="center">Start Date</th>
                            <th class="center">End Date </th>
                            <th>Status</th>
                            <th class="center">Actions</th>
                        
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($user as $value)
                            <tr class="id{{$value->id}} gradeX">
                                <td>{{$value->id}}</td>
                                <td>{{$value->username}}</td>
                                <td>{{$value->firstname}}</td>
                                <td>{{$value->lastname}}</td>
                                <td>{{$value->employee_types->type}}</td>
                                <td>
                                    @if($value->position == 1)
                                      {{"Admin"}}
                                    @else
                                      {{"User"}}
                                    @endif
                                </td>
                                <td class="center"><?php echo date('Y-m-d', strtotime($value->start_date)); ?></td>
                                <td class="center">{{date('Y-m-d', strtotime($value->end_date))}}</td> 
                                <td>
                                    @if($value->status == 1)
                                      {{"Active"}}
                                    @else
                                      {{"Close"}}
                                    @endif
                                </td>

                                <td class="actions center">
                                    <a href="<?=Request::root()?>/admin/user/edit/{{$value->id}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ $value->id }}" class="on-default remove-row delete-user" data-toggle="modal" data-target="#delete_user" data-placement="top" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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

@endsection