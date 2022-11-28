@extends('master')

@section ('title')
<title>ISDARE - Edit Activities</title>
@endsection

@section('content')
<div class="container-fluid">
<a href="{{route('act')}}" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Back" class="  mb-3 btn btn-danger ">Back</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Activitity</h6>
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
            <form action="{{route('update_act')}}" method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="control-label col-md-12" >Date: </label>
                    <div class="col-md-12">
                        <input required type="date" name="date" id="date" class="form-control" value="{{$data->date}}" />
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-md-12" >Employee Name: </label>
                    <div class="col-md-12">
                    <label readonly class="form-control">{{$data->name}} </label>
                        <input  type="hidden" name="employee" id="employee" value="{{$data->user_id}}" class="form-control" />
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-12"> Classification</label>
                    <div class="col-md-12">
                        <select required class="form-control" name ="classification" id="classification" >
                            <option value="0">Pilih Classification</option>
                            @foreach ($class as $cl)
                            <option value="{{ $cl->id }}" {{ $cl->id == $data->classification_id ? 'selected' : ''}} > {{ $cl->classification_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Equipment</label>
                    <div class="col-md-12">
                        <select required class="form-control" name ="equipment" id="equipment" >
                            <option value="0">Pilih Equipment</option>
                            @foreach ($equip as $eq)
                            <option value="{{ $eq->id }}" {{ $eq->id == $data->equipment_id ? 'selected' : ''}}>{{ $eq->equipment_code }} | {{ $eq->equipment_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Start: </label>
                    <div class="col-md-12">
                        <input required type="time" name="start" id="start" class="form-control" placeholder="00:00" value="{{$data->start_time}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Finish: </label>
                    <div class="col-md-12">
                        <input required type="time" name="finish" id="finish" class="form-control" placeholder="Enter Description" value="{{$data->finish_time}}"/>
                    </div>
                </div>
            

                <div class="form-group">
                    <label class="control-label col-md-12">Description: </label>
                    <div class="col-md-12">
                        <textarea required name="description" id="description" class=" ckeditor form-control"  placeholder="Enter Description">{{$data->description}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12">Report: </label>
                    <div class="col-md-12">
                        <textarea required name="report" id="report"  class=" ckeditor form-control"  placeholder="Enter Report">{{$data->report}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="{{$id}}" />
                    <button type="submit" class="btn btn-primary btn-block ">Save</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<script type="text/javascript">
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{route('desc_img', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.replace('report', {
        filebrowserUploadUrl: "{{route('rprt_img', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection