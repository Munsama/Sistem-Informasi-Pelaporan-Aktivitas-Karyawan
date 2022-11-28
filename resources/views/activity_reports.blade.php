@extends('master')

@section ('title')
<title>ISDARE - Activity Report</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Activity Report</h1>
<p class="mb-4">In this page you can edit the efficiency and competency of your subordinate activity/work.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> DataTables of Activity Report</h6>
  </div>
  <div class="card-body">
    @if (session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

      <div class="row input-daterange">
          <div class="col-md-2">
              <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"  readonly="" />
          </div>
          <div class="col-md-2">
              <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"  readonly="" />
          </div>
          <div class="col-md-4">
              <button type="button" name="filter" id="filter" class="btn btn btn-info">Filter</button>
              <button type="button"  name="refresh" id="refresh" class="btn btn-light">Refresh</button>
          </div>
      </div>
      <br />

   <div class="table-responsive">
    <table class="table table-bordered table-hover" id="activity_report_table" width="100%">
           <thead>
            <tr>
                <th> No</th>
                <th> Date</th>
                <th> Employee Name</th>
                <th> Classification</th>
                <th> Equipment</th>
                <th> Start</th>
                <th> Finish</th>
                <th> Description</th>
                <th> Report</th>
                <th> Efficiency</th>
                <th> Competency</th>
                <th> Action </th>
            </tr>
           </thead>
           
           <tfoot>
            <tr>
                <th> No</th>
                <th> Date</th>
                <th> Employee Name</th>
                <th> Classification</th>
                <th> Equipment</th>
                <th> Start</th>
                <th> Finish</th>
                <th> Description</th>
                <th> Report</th>
                <th> Efficiency</th>
                <th> Competency</th>
                <th> Action </th>
            </tr>
            </tfoot>

              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
 
<script>
$(document).ready(function(){
$('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });

 load_data();

 function load_data(from_date = '', to_date = '')
 {
 $('#activity_report_table').DataTable({
  processing: true,
  serverSide: false,
  ajax:{
   url: "{{ route('crud_activity_report.index') }}",
   data:{from_date:from_date, to_date:to_date}
  },
  columns:[
   {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable:false},
   {data: 'date', name: 'date'},
   {data: 'name', name: 'employee'},
   {data: 'classification_name', name: 'classification'},
   {data: 'equipment_name', name: 'equipment'},
   {data: 'start_time', name: 'start'},
   {data: 'finish_time', name: 'finish'},
   {data: 'description', name: 'description'},
   {data: 'report', name: 'report'},
   {data: 'efficiency_id', name: 'efficiency'},
   {data: 'competency_id', name: 'comptency'},
   { data: 'action', name: 'action', orderable: false, searchable:false}
  ]
 });
}

$('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#activity_report_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#activity_report_table').DataTable().destroy();
  load_data();
 });

});
</script>
@endsection