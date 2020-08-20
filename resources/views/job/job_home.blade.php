@extends('layouts.admin')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Job Opportunity List</h1>
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
        <div class="container-fluid" style="margin: 20px 5px;">
          <a href="{{ route('add.level')}}" class= "btn btn-info" style="width: 150px">Add Job Opportunity</a>
        </div>
        <!-- /.row (main row) -->
        <table class="table table-fluid" id="myTable" style="width: 100%">
      <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th> 
                <th>Create At</th> 
                <th>Update At</th> 
                <th>Action</th> 
            </tr>
          </thead>
          <tbody>
            @foreach( $job_opportunity as $c )
                    <tr> 
                        <td align="center" style="vertical-align:middle;"> {{ $c['id'] }} </td>
                        <td align="center" style="vertical-align:middle;"> {{ $c['level_name'] }}</td>
                        <td align="center" style="vertical-align:middle;"> {{ $c['description'] }} </td>
                        <td align="center" style="vertical-align:middle;"> {{ $c['created_at'] }} </td>
                        <td align="center" style="vertical-align:middle;"> {{ $c['updated_at'] }} </td>
                        <td align="center" style="vertical-align:middle;"> 
                          <a href="{{ route('edit.student', $c['uid'])}}" style="width: 70px;  ;">
                            <i class="fas fa-edit" style="color:#17a2b8; font-size:21px; margin: 0px 10px; "></i>
                          </a>
                          <a href="#" style="width: 70px;  ;">
                            <i class="fas fa-trash-alt" style="color:#dc3545; font-size:21px; "></i>
                          </a>
                         
                        </td>
                       
                    </tr>
            @endforeach
            </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );

    // Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("nav-link");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  if (current.length > 0) { 
    current[0].className = current[0].className.replace(" active", "");
  }
  this.className += " active";
  });
}
</script>
@endsection
