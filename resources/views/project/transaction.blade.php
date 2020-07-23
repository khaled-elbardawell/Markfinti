@extends("layouts._admin")
@section("title", "Transactions")

@section("css")
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}" type="text/css"
          rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"
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
                @can('addTransaction', "App\Project")

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <!-- Button trigger modal -->
                    <button type="button"  data-id="{{$project->id }}"  class="btn btn-primary getId" data-toggle="modal" data-target="#add">
                        Add
                        Transaction
                    </button>

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
                                <th> #</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Pay Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0?>
                            @foreach($project->transactions as $transaction)
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td>{{ $transaction->amount}}</td>
                                    <td>{{ $transaction->pay_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>






    <!-- add Modal -->
    <div class="modal fade confirmtion" id="add" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 ">
                    <form method="POST"  id="addService_form" action="">
                        @csrf

                        <div class="modal-body addService " >
                            <p class="text-success addTypeSuccess"></p>

                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <label for="name">Amount</label>
                                    <div class="form-group">
                                        <input value="" type="text" class="form-control amount"
                                               name="amount" placeholder="" >
                                        <p class="text-danger nameError"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Date </label>
                                    <div class="form-group">
                                        <input value="" type="date" class="form-control date"
                                               name="date" placeholder="" >
                                        <p class="text-danger nameError"></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add-btn">Add</button>
                </div>
            </div>
        </div>
    </div>



    {{--   End model --}}

@endsection



@section("js")
    <script src="{{ asset('assest/html/assets/bundles/datatablescripts.bundle.js') }}" defer></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" defer></script>
    <script>

        $(document).ready(function () {


            //  Add Transaction by AJAX
            var id,amount,date;
            $('.getId').click(function () {
                id = $(this).data("id");
            });

            $('.add-btn').click(function(){
                amount = $('.amount').val();
                date = $('.date').val();

                $.ajax(
                    {

                        url: "add/"+id,
                        type: 'POST',
                        beforeSend:function(){
                            $('.add-btn').text('loading..');
                        },
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "amount" : amount,
                            "date" : date,
                            "_token": '{{ csrf_token() }}',
                        },
                        success: function (data)
                        {
                            $('.confirmtion').modal('hide');
                            $('body').css('paddingRight','0px');
                            $('.modal-backdrop ').remove();
                            $('body').removeClass('modal-open');
                            $('.add-btn').text('ok');

                            $('table').before('  <div class="row mr-2 ml-2">\n' +
                                '        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"\n' +
                                '                id="type-error">Successfully Added \n' +
                                '        </button>\n' +
                                '    </div>');


                            setTimeout(function () {
                                $('.btn-block').fadeOut();
                            },2000)

                            if(isNaN(parseInt($('tr').last().text()) )){
                                var count = 1;
                            }else{
                                var count =  parseInt($('tr').last().text()) + 1;
                            }


                            $('table').append(`<tr>
                                    <td>${count}</td>
                                    <td>${data['amount']}</td>
                                    <td>${data['pay_date']}</td>
                                </tr>`);


                        },error: function (rej)
                        {
                            $('.addService').prepend('  <div class="row mr-2 ml-2">\n' +
                                '        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"\n' +
                                '                id="type-error">The given data was invalid. \n' +
                                '        </button>\n' +
                                '    </div>');

                            $('.add-btn').text('ok');

                            setTimeout(function () {
                                $('.btn-block').fadeOut();
                            },2000)

                        }

                    });

            });

        });




    </script>
@endsection
