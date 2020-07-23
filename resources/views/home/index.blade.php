{{--  Home page   --}}

@extends("layouts._admin")
@section("title", "Home ")

@section("content")
    <h2 style="color: #1b150d85;">Dashboard</h2>

    <div class="container mt-5">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-danger text-white rounded-circle"><i class="icon-briefcase  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Managers</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\User::where('role','2')->count()}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-folder-open-o  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Projects</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\Project::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="icon-users  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Clients</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\User::where('role','3')->count()}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-red text-white rounded-circle"><i class="icon-docs  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Reports</span>
                                <h4 class="mb-0 font-weight-medium">{{ \App\Reports::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg  bg-cyan text-white rounded-circle"><i class="fa fa-file-text-o  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Notes</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\Notes::count()}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-green text-white rounded-circle"><i class="fa fa-dollar  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Transactions</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\Transaction::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-blush text-white rounded-circle"><i class="icon-docs  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Types Report</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\TypeReport::count()}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-purple text-white rounded-circle"><i class="icon-layers fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Services</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\Service::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-primary text-white rounded-circle"><i class="icon-graph  fa-2x"></i></div>
                            <div class="ml-4">
                                <span>Progresses</span>
                                <h4 class="mb-0 font-weight-medium">{{\App\Progress::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>

@endsection
