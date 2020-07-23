<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\clientRequest;
use App\Http\Requests\editclientRequest;
use App\InfoClient;
use App\Notifications\welcomeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class clientController extends Controller
{

    public function index(){
        $this->authorize('viewAnyClient', "App\User");

        $clients =   User::selection()->with(['clientinfo' => function ($q){
            $q->select('companyField','companyName','companyNo','user_id');
        }])->where('role','3')->where('manger_id',auth()->id())->paginate(PAGINATION_COUNT);
        return view('clients.index')->with('clients',$clients);
    }

    public function edit($id){
        $this->authorize('editClient', "App\User");

        $client =   User::selection()->with(['clientinfo' => function ($q){
            $q->select('companyField','companyName','companyNo','user_id');
        }])->find($id);

         if(!$client)  return redirect()->route('admin.manger.index')->with('error','The client account you are trying to access is not available !!');


        return view('clients.edit')->with('client',$client);
    }

    public function update(editclientRequest $request,$id){

        $this->authorize('updateClient', "App\User");

        try{
            $client =   User::with('clientinfo')->find($id);

            if(!$client)  return redirect()->route('admin.client.index')->with('error','The client account you are trying to access is not available !!');

            $data = $request->all();


            DB::beginTransaction();
            // update in DB

            $client-> fname = $request->fname;
            $client-> lname = $request->lname;
            $client-> phone = $request->phone;
            $client-> email = $request->email;
            $client-> position = $request->position;
            $client-> address = $request->address;
            if (!is_null( $request->password) ){
                $client-> password = bcrypt($request->password);
            }
            $client->save();



// Now update the relation
            $client->clientinfo->update([
                'companyField' => $request->companyField,
                'companyNo' => $request->companyNo,
                'companyName' => $request->companyName
            ]);

            DB::commit();

            return redirect()->route('admin.client.index')->with('success','Successfully updated !!');


        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('home')->with('error','please try again');
        }


     }

    public function create(){
        $this->authorize('createClient', "App\User");

        return view('clients.create');
    }

    public function store(clientRequest $request){
        $this->authorize('storeClient', "App\User");

        // validate
        try {
            if ($request->has('photo')){
                $img = $request->photo;
                //  save img
                $img = save_img($request->photo,'assest/upload/clients');
            }else{
                $img = null;
            }

             DB::beginTransaction();
                // store in DB
          $user =    User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'email' => $request->email,
                'role'  => '3',
                'position' => $request->position,
                'address' => $request->address,
                'password' => bcrypt( $request->password ),
                'photo' => $img,
                'manger_id' => auth()->id(),
            ]);


            $user->clientinfo()->create([
                'companyName' => $request->companyName,
                'companyNo'	=> $request->companyNo,
                'companyField'	=> $request->companyField,
            ]);


            Notification::send($user,new welcomeMail([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'password' => $request->password,
            ]));

            DB::commit();
            return redirect()->route('home')->with('success','Successfully added');


        }catch (\Exception $e){
            return $e;
            DB::rollBack();
            return redirect()->route('home')->with('error','please try again');
        }

    }

}
