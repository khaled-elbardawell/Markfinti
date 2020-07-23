@extends("layouts._admin")
@section("title", "Project Notes")
@section("content")
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
                    <div class="chatapp_body">
                        <div class="chat-header clearfix">
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <div class="chat-about">
                                        <h6 data-id="{{$project->id}}" class="m-b-0">{{ $project->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="message_data">
                                @foreach($project->notes as $note)
                                    <li class="{{ ($note->sender->role == auth()->user()->role)? 'left':'right'   }} mb-5 clearfix">
@if(auth()->user()->role != $note->sender->role )
                                            @if( is_null( $note->sender->photo ) )
                                                <div style=" width: 50px;  {{ ($note->sender->role != auth()->user()->role )?  'margin-left: auto' : '' }} "     class="default-logo" >{{default_img_sender($note->sender->fname)}} </div>
                                            @else
                                                <img style="left:0px; bottom:50px;width: 50px {{ ($note->sender->role != auth()->user()->role )?  'margin-left: auto' : '' }}"  src="{{ asset("assest/upload/profiles/" . $note->sender->photo) }}"  alt="{{ $note->sender->fname}} {{ $note->sender->lname}}" class="user_pix"  />

                                            @endif
    @endif



                                        <div class="message">
                                            <span>{{ $note->message }}</span>
                                        </div>
                                        <span class="data_time">{{ $note->date }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <form>
                                <div class="input-group mb-0">
                                    <input id="project_id" name="project_id" type="hidden" value ="{{$project->id}}">
                                    <textarea maxlength="191" id="message" class="form-control" name="message"
                                              placeholder="Enter text here... ">{{ old('message') }}</textarea>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <button type="button"  id ="confirmation"class="btn btn-primary">Send</button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="chatapp_detail text-center vivify pullLeft delay-150">
                        <div class="profile-image">
                            @if(auth()->user()->role == "2" )
                                @if( is_null( $project->client->photo ) )
                                    <div style=" display: inline-block; width: 50px; "     class="default-logo" >{{default_img_sender($project->client->fname)}} </div>
                                @else
                                    <img style="display: inline-block; width: 50px "  src="{{ asset("assest/upload/profiles/" . $project->client->photo) }}"  alt="{{ $project->client->fname}} {{$project->client->lname}}" class="user_pix"  />

                                @endif

                                    <h5 class="mb-0">{{$project->client->fname}} {{$project->client->lname}}</h5>
                                    <small class="text-muted">Address: </small>
                                    <p>{{$project->client->address}}</p>
                                    <small class="text-muted">Email address: </small>
                                    <p>{{$project->client->email}}</p>
                                    <small class="text-muted">Mobile: </small>
                                    <p>{{$project->client->phone}}</p>
                           @endif

                                @if(auth()->user()->role == "3" )
                                    @if( is_null( $project->manger->photo ) )
                                        <div style=" display: inline-block; width: 50px; "     class="default-logo" >{{default_img_sender($project->manger->fname)}} </div>
                                    @else
                                        <img style="display: inline-block; width: 50px "  src="{{ asset("assest/upload/profiles/" . $project->manger->photo) }}"  alt="{{ $project->manger->fname}} {{$project->manger->lname}}" class="user_pix"  />

                                    @endif

                                        <h5 class="mb-0">{{$project->manger->fname}} {{$project->manger->lname}}</h5>
                                        <small class="text-muted">Address: </small>
                                        <p>{{$project->manger->address}}</p>
                                        <small class="text-muted">Email address: </small>
                                        <p>{{$project->manger->email}}</p>
                                        <small class="text-muted">Mobile: </small>
                                        <p>{{$project->manger->phone}}</p>
                                @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    <script>


        $(document).ready(function () {


            //  Add Transaction by AJAX
            var id,msg;

            $('#confirmation').click(function(){
                msg = $('#message').val();
                id = $('h6').data('id');

                $.ajax(
                    {

                        url: "send/"+id,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "msg" : msg,
                            "_token": '{{ csrf_token() }}',
                        },
                        success: function (data)
                        {
                             $('#message').val('');


                            $('.message_data').append("<li class=\"left mb-5 clearfix\">\n" +
                                "                            <div class=\"message\">\n" +
                                "                            <span>"+ data['msg'] +"</span>\n" +
                                "                            </div>\n" +
                                "                            <span class=\"data_time\">"+ data['date'] +"</span>\n" +
                                "                            </li>");


                        },error: function (rej)
                        {


                        }

                    });

            });

        });




    </script>



@endsection
