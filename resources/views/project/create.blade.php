@extends("layouts._admin")
@section("title", "Create  Project")

@section("css")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2 {
            width:100% !important;
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
                <div class="card">
                    <div class="header">
                        <h2>Basic Information</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ route('admin.project.store') }}" id="basic-form" novalidate>
                            @csrf
                            <input type="hidden" name="manager_id" value="{{auth()->user()->id}}" >

                            <div class="row clearfix">
                                <div class="col-lg-8 col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Project Name</label>
                                        <input value="{{ old('name') }}" type="text"
                                               class="form-control  @if ($errors->has('name'))is-invalid @endif"
                                               id="name" name="name" required>
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('name')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="user_id" class="control-label">Client</label>
                                            <select class="form-control  @if ($errors->has('user_id'))is-invalid @endif"
                                                    id="user_id" name="user_id" required>
                                                <option value="">Please Choose Client</option>
                                                @foreach($clients as $client)
                                                    <option {{ old("user_id")==$client->id?"selected":"" }} value="{{ $client->id }}">{{ $client->fname }} {{ $client->lname }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('user_id'))
                                                <p class="text-danger">{{$errors->first('user_id')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="user_id" class="control-label">Progress</label>
                                            <select class="form-control  @if ($errors->has('progress'))is-invalid @endif"
                                                    id="progress" name="progress" required>
                                                <option value="">Please Choose Progress</option>
                                                @foreach($progresses as $progress)
                                                    <option {{ old("progress") == $progress->id ?"selected":"" }} value="{{ $progress->id }}">{{ $progress->name }} </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('progress'))
                                                <p class="text-danger">{{$errors->first('progress')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>





                                <div class="col-lg-4 col-md-12">
                                    <label for="budget" class="control-label">Project Budget</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input value="{{ old('budget') }}" type="number"
                                               class="form-control @if ($errors->has('budget'))is-invalid @endif"
                                               id="budget" name="budget" aria-label="Project Budget" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        @if ($errors->has('budget'))
                                            <p class="text-danger">{{$errors->first('budget')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="start_date" class="control-label">Start Date</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input value="{{ old('start_date') }}" type="date"
                                               class="form-control @if ($errors->has('start_date'))is-invalid @endif"
                                               id="start_date" name="start_date" aria-label="Start Date" required>

                                    </div>
                                    @if ($errors->has('start_date'))
                                        <p class="text-danger">{{$errors->first('start_date')}}</p>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="end_date" class="control-label">End Date</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input value="{{ old('end_date') }}" type="date"
                                               class="form-control  @if ($errors->has('end_date'))is-invalid @endif"
                                               id="end_date" name="end_date" aria-label="End Date"
                                               required>
                                    </div>
                                    @if ($errors->has('end_date'))
                                        <p class="text-danger">{{$errors->first('end_date')}}</p>
                                    @endif
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="discription" class="control-label">Project Description</label>
                                        <textarea name="discription" id="discription"
                                                  class="form-control  @if ($errors->has('discription'))is-invalid @endif"
                                                  data-provide="markdown" required
                                                  rows="10">{{old('discription')}}</textarea>

                                        @if ($errors->has('discription'))
                                            <p class="text-danger">{{$errors->first('discription')}}</p>
                                        @endif

                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Services" class="control-label">Project Services</label>
                                        <select class="js-example-basic-multiple @if ($errors->has('service_id'))is-invalid @endif" multiple="multiple"
                                                id="service_id" name="service_id[]" required>
                                            @foreach($services as $service)
                                                <option {{ old("service_id")==$service->id?"selected":"" }} value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('service_id'))
                                            <p class="text-danger">{{$errors->first('service_id')}}</p>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mb-3">Create</button>
                                    <a class="btn btn-dark mb-3" href="{{ route('admin.project.index') }}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section("js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

    <script>
        $(document).ready(function() {

            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection


