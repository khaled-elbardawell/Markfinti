@extends("layouts._admin")

@section("title", "Project Details")
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
                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Project Name:</strong></div>
                            <div class="col-sm-9 text-left">{{ $project->name }}</div>
                        </div>
                    </div>
                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Client:</strong></div>
                            <div class="col-sm-9 text-left">{{ $project->client->fname }} {{ $project->client->lname }}</div>
                        </div>
                    </div>
                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Account Manager:</strong></div>
                            <div class="col-sm-9 text-left">{{ $project->manger->fname }} {{ $project->manger->lname }}</div>
                        </div>
                    </div>

                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Project budget:</strong></div>
                            <div class="col-sm-9 text-left">{{ $project->budget }}</div>
                        </div>
                    </div>

                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized"> total received:</strong></div>
                            <div class="col-sm-9 text-left">
                              {{  $total    }}
                            </div>
                        </div>
                    </div>


                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized"> remaining :</strong></div>
                            <div class="col-sm-9 text-left">
                                {{  $remain    }}
                            </div>
                        </div>
                    </div>

                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Project Description:</strong>
                            </div>
                            <div class="col-sm-9 text-left">{{ $project->discription }}</div>
                        </div>
                    </div>

                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Start Date:</strong></div>
                            <div class="col-sm-9 text-left">{{ $project->start_date }}</div>
                        </div>
                    </div>
                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">End Date:</strong></div>
                            <div class="col-sm-9 text-left">{{ $project->end_date }}</div>
                        </div>
                    </div>
                    <div class="body">
                        <div class='row'>
                            <div class="col-sm-3 text-right"><strong class="text-capitalized">Completed:</strong></div>
                            <div class="col-sm-9 text-left">
                                <span class='badge badge-success'>{{$project->progress->name}}</span>
                            </div>
                        </div>
                    </div>


                    <a class="btn btn-dark mt-3" href="{{ route('admin.project.index')}}">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
