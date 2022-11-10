<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Students</title>
  </head>
  <body>

    @include('nav')

  <div class="content">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="students/delete" method="POST">
                @csrf
                @method('POST')
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="student_delete_id" id="student_id">
                    Are you sure you want to delete this student?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
          </div>
        </div>
      </div>


    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <div class="row mb-5">
            <h1 class="ml-5 mr-5">Students Table</h1>
            <a href="students/create" class="btn btn-primary mt-2">Add New Student</a>
        </div>


      <div class="table-responsive">

        <table class="table table-striped custom-table">
          <thead>
            <tr>
              <th scope="col">Full Name</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Country Code</th>
              <th scope="col">Country</th>
              <th scope="col">Email</th>
              <th scope="col">Gender</th>
              <th scope="col">Married</th>
              <th scope="col">Children</th>
              <th scope="col">Created At</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
              <th scope="col">Message</th>
            </tr>
          </thead>
          <tbody>
                @foreach($students as $student => $data)
                <tr scope='row'>
                    <th>{{$data->full_name}}</th>
                    <th>{{$data->phone_number}}</th>
                    <th>{{$data->country_code}}</th>
                    <th>{{$data->country}}</th>
                    <th>{{$data->email}}</th>
                    <th>{{$data->gender == 1 ? "Male":"Female"}}</th>
                    <th>{{$data->is_married ? 'Yes' : 'No'}}</th>
                    <th>{{$data->have_child ? 'Yes' : 'No'}}</th>
                    <th>{{$data->created_at ->format('m/d/Y')}}</th>
                    <th><a href="students/{{$data->id}}/edit" class="btn btn-success ">Edit</a></th>
                    {{-- <th><a href="students/{{$data->id}}/delete" class="btn btn-danger ">Delete</a></th> --}}
                    <th><button type="button" class="btn btn-danger deleteStudentBtn" value="{{$data->id}}">Delete</button></th>
                    <th><a href="chat/student/{{$data->id}}" class="btn btn-primary">Message</a><th>

                </tr>
                @endforeach



          </tbody>
        </table>
      </div>


    </div>





    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function(){
            $('.deleteStudentBtn').click(function (e){
                e.preventDefault();



                var student_id = $(this).val();
                $("#student_id").val(student_id);
                $("#deleteModal").modal('show');
            })
        })
    </script>
  </body>
</html>
