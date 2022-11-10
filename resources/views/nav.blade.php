<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white">Project</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          @if (!empty(Session::get('teacherName')))
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="http://localhost:8000/students">Students</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="massages">Massages</a>
          </li> --}}
          @endif
          @if (!empty(Session::get('studentName')))
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="teachers">Teachers</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="">Massages</a>
          </li> --}}

          @endif

        </ul>
      </div>

      <div class="d-flex justify-content-end">
          <ul class="navbar navbar-nav">
            @if (!empty(Session::get('studentName'))||!empty(Session::get('teacherName') ))

              <li><a class="nav-link active btn btn-light text-dark mr-3" href="http://localhost:8000/logout">Log Out</a></li>

              @else

              <li><a class="nav-link active btn  mr-3" href="stulogin">Student Log In</a></li>
              <li><a class="nav-link active btn  mr-3" href="tealogin">Teacher Log In</a></li>

              @endif
            </ul>
        </div>

    </div>
  </nav>
