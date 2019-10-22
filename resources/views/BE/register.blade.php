<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<html>
    <head>
        <title>iHeritage.id | Register</title>
        <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <style>
            :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
            }

            body {
                background: #bdc3c7;
            /* background: #007bff; */
            /* background: linear-gradient(to right, #0062E6, #33AEFF); */
            }

            .card-signin {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
            }

            .card-signin .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
            }

            .card-signin .card-body {
            padding: 2rem;
            }

            .form-signin {
            width: 100%;
            }

            .form-signin .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
            }

            .form-label-group {
            position: relative;
            margin-bottom: 1rem;
            }

            .form-label-group input {
            height: auto;
            border-radius: 2rem;
            }

            .form-label-group>input,
            .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
            }

            .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
            }

            .form-label-group input::-webkit-input-placeholder {
            color: transparent;
            }

            .form-label-group input:-ms-input-placeholder {
            color: transparent;
            }

            .form-label-group input::-ms-input-placeholder {
            color: transparent;
            }

            .form-label-group input::-moz-placeholder {
            color: transparent;
            }

            .form-label-group input::placeholder {
            color: transparent;
            }

            .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
            }

            .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
            }

            .btn-google {
            color: white;
            background-color: #ea4335;
            }

            .btn-facebook {
            color: white;
            background-color: #3b5998;
            }

            /* Fallback for Edge
            -------------------------------------------------- */

            @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
            }

            /* Fallback for IE
            -------------------------------------------------- */

            @media all and (-ms-high-contrast: none),
            (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                    <div class="card-body">
                        <!-- <h5 class="card-title text-center">Login</h5> -->
                        <div class="d-flex justify-content-center mb-3">
                            <a href="{{url('/')}}">
                                <img src="{{asset('bootstrap/vendor/iheritage.png')}}" style="width:200px;height:85px;">
                            </a>
                        </div>
                        <h3 class="mb-3 text-center">Register Institional</h3>
                        <form class="form-signin" action="{{url('register')}}" method="post">
                            @csrf
                            <div class="form-label-group">
                                <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required autofocus>
                                <label for="inputName">Name</label>
                            </div>

                            <div class="form-label-group">
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="text" name="phone" id="inputPhone" class="form-control" placeholder="Phone numbers" required autofocus>
                                <label for="inputPhone">Phone</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" name="re_password" id="inputRePassword" class="form-control" placeholder="Re Password" required>
                                <label for="inputRePassword">Re Password</label>
                            </div>

                            <hr class="sidebar-divider d-none d-md-block">

                            <div class="form-group">
                                <label for="inputInstitutional">Institutional Name</label>
                                <input type="text" name="institutional_name" id="inputInstitutional" class="form-control" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="inputCategory">Category</label>
                                <select name="category" class="form-control" id="inputCategory" required>
                                    <option value=""></option>
                                    <option value="museum">Museum</option>
                                    <option value="library">Library</option>
                                    <option value="gallery">Gallery</option>
                                    <option value="archive">Archive</option>
                                    <option value="temple">Temple</option>
                                    <option value="palace">Palace</option>
                                    <option value="natural-place">Natural Place</option>
                                    <option value="historical-building">Historical Building</option>
                                    <option value="personal-activities">Personal Activities</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputPlace">Place</label>
                                <select name="place_id" class="form-control" id="inputPlace" required>
                                    <option value=""></option>
                                    @foreach(\App\Model\place_tbl::listSearch() as $item)
                                        <option value="{{$item->id}}">{{$item->place_en}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <textarea name="address" id="inputAddress" class="form-control" rows="5" required></textarea>
                            </div>

                            <button class="btn btn-lg btn-warning btn-block text-uppercase">Submit Register</button>
                            <a href="{{url('login')}}" class="btn btn-lg btn-dark btn-block text-uppercase">Back</a>
                            @if(Session::has('info'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{Session::get('info')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @include('sweet::alert')
    </body>
</html>