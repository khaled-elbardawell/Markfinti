@extends("layouts._admin")
@section("title", "Edit  Project")
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
                        <form method="POST" action="{{ route('admin.project.update', $project->id) }}"  id="basic-form" novalidate>
                            @csrf
                            <input type="hidden" name="id" value="{{$project->id}}" >
                            @if(auth()->user()->role == 1)
                                <input type="hidden" name="manager_id" value="{{$project->manger_id}}" >

                            @else
                                <input type="hidden" name="manager_id" value="{{auth()->user()->id}}" >


                            @endif

                            <div class="row clearfix">
                                <div class="col-sm-12 ">
                                    <div class="form-group">
                                        <label for="autogenerated" class="control-label">Code No.</label>
                                        <input value="{{$project->code_number}}" type="text" readonly disabled
                                               class="form-control" id="autogenerated" name="autogenerated">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="fname" class="control-label">Project Name <span class="required">*</span></label>
                                        <input value="{{ $project->name }}" type="text"
                                               class="form-control @if ($errors->has('name'))is-invalid @endif"
                                               id="name" name="name" required>
                                        @if ($errors->has('name'))
                                            <p class="text-danger">{{$errors->first('name')}}</p>
                                        @endif
                                    </div>
                                </div>


                                @if(auth()->user()->role == '1')
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="fname" class="control-label">Client <span class="required">*</span></label>
                                        <input type="hidden"  id="user_id" name="user_id" value="{{ $project->client->id}}" />
                                        <input value="{{ $project->client->fname }} {{ $project->client->lname }}" type="text" class="form-control" readonly>
                                    </div>
                                </div>

                                @endif

                                @if(auth()->user()->role == '2')
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="user_id" class="control-label">Client</label>
                                                <select class="form-control  @if ($errors->has('user_id'))is-invalid @endif"
                                                        id="user_id" name="user_id" required>
                                                    <option value="">Please Choose Client</option>
                                                    @foreach($clients as $client)
                                                        <option {{ $project->client->id ==$client->id?"selected":"" }}   value="{{ $client->id }}">{{ $client->fname }} {{ $client->lname }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('user_id'))
                                                    <p class="text-danger">{{$errors->first('user_id')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                @endif



                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="progress" class="control-label">Project Progress <span class="required">*</span></label>
                                        <select class="form-control @if ($errors->has('progress'))is-invalid @endif"
                                                id="progress" name="progress" required>
                                            <option value="">Choose Progress Case</option>
                                            @foreach( $progresses as $prog )
                                                <option {{ $prog->id == $project->progress_id ? 'selected' : ' '   }}  value="{{ $prog->id }}">{{ $prog->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('progress'))
                                            <p class="text-danger">{{$errors->first('progress')}}</p>
                                        @endif
                                    </div>
                                </div>

                                @if(auth()->user()->role == '1')
                                     <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="manager_id" class="control-label"> Account Manager <span class="required">*</span></label>
                                        <select class="form-control @if ($errors->has('manager_id'))is-invalid @endif"
                                                id="manager_id" name="manager_id" required>
                                            <option value="">Choose Account Manager</option>
                                            @isset($managers)
                                                @foreach($managers as $manager)
                                                    <option {{ $manager->id == $project->manger_id ? "selected" : "" }} value="{{ $manager->id }}"> {{ $manager->fname }} {{ $manager->lname }} </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        @if ($errors->has('manager_id'))
                                            <p class="text-danger">{{$errors->first('manager_id')}}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Services" class="control-label">Project Services <span class="required">*</span></label>
                                        <select class="js-example-basic-multiple @if ($errors->has('service_id'))is-invalid @endif" multiple="multiple"
                                                id="service_id" name="service_id[]" required>
                                            @foreach($services as $service)
                                                <option {{  $project->services()->find($service->id) ?  'selected' : ''   }}  value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('service_id'))
                                            <p class="text-danger">{{$errors->first('service_id')}}</p>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-lg-4 col-md-12">
                                    <label for="budget" class="control-label">Project Budget <span class="required">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input value="{{ $project->budget }}" type="number"
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
                                    <label for="start_date" class="control-label">Start Date <span class="required">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input value="{{ $project->start_date }}" type="date"
                                               class="form-control @if ($errors->has('start_date'))is-invalid @endif"
                                               id="start_date" name="start_date" aria-label="Start Date" required>
                                    </div>
                                    @if ($errors->has('start_date'))
                                        <p class="text-danger">{{$errors->first('start_date')}}</p>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <label for="start_date" class="control-label">End Date <span class="required">*</span></label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-clock"></i></span>
                                        </div>
                                        <input value="{{ $project->end_date }}" type="date"
                                               class="form-control @if ($errors->has('end_date'))is-invalid @endif"
                                               id="end_date" name="end_date" aria-label="End Date" required>
                                    </div>
                                    @if ($errors->has('end_date'))
                                        <p class="text-danger">{{$errors->first('end_date')}}</p>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <label for="discription" class="control-label">Project Description <span class="required">*</span></label>
                                    <div class="form-group">
                                    <textarea name="discription" id="discription"
                                              class="form-control @if ($errors->has('discription'))is-invalid @endif"
                                              data-provide="markdown" required rows="10">{{$project->discription}}</textarea>
                                        @if ($errors->has('discription'))
                                            <p class="text-danger">{{$errors->first('discription')}}</p>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mb-3">Update</button>
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

