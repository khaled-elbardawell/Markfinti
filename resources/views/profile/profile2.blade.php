{{--  profile page    --}}

@extends("layouts._admin")
@section("title", "My Profile")
@section("css")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <style>
        .user-photo{
            width: 90px !important;
        }

        .social .profile-header {
            background-image: none;
            color: #fff;
            padding: 20px;
            position: relative;
            overflow: hidden;
            border-radius: .1875rem;
            box-shadow: inset 0 0 0 2000px #1f1200b3;
            padding: 30px;
        }
    </style>
@endsection

@section("content")


    <div class="container">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>@yield("title")</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card social">
                    <div class="profile-header d-flex justify-content-between justify-content-center">
                        <div class="d-flex">
                            <div class="mr-3">
                                @if( is_null( auth()->user()->photo ) )
                                    <div class="default-logo">{{default_img_profile()}}</div>
                                @else
                                    <img src="{{ asset("assest/upload/profiles/".auth()->user()->photo) }}"
                                         class="user-photo" alt="User Profile Picture">
                                @endif

                            </div>
                            <div class="details">
                                <h5 class="mb-0">{{ Auth::user()->fname }} {{ Auth::user()->lname }} {{ auth()->user()->role == '1' ? " / Admin" : (auth()->user()->role == '2' ? ' / Manager': ' / client') }} </h5>
                                <span class="text-light">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-7">
                <div class="card">
                    <div class="header">
                        <h2>Basic Information</h2>
                    </div>
                    <div class="body">
                        <form method="POST" enctype="multipart/form-data" id="basic-form" novalidate
                              action="{{ route('admin.profile.update') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{auth()->id()}}">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="fname" class="control-label">First Name <span class="required">*</span></label>
                                        <input type="text" value="{{ Auth::user()->fname }}"
                                               class="form-control @if ($errors->has('fname'))is-invalid @endif"
                                               id="fname" name="fname" required>
                                        @error('fname')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="lname" class="control-label">Last Name <span class="required">*</span></label>
                                        <input value="{{ Auth::user()->lname }}" type="text"
                                               class="form-control  @if ($errors->has('lname'))is-invalid @endif" id="lname"
                                               name="lname" required>

                                        @error('lname')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="control-label">Phone No. <span class="required">*</span></label>
                                        <input value="{{ Auth::user()->phone }}" type="text"
                                               class="form-control  @if ($errors->has('phone'))is-invalid @endif" id="phone"
                                               name="phone" required>
                                        @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email Address <span class="required">*</span></label>
                                        <input value="{{ Auth::user()->email }}" type="email"
                                               class="form-control  @if ($errors->has('email'))is-invalid @endif" id="email"
                                               name="email" required>
                                        @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="control-label">Address <span class="required">*</span></label>
                                        <input value="{{ Auth::user()->address }}" type="text"
                                               class="form-control  @if ($errors->has('address'))is-invalid @endif" id="address"
                                               name="address" required>
                                        @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Profile Picture</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="form-control custom-file-input" id="fle_photo"
                                                   name="photo">
                                            <label class="custom-file-label" for="fle_photo">Choose File</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @if(Auth::user()->photo)
                                        <img src='{{ asset("assest/upload/profiles/".auth()->user()->photo) }}'
                                             class="mt-2 w-50 img-fluid img-thumbnail"
                                             style="max-width: 172px; height: 139px;"/>
                                    @endif
                                    @error('photo')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12 col-md-12 mt-3">
                                    <button type="submit" class="btn btn-round btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-lg-4 col-md-5">
                <div class="card">
                    <div class="header">
                        <h2>Security Information</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="{{route('admin.manger.changePassword')}}" data-parsley-validate>
                            @csrf


                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <h6>Change Password</h6>
                                    <div class="form-group">
                                        <label for="product-key" class="control-label">Current Password <span class="required">*</span></label>
                                        <input id="password" type="password"
                                               class="form-control @if ($errors->has('current_password'))is-invalid @endif"
                                               name="current_password" required>

                                        @if ($errors->has('current_password'))
                                            <p class="text-danger">{{$errors->first('current_password')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="product-key" class="control-label">New Password <span class="required">*</span></label>
                                        <input id="new_password" type="password"
                                               class="form-control @if ($errors->has('new_password'))is-invalid @endif"
                                               name="new_password" required>
                                        @if ($errors->has('new_password'))
                                            <p class="text-danger">{{$errors->first('new_password')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="product-key" class="control-label">Confirm Password <span class="required">*</span></label>
                                        <input id="new_confirm_password" type="password"
                                               class="form-control @if ($errors->has('new_confirm_password'))is-invalid @endif"
                                               name="new_password_confirmation" required>

                                        @if ($errors->has('new_confirm_password'))
                                            <p class="text-danger">{{$errors->first('new_confirm_password')}}</p>

                                        @endif
                                        <span id='message'></span>

                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-round btn-primary">Change Password</button> &nbsp;&nbsp;
                        </form>
                    </div>
                </div>
            </div>



    </div>



        <div class="container">

            <div class="panel panel-info">


                <div class="panel-body">



                    <div class="row">

                        <div class="col-md-4 text-center">

                            <div id="upload-demo"></div>

                        </div>

                        <div class="col-md-4" style="padding:5%;">


                            <input type="file" id="image">



                            <button class="btn btn-primary btn-block upload-image" style="margin-top:2%">Upload Image</button>

                        </div>



                        <div class="col-md-4">

                            <div id="preview-crop-image" style="background:#9d9d9d;width:300px;padding:50px 50px;height:300px;"></div>

                        </div>

                    </div>



                </div>

            </div>

        </div>



        @endsection


@section('js')


    <script>

        $(document).ready(function () {
            $("#new_confirm_password").on("keyup", function () {
                var new_pass = $('#new_password').val();
                var confirm_pass = $(this).val();
                if (confirm_pass == new_pass) {
                    $('#message').html('Matching').css('color', 'green');
                } else {
                    $('#message').html('Not Matching').css('color', 'red');
                }
            });


        });

    </script>



    <script type="text/javascript">



        // $.ajaxSetup({
        //
        //     headers: {
        //
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //
        //     }
        //
        // });



        var resize = $('#upload-demo').croppie({

            enableExif: true,

            enableOrientation: true,

            viewport: {

                width: 200,

                height: 200,

                type: 'circle'

            },

            boundary: {

                width: 300,

                height: 300

            }

        });



        $('#image').on('change', function () {

            var reader = new FileReader();

            reader.onload = function (e) {

                resize.croppie('bind',{

                    url: e.target.result

                }).then(function(){

                    console.log('jQuery bind complete');

                });

            }

            reader.readAsDataURL(this.files[0]);

        });



        $('.upload-image').on('click', function (ev) {

            resize.croppie('result', {

                type: 'canvas',

                size: 'viewport'

            }).then(function (img) {
                html = '<img src="' + img + '" />';

                $("#preview-crop-image").html(html);
                {{--$.ajax({--}}

                {{--    url: "{{route('upload.image')}}",--}}

                {{--    type: "POST",--}}

                {{--    data: {"image":img},--}}

                {{--    success: function (data) {--}}

                {{--        html = '<img src="' + img + '" />';--}}

                {{--        $("#preview-crop-image").html(html);--}}

                {{--    }--}}

                {{--});--}}

            });

        });



    </script>
@endsection









