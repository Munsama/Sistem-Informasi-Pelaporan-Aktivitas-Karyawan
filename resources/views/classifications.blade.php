@extends('master')

@section ('title')
<title>ISDARE - Classifications</title>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Classifications</h1>
<p class="mb-4">In this page you can add, edit, and delete classification data that will be used to create user accounts.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> DataTables of Classification</h6>
  </div>
  <div class="card-body">
     <div align="right">
      <button type="button" name="create_classification" id="create_classification" class="btn btn-success btn-sm">Add Classification</button>
     </div>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-hover" id="classification_table" width="100%">
           <thead>
            <tr>
                <th> No </th>
                <th> Classification Name</th>
                <th> Action </th>
            </tr>
           </thead>
           
           <tfoot>
            <tr>
                <th>No</th>
                <th>Classification Name</th>
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
   <h4 class="modal-title">Add Classification</h4>
          <button type="button" name="cancel_button" id="cancel_button"class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-12" >Classification Name: </label>
            <div class="col-md-12">
             <input type="text" name="name" id="name" class="form-control" placeholder="Enter Classification Name" />
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
            <h4 class="modal-title">Delete Classification Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
                <a align="center" style="margin:0;">Are you sure you want to delete this data?</a>
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger btn-sm">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

 $('#classification_table').DataTable({
  processing: true,
  serverSide: true,
  ajax:{
   url: "{{ route('crud_classification.index') }}",
  },
  columns:[
   {data: 'DT_RowIndex', name: 'DT_RowIndex'},
   {data: 'classification_name', name: 'name'},
   { data: 'action', name: 'action',
    orderable: false
   }
  ]
 });

 $('#create_classification').click(function(){
  $('.modal-title').text("Add Classification");
  $('#sample_form')[0].reset();
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#formModal').modal('show');
 });

 

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"crud_classification/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#name').val(html.data.classification_name);
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Edit Classification");
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
    url:"{{ route('crud_classification.store') }}",
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
      $('#classification_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('crud_classification.update') }}",
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
      $('#classification_table').DataTable().ajax.reload();
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
   url:"crud_classification/destroy/"+user_id,
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
     $('#classification_table').DataTable().ajax.reload();
    }, 1500);
   }
  })
 });

});
</script>
@endsection