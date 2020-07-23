@extends("layouts._admin")
@section("title", "Report")
@section("css")
    <style>

    </style>
@endsection

@section("content")
    <div class="container">

        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>@yield("title")</h2>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <form action="{{  route('admin.project.report.add',$project_id)  }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="type_id" class="control-label">Report Type <span class="required">*</span></label>
                                        <select class="form-control @if ($errors->has('type_id'))is-invalid @endif"
                                                id="type_id" name="type_id">
                                            <option value="">Please Select Report Type </option>
                                            @foreach($types as $type)
                                                <option {{ old("type_id") == $type->id ?"selected":"" }} value="{{ $type->id }}">{{ $type->name }} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('type_id'))
                                            <p class="text-danger">{{$errors->first('type_id')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Report Date <span class="required">*</span></label>
                                        <input type='date'
                                               class="form-control @if ($errors->has('added_date'))is-invalid @endif"
                                               name="added_date" id='added_date' value="{{old('added_date')}}"/>
                                        @if ($errors->has('added_date'))
                                            <p class="text-danger">{{$errors->first('added_date')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type_id" class="control-label">Report File <span class="required">*</span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Profile Picture</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="form-control custom-file-input" id="fileupload"
                                                       name="fileupload">
                                                <label class="custom-file-label" for="fle_photo">Choose File</label>

                                            </div>
                                        </div>
                                        @if ($errors->has('fileupload'))
                                            <p class="text-danger">{{$errors->first('fileupload')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit"  class="btn btn-primary mb-3 ">Create</button>
                                    <a class="btn btn-dark mb-3"  href="{{ route('admin.project.index') }}">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Report</th>
                                <th>Report Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0 ?>
                            @foreach($reports as $report)
                                <tr>
                                    <td><?= ++ $i?></td>
                                    <td>{{$report->typeReport->name}}</td>
                                    <td><a  href="{{ route( 'admin.project.report.download', $report->reports )  }}">
                                            {{ $report->name   }}
                                        </a>
                                    </td>
                                    <td>{{ $report->added_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $reports->render()  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




