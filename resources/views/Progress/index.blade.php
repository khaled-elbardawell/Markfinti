@extends("layouts._admin")
@section("title", "Progress Types")

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
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <!-- Button trigger modal -->
                    <button type="button"  data-id="{{ auth()->id() }}"  class="btn btn-primary getId" data-toggle="modal" data-target="#add">
                        Add
                        Progress
                    </button>





                </div>
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
                                <th> Progress name</th>
                                <th width="5%" >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0?>
                            @foreach($progresses as $progress)
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td>{{ $progress->name }}</td>
                                    <td class="text-right">
                                        <a data-toggle="modal" data-id="{{ $progress->id }}" data-target="#update" href="#" class="btn btn-primary updateType" id="{{$progress->id}}">
                                            <i class='fa fa-edit'></i>
                                        </a>

                                        <a data-toggle="modal" data-id="{{ $progress->id }}" data-target="#delete" href="#" class="btn btn-danger daleteType" id="{{$progress->id}}">
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $progresses->render()  }}
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- dalete Modal -->
    <div class="modal fade confirmtion3" id="delete" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm</h5>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body DeleteService">
                    Are you sure you want to delete this progress ?
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button"  class="btn btn-danger delete">ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- update Modal -->
    <div class="modal fade confirmtion2" id="update" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Progress Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0 ">
                    <form method="POST"  id="addService_form" action="">
                        @csrf

                        <div class="modal-body updateService " >
                            <p class="text-success addTypeSuccess"></p>

                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Progress name </label>
                                        <input value="" type="text" class="form-control typeUpdateService"
                                               name="name" placeholder="Enter Progress name" >
                                        <p class="text-danger nameError"></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-btn">Update</button>
                </div>
            </div>
        </div>
    </div>



    {{--   End model --}}





    {{--   add model --}}


    <!-- Modal -->
    <div class="modal fade confirmtion" id="add" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Progress Name</h5>
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
                                    <label for="name">Progress name </label>

                                    <div class="form-group">
                                        <input value="" type="text" class="form-control typeService"
                                               name="name" placeholder="Enter Progress name" >
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





            function counter(){
            $('#m_table_1  > tbody  > tr').each(function(index, tr) {
                console.log($(this).children().first().text(index+1));
            });
        }


        $(document).ready(function () {


            if($('#m_table_1').next().children().hasClass('pagination')){
                var bo = true;
            }else{
                var bo = false;
            }




            // delete Service by AJAX


            var id,ele;
            $('body').on('click','.daleteType',function (e) {
                id = $(this).data("id");
                ele = $(this).parents('tr')
            });

            $(".delete").click(function(){
                console.log(id);
                console.log(ele);
                $.ajax(
                    {
                        url: "progress/delete/"+id,
                        type: 'POST',
                        beforeSend:function(){
                            $('.delete').text('loading..');
                        },
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_token": '{{ csrf_token() }}',
                        },
                        success: function (data)
                        {
                            $('.confirmtion3').modal('hide');
                            $('body').css('paddingRight','0px');
                            $('.modal-backdrop ').remove();
                            $('body').removeClass('modal-open');
                            $('.delete').text('ok');
                            ele.remove();
                            counter()


                            if(  parseInt( document.querySelector('#m_table_1 >  tbody').childElementCount) == 0 ){
                                var url =  $(location).attr("href");
                                var arr =   url.split("?")
                                if(arr.length == 2){
                                    var num  = parseInt(url.slice(-1));
                                    url =  url.slice(0, -1);
                                    num -= 1;
                                    location.href= url + num;
                                }else{
                                    location.href= url + "?page=1";
                                }
                            }



                            $('table').before('  <div class="row mr-2 ml-2">\n' +
                                '        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"\n' +
                                '                id="type-error">Successfully Deleted \n' +
                                '        </button>\n' +
                                '    </div>');

                            setTimeout(function () {
                                $('.btn-block').fadeOut();
                            },2000)




                        },error: function (rej)
                        {
                            $('.DeleteService').prepend('  <div class="row mr-2 ml-2">\n' +
                                '        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"\n' +
                                '                id="type-error">The given data was invalid. \n' +
                                '        </button>\n' +
                                '    </div>');

                            $('.delete').text('ok');

                            setTimeout(function () {
                                $('.btn-block').fadeOut();
                            },2000)

                        }

                    });

            });




            // update Service by AJAX

            var id,ele,name,oldval;
            $('body').on('click','.updateType',function (e) {
                e.preventDefault();

                id = $(this).data("id");
                ele = $(this).parents('tr')
                oldval = ele.children().eq(1).text()
                $('.typeUpdateService').val(ele.children().eq(1).text());
            });


            $('.update-btn').click(function(){
                name = $('.typeUpdateService').val();

                $.ajax(
                    {
                        url: "progress/update/"+id,
                        type: 'POST',
                        beforeSend:function(){
                            $('.update-btn').text('loading..');
                        },
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "name" : name,
                            "_token": '{{ csrf_token() }}',
                        },
                        success: function (data)
                        {

                            $('.confirmtion2').modal('hide');
                            $('body').css('paddingRight','0px');
                            $('.modal-backdrop ').remove();
                            $('body').removeClass('modal-open');
                            $('.update-btn').text('ok');

                            $('table').before('  <div class="row mr-2 ml-2">\n' +
                                '        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"\n' +
                                '                id="type-error">Successfully Updated \n' +
                                '        </button>\n' +
                                '    </div>');


                            setTimeout(function () {
                                $('.btn-block').fadeOut();
                            },2000)

                            ele.children().eq(1).text(data['name']);



                        },error: function (rej)
                        {
                            $('.updateService').prepend('  <div class="row mr-2 ml-2">\n' +
                                '        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"\n' +
                                '                id="type-error">The given data was invalid. \n' +
                                '        </button>\n' +
                                '    </div>');

                            $('.update-btn').text('ok');

                            setTimeout(function () {
                                $('.btn-block').fadeOut();
                            },2000)


                            $('.typeUpdateService').val(oldval);

                        }

                    });
            });



            //  Add Service by AJAX
            var id2,name2;
            $('.getId').click(function () {
                id2 = $(this).data("id");
            });

            $('.add-btn').click(function(){
                name2 = $('.typeService').val();

                $.ajax(
                    {
                        url: "progress/store/"+id2,
                        type: 'POST',
                        beforeSend:function(){
                            $('.add-btn').text('loading..');
                        },
                        dataType: "JSON",
                        data: {
                            "id": id2,
                            "name" : name2,
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


                                  $('table').append(`<tr>
                                    <td>${count}</td>
                                    <td>${data['name']}</td>
                                    <td class="text-right">
                                        <a data-toggle="modal" data-id="${data['id']}" data-target="#update" href="#" class="btn btn-primary updateType" id="${data['id']}">
                                            <i class='fa fa-edit'></i>
                                        </a>

                                         <a data-toggle="modal" data-id="${data['id']}" data-target="#delete" href="#" class="btn btn-danger daleteType" id="${data['id']}">
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>`);
                            $('.typeService').val('');

                            }else if( parseInt($('tr').last().text()) == 2){


                                var url =  $(location).attr("href");
                                var arr =   url.split("?")
                                if(arr.length == 2){
                                    var s = arr[1].split("=");
                                    url = url.replace(s[1],data['number_page'])

                                    location.href=url;


                                }else{
                                    location.href= url + "?page="+ data['number_page'];

                                }


                            }

                            else{

                                var count =  parseInt($('tr').last().text()) + 1;
                                   $('table').append(`<tr>
                                    <td>${count}</td>
                                    <td>${data['name']}</td>
                                    <td class="text-right">
                                        <a data-toggle="modal" data-id="${data['id']}" data-target="#update" href="#" class="btn btn-primary updateType" id="${data['id']}">
                                            <i class='fa fa-edit'></i>
                                        </a>

                                         <a data-toggle="modal" data-id="${data['id']}" data-target="#delete" href="#" class="btn btn-danger daleteType" id="${data['id']}">
                                            <i class='fa fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>`);
                            $('.typeService').val('');


                            }





             


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
