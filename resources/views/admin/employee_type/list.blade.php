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
                
                <table class="table table-striped table-bordered table-hover" id="employee_type">
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper --> 

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      $('#employee_type').dataTable({
              'paging':   true,  // Table pagination
              'ordering': true,  // Column ordering
              'info':     false,  // Bottom left status text
              'responsive': true, // https://datatables.net/extensions/responsive/examples/
              'bLengthChange': false, // hide records per page
              // 'searching': false, // hide Search
              // 'rowsGroup': [0], // gop row of column 
              
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
            }, 
            { "targets": [3],
             "orderable": false,
             "type": "string"
            }      
       
            
            ],
              buttons: [
                  {extend: 'copy',  className: 'btn-sm' },
                  {extend: 'csv',   className: 'btn-sm' },
                  {extend: 'excel', className: 'btn-sm', title: 'XLS-File'},
                  {extend: 'pdf',   className: 'btn-sm', title: $('title').text() },
                  {extend: 'print', className: 'btn-sm' }
              ]
       
      });

    })
  </script>
@endsection
