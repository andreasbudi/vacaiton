@extends('layouts.app')
@section('content')

    <!--Begin::Main Portlet-->
    	<div class="row">
            <div id="app">    
                <main>
                	<div class="col-lg-12">
                		<h3>Edit Leave</h3>
            		</div>
       
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> there where some problems with your input.<br>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('leave.update',$leave->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="col-md-12">
                    <strong>From :</strong>
                    <input type="date" name="from" class="form-control @error('from') is-invalid @enderror" value="{{$leave->from}}" required autocomplete="from" autofocus>

					@error('from')
                    	<span class="invalid-feedback" role="alert">
                        	 <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <strong>To :</strong>
                    <input type="date" name="to" class="form-control @error('to') is-invalid @enderror" value="{{$leave->to}}" required autocomplete="to" autofocus>

					@error('to')
                    	<span class="invalid-feedback" role="alert">
                        	 <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <strong>Duration :</strong>
                    <input type="text" name="duration" class="form-control" value="{{$leave->duration}}">
                </div>

                <div class="col-md-12">
                    <strong>Reason :</strong>
                       <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" rows="2" cols="80" required autocomplete="reason" autofocus>{{$leave->reason}}</textarea>

					@error('reason')
                    	<span class="invalid-feedback" role="alert">
                        	 <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <a href="{{route('leave.index')}}" class="btn btn-sm btn-success">Back</a>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>

            </div>
        </form>
                 </main>
            </div>
		</div>
@endsection
