{{--  view managers page  --}}

@extends("layouts._admin")

@section("title", "Managers")
@section("css")
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}" type="text/css"
          rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">
    <link href="{{ asset('assest/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"
          type="text/css" rel="stylesheet">

@endsection

@section("content")
<div class="container">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h1>@yield("title")</h1>
            </div>
            <div class="col-md-6 col-sm-12 text-right hidden-xs">
                <a href="{{ route('admin.manger.create') }}" class="btn btn-sm btn-primary" title=""><i
                        class="icon-user-follow"></i> Add</a>
                <a href="{{ route('admin.manger.viewblock') }}" class="btn btn-sm btn-primary" title="">Blocked</a>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable table-custom spacing8" id="manager">
                        <thead>
                        <tr>
                            <th>Code No.</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>ID/Passport No.</th>
                            <th>Position</th>
                            <th width="15%">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $c = 0; ?>

                        @foreach($users as $user)
                            <tr>
                                <td>{{ ++$c }}</td>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->identity }}</td>
                                <td>{{ $user->position}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="">
                                        <a class="btn btn-sm btn-primary ml-2" title="Edit"
                                           href='{{ route("admin.manger.edit",$user->id) }}'>
                                            <i class='fa fa-edit'></i>
                                        </a>
                                    </div>

                                    <!-- Button trigger modal Block btn -->
                                    <div class="btn-group" role="group" aria-label="">
                                        <button type="button"  data-toggle="modal" data-target="#staticBackdrop"  data-id="{{ $user->id }}" class="btn btn-sm btn-danger getId ml-2" title="Block" >
                                            <i class='fa fa-window-close'></i>
                                        </button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade confirmtion" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Confirm</h5>
                                                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to make a block for this person ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button"  class="btn btn-danger block">ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $users->render()  }}

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section("js")
    <script>

        function counter(){
            $(' tbody  > tr').each(function(index, tr) {
                console.log($(this).children().first().text(index+1));
            });
        }





        var id,ele;
        $('.getId').click(function () {
             id = $(this).data("id");
             ele = $(this).parents('tr')
          });

        $(".block").click(function(){
            console.log(id);
            console.log(ele);
            $.ajax(
                {
                    url: "block/"+id,
                    type: 'POST',
                    beforeSend:function(){
                      $('.block').text('loading..');
                    },
                    dataType: "JSON",
                    data: {
                        "id": id,
                        "_token": '{{ csrf_token() }}',
                    },
                    success: function (data)
                    {
                        $('.confirmtion').modal('hide');
                        $('body').css('paddingRight','0px');
                        $('.modal-backdrop ').remove();
                        $('body').removeClass('modal-open');
                        $('.block').text('ok');
                         ele.remove();
                        counter();

                        if($('tbody > tr').length == 0){
                            var url =  $(location).attr("href");
                            var arr =   url.split("?")
                            if(arr.length == 2){
                                var num  = parseInt(url.slice(-1));
                                url =  url.slice(0, -1);
                                if(num == 1){
                                    num = 1;
                                }else{
                                    num -= 1;
                                }

                                location.href= url + num;
                            }
                        }

                         $('table').before('  <div class="row mr-2 ml-2">\n' +
                             '        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"\n' +
                             '                id="type-error">Successfully Blocked \n' +
                             '        </button>\n' +
                             '    </div>');



                         setTimeout(function () {
                            $('.btn-block').fadeOut();
                         },2000)


                    },error: function (rej)
                    {
                        console.log(rej);
                    }

                });

        });



    </script>
@endsection
























