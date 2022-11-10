<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Chat</title>
  </head>
  <body>
    @include('nav')

    <section style="background-color: #eee;">
        <div class="container py-5">

          <div class="row">

            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

              <h5 class="font-weight-bold mb-3 text-center text-lg-start">Students</h5>

              <div class="card">
                <div class="card-body">
                    @foreach ($students as $student)
                    <ul class="list-unstyled mb-0">
                    <li class="p-2 border-bottom" style="background-color: #eee;">
                      <a href="http://localhost:8000/chat/student/{{$student->id}}" class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                          <img src="{{ asset('images/user.png') }}" alt="avatar"
                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                          <div class="pt-1">
                            <p class="fw-bold mb-0">  {{$student->full_name}} </p>
                            <p class="small text-muted">massage</p>
                          </div>
                        </div>
                      </a>
                    </li>
                  </ul>
                  @endforeach
                </div>
              </div>

            </div>

            <div class="col-md-6 col-lg-7 col-xl-8">

              <ul class="list-unstyled">
                @foreach ($messages as $message)
                <li class=" mb-4">

                  <div class="card">
                    <div class="card-header p-3">
                      <p class="fw-bold mb-0">{{$message->from}}</p>
                      <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{$message->created_at}} </p>
                    </div>
                    <div class="card-body">
                      <p class="mb-0 ">
                        {{$message->message}}
                      </p>
                    </div>
                  </div>
                </li>

                @endforeach
                {{--
                @foreach ($messagesRec as $messageRec)
                <li class=" mb-4">

                  <div class="card">
                    <div class="card-header p-3">
                      <p class="fw-bold mb-0">{{$messageRec->from}}</p>
                      <p class="text-muted small mb-0"><i class="far fa-clock"></i> {{$messageRec->created_at}} </p>
                    </div>
                    <div class="card-body">
                      <p class="mb-0 ">
                        {{$messageRec->message}}
                      </p>
                    </div>
                  </div>
                </li>

                @endforeach --}}


                <li class="bg-white mb-3">
                  <div class="form-outline">
                    <form action="sendMessage" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" id="from" name="from" value=" {{$teacher->email}} " >
                        <input type="hidden" id="to" name="to" value=" {{$studentWa->email}} " >
                        <label class="form-label" for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="4"></textarea>
                        <input type="hidden" id="is_read" name="is_read" value=" 0 " >
                        <button type="submit" class="btn btn-info btn-rounded float-end">Send</button>
                    </form>
                  </div>
                </li>
              </ul>

            </div>

          </div>

        </div>
      </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
