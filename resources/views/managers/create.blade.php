@extends("layouts._admin")
@section("title", "Create  Managers")
@section("css")
    <style>

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
                <div class="card">
                    <div class="header">
                        <h2>Basic Information</h2>
                    </div>
                    <div class="body">
                        <form class="ml-3" method="POST" action="{{ route('admin.manger.store') }}" id="basic-form" novalidate
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="fname" class="control-label">First Name <span class="required">*</span></label>
                                        <input value="{{ old('fname') }}" type="text"
                                               class="form-control  @if ($errors->has('fname'))is-invalid @endif"
                                               id="fname" name="fname" required>
                                        @if ($errors->has('fname'))
                                            <p class="text-danger">{{$errors->first('fname')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="lname" class="control-label">Last Name <span class="required">*</span></label>
                                        <input value="{{ old('lname') }}" type="text"
                                               class="form-control @if ($errors->has('lname'))is-invalid @endif" id="lname"
                                               name="lname" required>
                                        @if ($errors->has('lname'))
                                            <p class="text-danger">{{$errors->first('lname')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="phone" class="control-label">Mobile No. <span class="required">*</span></label>
                                        <input value="{{ old('phone') }}" type="tel"
                                               class="form-control @if ($errors->has('phone'))is-invalid @endif " id="phone"
                                               name="phone" required>
                                        @if ($errors->has('phone'))
                                            <p class="text-danger">{{$errors->first('phone')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="identity" class="control-label">Emirates Id / Passport No. <span class="required">*</span></label>
                                        <input value="{{ old('identity') }}"
                                               class="form-control @if ($errors->has('identity'))is-invalid @endif "
                                               id="identity" name="identity" required>
                                        @if ($errors->has('identity'))
                                            <p class="text-danger">{{$errors->first('identity')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email Address <span class="required">*</span></label>
                                        <input value="{{ old('email') }}" type="text"
                                               class="form-control @if ($errors->has('email'))is-invalid @endif" id="email"
                                               name="email" required>

                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="position" class="control-label">Position <span class="required">*</span></label>
                                        <input value="{{ old('position') }}" type="text"
                                               class="form-control  @if ($errors->has('position'))is-invalid @endif"
                                               id="position" name="position" required>

                                        @if ($errors->has('position'))
                                            <p class="text-danger">{{$errors->first('position')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="address" class="control-label">Address <span class="required">*</span></label>
                                        <input value="{{ old('address') }}" type="text"
                                               class="form-control  @if ($errors->has('address'))is-invalid @endif"
                                               id="address" name="address" required>

                                        @if ($errors->has('address'))
                                            <p class="text-danger">{{$errors->first('address')}}</p>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password <span class="required">*</span></label>
                                        <input value="{{ old('password') }}" type="password"
                                               class="form-control  @if ($errors->has('password'))is-invalid @endif"
                                               id="password" name="password" required>

                                        @if ($errors->has('password'))
                                            <p class="text-danger">{{$errors->first('password')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Profile Picture</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file"
                                                   class="form-control custom-file-input @if ($errors->has('photo'))is-invalid @endif"
                                                   id="fle_photo" name="photo">
                                            <label class="custom-file-label" for="fle_photo">Choose File</label>
                                            @if ($errors->has('photo'))
                                                <p class="text-danger">{{$errors->first('photo')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary mb-3">Create</button>
                                    <a class="btn btn-dark mb-3" href="{{ route('home') }}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

