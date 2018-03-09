@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Permisson Users Projects</b></h2>

            <div class="table-responsive">
                <div class="col-lg-7">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif
                </div>

                <table class="table table-striped add-edit-table" id="permisson_users_projects">

                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Project Name</th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($permisson as $key => $value)
                            <tr class="id{{$value->id}} gradeX">
                                <td>{{$value->user->firstname}} {{$value->user->lastname}}</td>
                                <td>{{$value->project->name}}</td>
                                <td class="actions center">
                                    <a href="<?=Request::root()?>/admin/permisson/edit/{{$value->id}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ $value->id }}" class="on-default remove-row delete-permisson" data-toggle="modal" data-target="#delete_permisson" data-placement="top" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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


@section('script')
  
  <script type="text/javascript">
    $(document).ready(function(){

        // admin/permisson/list
        $('#permisson_users_projects').dataTable({
            'paging':   true,  // Table pagination
            'ordering': true,  // Column ordering
            'info':     false,  // Bottom left status text
            'responsive': true, // https://datatables.net/extensions/responsive/examples/
            'bLengthChange': false, // hide records per page
            // 'searching': false, // hide Search
            'rowsGroup': [0], // gop row of column 
          
            oLanguage: {
                sSearch:      'Search: ',
                sLengthMenu:  '_MENU_ records per page',
                zeroRecords:  'Nothing found - sorry',
                infoEmpty:    'No records available',
                infoFiltered: '(filtered from MAX total records)'
            },
            // Datatable Buttons setup
            dom: '<"html5buttons"B>lTfgitp',
            columnDefs: [  

                // dinh nghia cho delete edit
                { "targets": [2],
                 "orderable": false,
                 "type": "string"
                }    
            ]
        });

    })

</script>

@endsection