@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Detail Leave</h3>
                <hr>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>From :</strong>
                        {{$leave->from}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>To :</strong>
                        {{$leave->to}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Duration :</strong>
                        {{$leave->duration}}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Reason :</strong>
                        {{$leave->reason}}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <a href="{{route('leave.index')}}" class="btn btn-sm btn-success">Back</a>
            </div>
        </div>
    </div>
@endsection