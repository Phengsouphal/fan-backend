@extends('layouts.admin')
@section('content')
<style>
input[type=text], select {
  width:70%;
  
} 
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Teacher</h1>
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
      <form method="POST" action="{{ route('store.teacher') }}">
          <input type="hidden" name="_method" value="GET" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}" >

          <div class="form-group" >
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Username</label>
              <div class="col-md-6">
              @if($errors->has('name'))
                <span style="color: #ff8080">{{$errors->first('name')}} </span>
              @endif
                <input type="text" name="name" class="form-control"  value="{{ old('name') }}">
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Password</label>
              <div class="col-md-6">
                <input type="text" name="password" class="form-control"  value="{{ old('password') }}">
              </div>
              <div class='clearfix'></div>
            </div>
           
             
            
            
                       
          </div>

          <div class="form-group">
            <input type="submit" value="Create" class="btn btn-info" style="width: 100px">
          </div>
        </form>
      </div> 
    </section>
    <!-- /.content -->
@endsection
