@extends ('master')

@section ('title')
<title>ISDARE - Edit Profile</title>
@endsection

@section ('content')
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
    </div>
    <div class="card-body">
      <form action="{{route('edit.profil')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="control-label col-md-12" >User Name: </label>
            <div class="col-md-12">
             <input type="text" name="name" id="name" class="form-control" placeholder="Enter User Name" value="{{ Auth::user()->name}}"/>
            </div>
           </div>

           <div class="form-group">
            <label class="control-label col-md-12" >NIK: </label>
            <div class="col-md-12">
             <input type="text" name="NIK" id="NIK" class="form-control" placeholder="Enter NIK" value="{{ Auth::user()->NIK}}"/>
            </div>
           </div>
           
           <div class="form-group">
            <label class="control-label col-md-12"> Position</label>
            <div class="col-md-12">
            <select  class="form-control" name ="position" id="position" >
            <option value="">Pilih Position</option>
              @foreach ($pos as $p)
              <option value="{{ $p->id }}" {{ $p->id == Auth::user()->position_id ? 'selected' : ''}} >{{ $p->position_name }}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-12"> Department</label>
            <div class="col-md-12">
            <select  class="form-control" name ="department" id="department" >
            <option value="">Pilih Department</option>
              @foreach ($dept as $d)
              <option value="{{ $d->id }}" {{ $d->id == Auth::user()->department_id ? 'selected' : ''}} >{{ $d->department_name }}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-12"> Leader</label>
            <div class="col-md-12">
            <select class="form-control" name ="leader" id="leader" >
            <option value="">Pilih Leader</option>
              @foreach ($lead as $l)
              <option value="{{ $l->id }}" {{ $l->id == Auth::user()->leader_id ? 'selected' : ''}} >{{ $l->leader_name }}</option>
              @endforeach
            </select>
            </div>
          </div>

          <div class="form-group">
          <input type="hidden" name="hidden_id" id="hidden_id" value="{{Auth::user()->id}}" />
          <button type="submit" class="btn btn-primary btn-block ">Save</button>
          </div>
      
    </form>
  </div>
</div>

@endsection