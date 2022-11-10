<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Create</title>
</head>
<body>
    @include('nav')

    <form method="post" action="store">
        @csrf <!-- {{ csrf_field() }} -->
        @method('POST')
    <section class="h-100 bg-dark">
        <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
            <div class="card card-registration my-4">
                <div class="row g-0">
                <div class="col-xl-6 d-none d-xl-block">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                    alt="Sample photo" class="img-fluid"
                    style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                </div>
                <div class="col-xl-6">
                    <div class="card-body p-md-5 text-black">
                    <h3 class="mb-5 text-uppercase">Student registration form</h3>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                        <div class="form-outline">
                            <input type="text" id="full_name" name="full_name" class="form-control form-control-lg" />
                            <label class="form-label" for="full_name">Full Name</label>
                        </div>
                        </div>
                    </div>


                        <div class="form-outline mb-4">
                            <input type="text" id="phone_number" name="phone_number" class="form-control form-control-lg" />
                            <label class="form-label" for="phone_number">Phone Number</label>
                        </div>


                        <div class="row">
                            <div class="col-md-6 mb-4">

                                <select class="form-select" name="country_code">
                                    <option value="">Country Code</option>
                                    <option value="20">+20</option>
                                    <option value="44">+44</option>
                                    <option value="966">+966</option>
                                </select>

                            </div>

                    <div class="col-md-6 mb-4">

                        <select class="form-select" name="country">
                            <option >Country</option>
                            <option value="EGY">EGY</option>
                            <option value="UK">Uk</option>
                            <option value="KSA">KSA</option>
                        </select>

                    </div>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="email" name="email" class="form-control form-control-lg" />
                        <label class="form-label" for="email">Email </label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" name="pass" id="pass" class="form-control form-control-lg" />
                        <label class="form-label" for="pass">Password </label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" name="re_pass" id="re_pass" class="form-control form-control-lg" />
                        <label class="form-label" for="re_pass">Confirm Password </label>
                    </div>
                    <div class="d-md-flex justify-content-start align-items-center mb-2 py-2">

                        <h6 class="mb-0 me-4" >Gender: </h6>

                        <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio"  name="gender" id="femaleGender"
                            value="2" />
                        <label class="form-check-label" for="femaleGender">Female</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="gender" id="maleGender"
                            value="1" />
                        <label class="form-check-label" for="maleGender">Male</label>
                        </div>

                    </div>
                    <div class="d-md-flex justify-content-start align-items-center mb-2 py-2">

                        <h6 class="mb-0 me-4">Marital State: </h6>

                        <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="is_married" id="single"
                            value="0" />
                        <label class="form-check-label" for="single">Single</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="is_married" id="married"
                            value="1" />
                        <label class="form-check-label" for="married">Married</label>
                        </div>

                    </div>

                    <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                        <h6 class="mb-0 me-4">Have Children: </h6>

                        <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="have_child" id="no"
                            value="1" />
                        <label class="form-check-label" for="yes">Yes</label>
                        </div>

                        <div class="form-check form-check-inline mb-0 me-4">
                        <input class="form-check-input" type="radio" name="have_child" id="no"
                            value="0" />
                        <label class="form-check-label" for="no">No</label>
                        </div>

                    </div>

                    <div class="d-flex justify-content-center pt-3">
                        <button type="button" class="btn btn-primary btn-lg">Reset all</button>
                        <button type="submit" class="btn btn-success btn-lg ms-2">Submit form</button>
                    </div>

                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

