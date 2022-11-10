<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="main">


        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" action="adduser" class="register-form" id="register-form">
                            @csrf <!-- {{ csrf_field() }} -->
                            @method('POST')
                            <div class="form-group">
                                <label for="full_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="full_name" id="full_name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="phone_number"><i class="zmdi zmdi-email"></i></label>
                                <input type="phone_number" name="phone_number" id="phone_number" placeholder="Your phone number"/>
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
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="stulogin" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>



    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
