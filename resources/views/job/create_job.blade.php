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
            <h1 class="m-0 text-dark">Create Job Opportunity</h1>
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
      <form method="POST" action="{{ route('store.level') }}">
          <input type="hidden" name="_method" value="GET" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}" >

          <div class="form-group" >
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Title</label>
              <div class="col-md-6">
              @if($errors->has('title'))
                <span style="color: #ff8080">{{$errors->first('title')}} </span>
              @endif
                <input type="text" name="title" class="form-control"  value="{{ old('title') }}" style="width: '70%'">
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Description</label>
              <div class="col-md-6">
                <input type="text" name="description" class="form-control"  value="{{ old('description') }}" style="width: '70%'">
              </div>
              <div class='clearfix'></div>
            </div>
            
          </div>

          <div class="form-group">
            <input type="submit" value="Send" class="btn btn-info" style="width: 100px">
          </div>
        </form>
      </div> 
    </section>
    <!-- /.content -->
@endsection
