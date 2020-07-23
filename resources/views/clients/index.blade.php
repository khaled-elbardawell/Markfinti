{{--  Mange Clients page     --}}

@extends("layouts._admin")
@section("title", "Clients")
@section("css")
    <link href="{{ asset('public/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}" type="text/css"
          rel="stylesheet">
    <link href="{{ asset('public/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">
    <link href="{{ asset('public/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">
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
                @can('createClient',App\User::class)

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{ route('admin.client.create') }}" class="btn btn-sm btn-primary" title="">Add Client</a>
                </div>
                @endcan
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company Name</th>
                                <th>Company No.</th>
                                <th width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count =0; ?>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $client->fname }} {{ $client->lname }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->clientinfo->companyName}}</td>
                                    <td>{{ $client->clientinfo->companyNo}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-sm btn-primary ml-2" title="Edit"
                                               href='{{ route("admin.client.edit",$client->id) }}'><i
                                                    class='fa fa-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $clients->render()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("js")
    <script src="{{ asset('public/js/datatablescripts.bundle.js') }}" defer></script>
    <script src="{{ asset('assest/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}" defer></script>
    <script src="{{ asset('assest/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('assest/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}" defer></script>
    <script src="{{ asset('assest/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}" defer></script>
    <script src="{{ asset('assest/assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}" defer></script>
    <script src="{{ asset('assest/assets/js/jquery-datatable.js') }}" defer></script>
@endsection

