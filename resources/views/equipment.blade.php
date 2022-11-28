@extends('master')

@section ('title')
<title>ISDARE - Equipment</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Equipment</h1>
<p class="mb-4">In this page you can add, edit, and delete equipment data that will be used to create activity data.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> DataTables of Equipment</h6>
  </div>
  <div class="card-body">
     <div align="right">
      <button type="button" name="create_equipment" id="create_equipment" class="btn btn-success btn-sm">Add Equipment</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-hover" id="equipment_table" width="100%">
           <thead>
            <tr>
                <th> No </th>
                <th> Equipment Code</th>
                <th> Equipment Name</th>
                <th> Action </th>
            </tr>
           </thead>
           
           <tfoot>
            <tr>
                <th>No</th>
                <th> Equipment Code</th>
                <th>Equipment Name</th>
                <th>Action</th>
            </tr>
            </tfoot>

           <tbody>
           </tbody>
       </table>
   </div>
  </div>
 
<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
   <h4 class="modal-title">Add Equipment</h4>
          <button type="button" name="cancel_button" id="cancel_button"class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label class="control-label col-md-12" >Equipment Code: </label>
            <div class="col-md-12">
             <input type="text" name="code" id="code" class="form-control" placeholder="Enter Equipment Code" />
            </div>
           </div>
          <div class="form-group">
            <label class="control-label col-md-12" >Equipment Name: </label>
            <div class="col-md-12">
             <input type="text" name="name" id="name" class="form-control" placeholder="Enter Equipment Name" />
            </div>
           </div>
           
           <div class="modal-footer">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <button type="button" name="cancel_button" id="cancel_button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-sm" value="Add" />            
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Delete Equipment Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
                <a align="center" style="margin:0;">Are you sure you want to delete this data?</a>
            </div>
            <div class="modal-footer">
            <button type="button" name="cancel_button" id="cancel_button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger btn-sm">Delete</button>                
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

 $('#equipment_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('crud_equipment.index') }}",
  },
  columns:[
   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
   {data: 'equipment_code', name: 'equipment_code'},
   {data: 'equipment_name', name: 'equipment_name'},
   {data: 'action', name: 'action',
    orderable: false
   }
  ]
 });

 $('#create_equipment').click(function(){
  $('.modal-title').text("Add Equipment");
  $('#sample_form')[0].reset();
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#formModal').modal('show');
 });

 

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"crud_equipment/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#code').val(html.data.equipment_code);
    $('#name').val(html.data.equipment_name);
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Edit Equipment");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });

 $('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('crud_equipment.store') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      
      $('#sample_form')[0].reset();
      $('#formModal').modal('hide');
          Swal.fire({
            position: 'middle-center',
            icon: 'success',
            title: 'Data Added Successfully',
            showConfirmButton: false,
            timer: 1500
          })
      $('#equipment_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('crud_equipment.update') }}",
    method:"POST",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      $('#sample_form')[0].reset();
      $('#formModal').modal('hide');
          Swal.fire({
            position: 'middle-center',
            icon: 'success',
            title: 'Data Edited Successfully',
            showConfirmButton: false,
            timer: 1500
          })
      $('#equipment_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   });
  }
 });

 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"crud_equipment/destroy/"+user_id,
   beforeSend:function(){
    $('#ok_button').text('Delete');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
        Swal.fire(
              'Remind!',
              'Data Deleted Successfully!',
              'success'
            )
     $('#equipment_table').DataTable().ajax.reload();
    }, 1500);
   }
  })
 });

});
</script>
@endsection