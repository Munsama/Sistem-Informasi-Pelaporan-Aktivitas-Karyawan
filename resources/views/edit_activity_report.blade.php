@extends('master')

@section ('title')
<title>ISDARE - Edit Activity Reports</title>
@endsection

@section('content')
<div class="container-fluid">
<a href="{{route('actr')}}" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Back" class="  mb-3 btn btn-danger ">Back</a>
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Activitity Report</h6>
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
            <form action="{{route('update_actr')}}" method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="control-label col-md-12" >Date: </label>
                    <div class="col-md-12">
                        <input readonly type="date" name="date" id="date" class="form-control" value="{{$data->date}}" placeholder="31/12/2020" />
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
                    <label readonly class="form-control">{{$data->classification_name}} </label>
                    <input  type="hidden" name ="classification" id="classification" value="{{$data->classification_id}}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Equipment</label>
                    <div class="col-md-12">
                    <label readonly class="form-control">{{ $data->equipment_code }} | {{$data->equipment_name}} </label>
                    <input  type="hidden" name ="equipment" id="equipment" value="{{$data->equipment_id}}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Start: </label>
                    <div class="col-md-12">
                        <input readonly type="time" name="start" id="start" class="form-control" placeholder="00:00" value="{{$data->start_time}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Finish: </label>
                    <div class="col-md-12">
                        <input readonly type="time" name="finish" id="finish" class="form-control" placeholder="Enter Description" value="{{$data->finish_time}}"/>
                    </div>
                </div>
            

                <div class="form-group">
                    <label class="control-label col-md-12">Description: </label>
                    <div class="col-md-12">
                        <textarea readonly name="description" id="description"  class="ckeditor form-control"  placeholder="Enter Description">{{$data->description}}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-12">Report: </label>
                    <div class="col-md-12">
                        <textarea readonly name="report" id="report"  class="ckeditor form-control"  placeholder="Enter Report">{{$data->report}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Efficiency</label>
                    <div class="col-md-12">
                        <select required class="form-control" name ="efficiency" id="efficiency" >
                            <option value="">Pilih Efficiency</option>
                            @foreach ($effi as $ef)
                            <option value="{{ $ef->id }}"{{ $ef->id == $data->efficiency_id ? 'selected' : ''}}> {{ $ef->id }} | {{ $ef->efficiency_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Competency</label>
                    <div class="col-md-12">
                        <select required class="form-control" name ="competency" id="competency" >
                            <option value="">Pilih Competency</option>
                            @foreach ($comp as $co)
                            <option value="{{ $co->id }}" {{ $co->id == $data->competency_id ? 'selected' : ''}} >{{ $co->id }} | {{ $co->competency_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                
                <div class="form-group">
                <input type="hidden" name="id" id="id" value="{{$id}}" />
                <button type="submit" class="btn btn-primary btn-block ">Save</button>
                </div>
                
            </form>
        </div>
    </div>

<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection