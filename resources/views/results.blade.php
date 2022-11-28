@extends('master')
@section ('title')
<title>ISDARE - Result Report</title>
@endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Result Report</h1>
<p class="mb-4">In this page you can view the result of your subordinate activity/work.</p>
<!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> DataTables of Activity Report</h6>
    </div>
      <div class="card-body">
        
        <div class="row col-md-12 input-daterange">
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
                
                  <select name="department" id="department" class="col-md-3 form-control"> 
                    <option value="">Department Filter</option>
                    @foreach ($dept as $d)
                    <option value="{{ $d->id }}">{{ $d->department_name }}</option>
                    @endforeach
                  </select>
                
            </div>
            <br />

        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="result_table" width="100%">
            <thead>
              <tr>
                <th> No</th>
                <th> Employee Name </th>
                <th> Department </th>
                <th> Total Activity </th>
                <th> Total Efficiency </th>
                <th> Total Competency </th>
                <th> AVG Efficiency </th>
                <th> AVG Competency </th>
              </tr>
            </thead>
            <tfoot align="right">
              <tr>
                <th  colspan="3"> Grand Total And Overall Average</th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
                <th> </th>
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

 function load_data(from_date = '', to_date = '', department = '')
 {
  $('#result_table').DataTable(
    {
    processing: true,
    serverSide: true,
    ajax:
      {
      url: "{{ route('crud_result.index') }}",
      data:{from_date:from_date, to_date:to_date, department:department}
      },
    columns:
      [
       {data: 'DT_RowIndex', name: 'DT_RowIndex'},
       {data: 'name', name: 'name'},
       {data: 'department_name', name: 'department_name'},
       {data: 'total_act', name: 'total_act' }, //className: "sum" 
       {data: 'total_effi', name: 'total_effi' },
       {data: 'total_comp', name: 'total_comp' },
       {data: 'avg_effi', name: 'avg_effi'},
       {data: 'avg_comp', name: 'avg_comp'},
      ],
      // "footerCallback": function(row, data, start, end, display) {
      //               var api = this.api();

      //               api.columns('.sum', { page: 'current' }).every(function () {
      //                   var sum = api
      //                       .cells( null, this.index(), { page: 'current'} )
      //                       .render('display')
      //                       .reduce(function (a, b) {
      //                           var x = parseFloat(a) || 0;
      //                           var y = parseFloat(b) || 0;
      //                           return x + y;
      //                       }, 0);
      //                   console.log(this.index() +' '+ sum); //alert(sum);
      //                   $(this.footer()).html(sum);
      //               });
      //           }
      //       });
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over this page Activity
            act = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                act
            );

            // Total over this page Efficieny
            effi = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                effi
            );

            // Total over this page Competency
            comp = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                comp
            );

            // Update footer AVG Effi
            var avg_e = effi/act;
            var avg_effi = avg_e.toFixed(4)
            $( api.column( 6 ).footer() ).html(
                avg_effi
            );
            // Update footer AVG Comp
            var avg_c = comp/act;
            var avg_comp = avg_c.toFixed(4)
            $( api.column( 7 ).footer() ).html(
                avg_comp
            );
        }
    } );
  }

  $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  var department = $('#department').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#result_table').DataTable().destroy();
   load_data(from_date, to_date, department);
   
  }
  // if (from_date != '' &&  to_date != '' && department!= '')
  // {
  //   $('#result_table').DataTable().destroy();
  //  load_data(from_date, to_date, department);
   
  // }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#result_table').DataTable().destroy();
  load_data();
 });

 $('#department').change(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  var department = $('#department').val();
  $('#result_table').DataTable().destroy();
  load_data(from_date, to_date, department);
  // e.preventDefault();
 });

  });
</script>
@endsection