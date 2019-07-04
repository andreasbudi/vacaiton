@extends('layouts.app')
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
		<div class="m-content">
			<!--Begin::Main Portlet-->
				<div class="row">
                    <div id="app">    
                        <main>
                            <div class="col-lg-12">
            					<h3>Edit Employee</h3>
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

        <form action="{{route('employee.update',$employee->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">

            @if (Auth::user()->role_id == '4')

             <div class="col-md-12">
                     <strong>Department :</strong>
                        <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{$employee->department}}" required autocomplete="name" autofocus>
                    
                        	 @error('department')
                        	     <span class="invalid-feedback" role="alert">
                        	         <strong>{{ $message }}</strong>
                        	     </span>
                        	 @enderror 
            </div>
                          
            <div class="col-md-12">
                    <strong>E-mail :</strong>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$employee->email}}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
            </div>
                            
            <div class="col-md-12">
                	<strong>Role :</strong>
                       <select name="role_id" id="role_id" class="form-control">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name_role}}</option>
                            @endforeach
                        </select>

                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
            </div>

            <div class="col-md-12">
                	<strong>Supervised By :</strong>
                      <select name="manager_id" id="manager_id" class="form-control">
                            @foreach ($managers as $manager)
                            <option value="{{$manager->id}}">{{$manager->name_supervisor}}</option>
                            @endforeach
                        </select>

                            @error('manager_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
			</div>

            <div class="col-md-12">
                    <strong>Leaves Available :</strong>
                       <input id="leaves_available" type="text" class="form-control" name="leaves_available" value="{{$employee->leaves_available}}">
            </div>

                <div class="col-md-12">
                    <a href="{{route('home')}}" class="btn btn-sm btn-success">Back</a>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>

            @else
            <div class="col-md-12">
                     <strong>Name :</strong>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$employee->name}}" required autocomplete="name" autofocus>
                    
                        	 @error('name')
                        	     <span class="invalid-feedback" role="alert">
                        	         <strong>{{ $message }}</strong>
                        	     </span>
                        	 @enderror 
            </div>  

            <div class="col-md-12">
                    <strong>Password :</strong>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                  <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                  </span>
                            @enderror
                </div>

            <div class="col-md-12">
                     <strong>Confirm Password :</strong>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="col-md-12">
                    <strong>E-mail :</strong>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$employee->email}}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
            </div>

            <div class="col-md-12">
                    <a href="/profile" class="btn btn-sm btn-success">Back</a>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            @endif

            </div>
        </form>
                                </main>
                            </div>
						</div>
					</div>
				</div>
			<!-- end:: Body -->
@endsection
