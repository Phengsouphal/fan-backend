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
            <h1 class="m-0 text-dark">Create Class</h1>
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
      <form method="POST" action="{{ route('store.class') }}">
          <input type="hidden" name="_method" value="GET" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}" >

          <div class="form-group" >
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Class name</label>
              <div class="col-md-6">
              @if($errors->has('name'))
                <span style="color: #ff8080">{{$errors->first('name')}} </span>
              @endif
                <input type="text" name="name" class="form-control"  value="{{ old('name') }}" style="width: '70%'">
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
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Category</label>
              <div class="col-md-6">
                <select id="category" name="category" style=" width: 70%;  padding: 12px 10px; display: inline-block; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" >
                  @foreach( $categories as $c )
                    <option value="{{ $c['id'] }}">{{ $c['category_name'] }} </option>
                  @endforeach
                </select>
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Level</label>
              <div class="col-md-6">
                <select id="level" name="level" style=" width: 70%;  padding: 12px 10px; display: inline-block; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" >
                  @foreach( $levels as $c )
                    <option value="{{ $c['id'] }}">{{ $c['level_name'] }} </option>
                  @endforeach
                </select>
              </div>
              <div class='clearfix'></div>
            </div>
            <div class='row' style="margin: 20px">
              <label class="col-md-3">Session</label>
              <div class="col-md-6">
                <select id="session" name="session" style=" width: 70%;  padding: 12px 10px; display: inline-block; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" >
                  @foreach( $sessions as $c )
                    <option value="{{ $c['id'] }}">{{ $c['session_name'] }} </option>
                  @endforeach
                </select>
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
