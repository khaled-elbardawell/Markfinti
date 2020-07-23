
{{-- this is view project --}}
@extends("layouts._admin")

@section("title", "Projects")
@section("css")
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}" type="text/css"
          rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">

    <style>
        .clearfix{
            overflow: hidden;
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
                @can('create',App\Project::class)
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('admin.project.create') }}" class="btn btn-sm btn-primary" title="">Add Project</a>
                </div>
                @endcan
            </div>
        </div>



        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover js-basic-example dataTable table-custom spacing8" id="m_table_1">
                            <thead>
                            <tr>
                                <th>Code No.</th>
                                <th>Project Name</th>
                                <th>Client</th>
                                <th>Account Manager</th>
                                <th>Budget</th>
                                <th>Progress Status</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->code_number }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->client->fname }} {{ $project->client->lname }}</td>
                                    <td>{{ $project->manger->fname }} {{ $project->manger->lname }} </td>
                                    <td>{{ $project->budget }}</td>

                                    <td> @isset($project->progress->name) {{ $project->progress->name  }} @endisset</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }}</td>
                                    <td>
                                        @can('edit', "App\Project")
                                        <a class="btn btn-primary mb-2 " data-toggle="tooltip" data-placement="bottom"
                                           title="Edit " href="{{ route('admin.project.edit', $project->id) }}">
                                            <span class="sr-only">Edit</span>
                                            <i class="icon-note"></i>
                                        </a>
                                        @endcan


                                    @can('details', "App\Project")
                                        <a class="btn btn-dark mb-2" data-toggle="tooltip" data-placement="bottom"
                                           title="Details" href="{{route('admin.project.details', $project->id)}}">
                                            <span class="sr-only">View</span>
                                            <i class="icon-eye"></i>
                                        </a>
                                        @endcan


                                    @can('message', "App\Project")
                                        <a class="btn btn-info mb-2" data-toggle="tooltip" data-placement="bottom"
                                           title="show notes" href="{{route('admin.project.message', $project->id)}}">
                                            <span class="sr-only">Note</span>
                                            <i class="icon-layers"></i>
                                        </a>
                                        @endcan

                                        @can('viewAny', "App\Report")

                                        <a class="btn btn-warning mb-2" data-toggle="tooltip" data-placement="bottom"
                                           title="reports" href="{{route('admin.project.report', $project->id)}}">
                                            <span class="sr-only">View</span>
                                            <i class="icon-docs"></i>
                                        </a>
                                        @endcan
                                    @can('transaction', "App\Project")

                                        <a class="btn btn-success mb-2" data-toggle="tooltip" data-placement="bottom"
                                           title="add transaction" href="{{route('admin.project.transaction', $project->id)}}">
                                            <span class="sr-only">View</span>
                                            <i class="fa fa-dollar"></i>
                                        </a>
                                    @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $projects->render()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("js")





@endsection
