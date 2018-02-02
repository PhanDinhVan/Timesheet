@extends('admin.layout.index')
@section('content')


<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tasks
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
                <table class="table table-striped table-bordered table-hover" id="tasks_list">
                      <thead>
                        <tr>
                          <th>Project Name</th>
                          <th>Taks Name</th>
                          <th>Comments</th>
                          <th>Availability </th>
                          <th>Delete</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody id="myTable">
                      	@foreach($task as $value)
                        <tr>
                          <td class="project_Name">{{$value->project->name}}</td>
                          <td>{{$value->taskname}}</td>
                          <td>{{$value->comments}}</td>
                          <td>
                            @if($value->availability == 1)
                              {{"Yes"}}
                            @else
                              {{"No"}}
                            @endif
                          </td>
                          <td><i class="fa fa-trash-o"></i><a href="admin/task/delete/{{$value->id}}"> Delete</a></td>
                          <td><i class="fa fa-pencil-square-o"></i> <a href="admin/task/edit/{{$value->id}}">Edit</a></td>
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
@endsection

@section('script')
  
  <script type="text/javascript">
    $(document).ready(function(){

      $('#tasks_list').dataTable({
              'paging':   true,  // Table pagination
              'ordering': true,  // Column ordering
              'info':     false,  // Bottom left status text
              'responsive': true, // https://datatables.net/extensions/responsive/examples/
              'bLengthChange': false, // hide records per page
              // 'searching': false, // hide Search
              'rowsGroup': [0], // gop row of column 
              
              // Text translation options
              // Note the required keywords between underscores (e.g MENU)
        
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
            
            // { "targets": [0],  // thu tu column
            //  "visible": true,  // cho phep hien thi
            //  "searchable": true, // cho phep search
            //  "orderable": false,  // cho phep sap xep
            //  "type": "string"
            // }, 

            // dinh nghia cho delete edit
            { "targets": [4],
             "orderable": false,
             "type": "string"
            }, 
            { "targets": [5],
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
