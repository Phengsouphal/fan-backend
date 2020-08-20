@extends('layouts.admin')
@section('content')
<style>
input[type=text], select {
  width:70%;
  
} 

.option-select {
  padding: 20px
}
 
/* The container */
.container-label {
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  margin: 0px 20px;
  cursor: pointer;
  font-size: 14px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container-label input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container-label:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container-label input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container-label input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container-label .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Student</h1>
          </div><!-- /.col -->
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Student List</a></li> 
            </ol>
          </div>  -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form method="POST" action="{{ route('store.student') }}">
          <input type="hidden" name="_method" value="GET" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}" >

          <div class="form-group" >
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Username</label>
              <div class="col-md-6">
              @if($errors->has('username'))
                <span style="color: #ff8080">{{$errors->first('username')}} </span>
              @endif
                <input type="text" name="username" class="form-control"  value="{{ old('username') }}" style="width: '70%'">
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Password</label>
              <div class="col-md-6">
              @if($errors->has('password'))
                <span style="color: #ff8080">{{$errors->first('password')}} </span>
              @endif
                <input type="text" name="password" class="form-control"  value="{{ old('password') }}" style="width: '70%'">
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Student Phone</label>
              <div class="col-md-6">
                <input type="text" name="student_phone" class="form-control"  value="{{ old('student_phone') }}">
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Parant Phone</label>
              <div class="col-md-6">
              @if($errors->has('parent_phone'))
                <span style="color: #ff8080">{{$errors->first('parent_phone')}} </span>
              @endif
                <input type="text" name="parent_phone" class="form-control"  value="{{ old('parent_phone') }}">
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Status</label>
              <div class="col-md-6">
                <label class="container-label" style="width: '20%'; margin-right: 10px ">Active
                  <input name="status" value="active" type="radio" checked="checked" name="radio">
                  <span class="checkmark"></span>
                </label>
                <label class="container-label" style="width: '20%'; margin-right: 10px ">Inactive
                  <input name="status" value="inactive" type="radio"  name="radio">
                  <span class="checkmark"></span>
                </label>
                <!-- <input type="radio" name="status" value="active" style="width: '20%'; margin-right: 10px ">Active 
                <span style="margin: 50px"></span>
                <input type="radio" name="status" value="inactive"  style="width: '20%'; margin-right: 10px ">Inactive  -->
              </div>
              <div class='clearfix'></div>
            </div>
          </div>
          <div class='row' style="margin: 20px">
              <label class="col-md-3">Select Enroll Class</label>
              <div class="col-md-6">
                <select id="country"  name="class" style=" width: 70%;  padding: 12px 10px; display: inline-block; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" >
                <option class="option-select" style=" height: 30px;  " value="choose">Choose Enroll Class </option>
                  @foreach( $classes as $class )
                    <option class="option-select" style=" height: 30px;  " value="{{$class['id']}}">{{ $class['class_name'] }} </option>
                  @endforeach
                </select>
              </div>
              <div class='clearfix'></div>
            </div>
          <div class="form-group">
            <input type="submit" value="Create" class="btn btn-info" style="width: 100px">
          </div>
        </form>
      </div> 
    </section>
    <!-- /.content -->
@endsection
