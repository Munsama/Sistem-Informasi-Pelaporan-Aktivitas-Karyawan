@extends('master')

@section ('title')
<title>ISDARE - View Activitity Report</title>
@endsection

@section('content')
<div class="container-fluid">
<a href="{{route('actr')}}" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Back" class="  mb-3 btn btn-danger ">Back</a>
   
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">View Activitity Report</h6>
        </div>
        <div class="card-body">
            <form action="" method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="control-label col-md-12" >Date: </label>
                    <div class="col-md-12">
                        <label type="date" name="date" id="date" class="form-control" > {{$data->date}} </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Employee Name: </label>
                    <div class="col-md-12">
                        <label  name="employee" id="employee" class="form-control">{{$data->name}} </label>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-12"> Classification</label>
                    <div class="col-md-12">
                    <label class="form-control" name ="classification" id="classification" >{{ $data->classification_name }} </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Equipment</label>
                    <div class="col-md-12">
                    <label class="form-control" name ="equipment" id="equipment" > {{ $data->equipment_code }} | {{ $data->equipment_name }} </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Start: </label>
                    <div class="col-md-12">
                        <label  type="time" name="start" id="start" class="form-control" > {{$data->start_time}} </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12" >Finish: </label>
                    <div class="col-md-12">
                        <label label type="time" name="finish" id="finish" class="form-control" > {{$data->finish_time}} </label>
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
                    <label class="form-control" name ="efficiency" id="efficiency" > {{ $data->efficiency_id }} | {{ $data->efficiency_name }} </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12"> Competency</label>
                    <div class="col-md-12">
                    <label class="form-control" name ="competency" id="competency" > {{ $data->competency_id }} | {{ $data->competency_name }} </label>
                    </div>
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
@endsection