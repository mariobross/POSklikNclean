<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <title>Register</title>
  <style>
    /*
    *
    * ==========================================
    * CUSTOM UTIL CLASSES
    * ==========================================
    *
    */

    .border-md {
        border-width: 2px;
    }

    .btn-facebook {
        background: #405D9D;
        border: none;
    }

    .btn-facebook:hover, .btn-facebook:focus {
        background: #314879;
    }

    .btn-twitter {
        background: #42AEEC;
        border: none;
    }

    .btn-twitter:hover, .btn-twitter:focus {
        background: #1799e4;
    }



    /*
    *
    * ==========================================
    * FOR DEMO PURPOSES
    * ==========================================
    *
    */

    body {
        min-height: 100vh;
    }

    .form-control:not(select) {
        padding: 1.5rem 0.5rem;
    }

    select.form-control {
        height: 52px;
        padding-left: 0.5rem;
    }

    .form-control::placeholder {
        color: #ccc;
        font-weight: bold;
        font-size: 0.9rem;
    }
    .form-control:focus {
        box-shadow: none;
    }

  </style>
</head>
<body>

<!-- Navbar-->
<div class="container">
    <div class="row py-5 mt-4 align-items-center">
        <!-- Registeration Form -->
        <div class="col-md-7 col-lg-6 mx-auto">
          
          <form method="POST" action="{{ url('/registerForm') }}">
                        @csrf
                <div class="row">

                    <!-- First Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                        </div>
                        <input id="name" type="text" name="name" placeholder="Enter Name" class="form-control bg-white border-left-0 border-md @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @error('name')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>

                    

                    <!-- Email Address -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                        </div>
                        <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md @error('email') is-invalid @enderror" value="{{old('email')}}">
                        @error('email')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-phone-square text-muted"></i>
                            </span>
                        </div>
                        <input id="phoneNumber" type="tel" name="phone" placeholder="Phone Number" class="form-control bg-white border-md border-left-0 pl-3 @error('phone') is-invalid @enderror" value="{{old('phone')}}" >
                        @error('phone')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>

                    <!-- city -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fas fa-city text-muted"></i>
                            </span>
                        </div>
                        <input id="address" type="address" name="address" placeholder="City" class="form-control bg-white border-left-0 border-md pl-3 @error('address') is-invalid @enderror" value="{{old('address')}}">
                        @error('address')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>

                    <!-- User Name -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fas fa-user-tie text-muted"></i>
                            </span>
                        </div>
                        <input id="username" type="text" name="username" placeholder="Enter Username" class="form-control bg-white border-left-0 border-md @error('username') is-invalid @enderror" value="{{old('username')}}">
                        @error('username')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>


                    <!-- Password -->
                    <div class="input-group col-lg-12 mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white px-4 border-md border-right-0">
                                <i class="fa fa-lock text-muted"></i>
                            </span>
                        </div>
                        <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md pl-3 @error('password') is-invalid @enderror" value="{{old('password')}}">
                        @error('password')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>

                   

                    <!-- Submit Button -->
                    <div class="form-group col-lg-12 mx-auto mb-0">
                        <button type="submit" class="btn btn-primary btn-block py-2">
                            <span class="font-weight-bold">Create your account</span>
                        </button>
                    </div>

                    <!-- Divider Text -->
                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
                        <div class="border-bottom w-100 ml-5"></div>
                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
                        <div class="border-bottom w-100 mr-5"></div>
                    </div>

              

                    <!-- Already Registered -->
                    <div class="text-center w-100">
                        <p class="text-muted font-weight-bold">Already Registered? <a href="{{url('/login')}}" class="text-primary ml-2">Login</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>