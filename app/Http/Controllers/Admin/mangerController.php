<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\mangerRequest;
use App\Notifications\welcomeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class mangerController extends Controller
{


    public function index(){

        $this->authorize('viewAny', "App\User");

        $users =  User::selection()->where('role','2')->where('active','1')->paginate(PAGINATION_COUNT);;
        return view('managers.index')->with('users',$users);
    }

    public function edit($id){

        $this->authorize('edit', "App\User");


        $user =  User::find($id);
        if (!$user){
            return redirect()->route('admin.manger.index')->with('error','The manager account you are trying to access is not available !!');
        }
        return view('managers.edit')->with('user',$user);
    }

    public function update(mangerRequest $request ,$id){
        // validate

        $this->authorize('update', "App\User");

        try {

                $user = User::find($id);
            if (!$user) {
                return redirect()->route('admin.manger.index')->with('error', 'The manager account you are trying to access is not available !!');
            }

            $data = $request->all();
            if (is_null($request->password)) {
                $data = $request->except(['_token', 'id', 'password']);
            } else {
                $request->request->set('password', bcrypt($request->password));
            }
            // update in DB
            $user->update($data);

            return redirect()->route('admin.manger.index')->with('success', 'Successfully Updated ');

        }catch (\Exception $e){
            return redirect()->route('home')->with('error','please try again');
        }

    }



    public function create(){
        $this->authorize('create', "App\User");

        return view('managers.create');
    }

    public function store(mangerRequest $request){

        $this->authorize('store', "App\User");


        // validate
        try {

            if ($request->has('photo')) {
                $img = $request->photo;
                //  save img
                $img = save_img($request->photo, 'assest/upload/mangers');
            } else {
                $img = null;
            }

            DB::beginTransaction();
            // store in DB
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'role' => '2',
                'email' => $request->email,
                'position' => $request->position,
                'identity' => $request->identity,
                'address' => $request->address,
                'password' => bcrypt($request->password),
                'photo' => $img,

            ]);


            Notification::send($user, new welcomeMail([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'password' => $request->password,
            ]));
            DB::commit();

            return redirect()->route('home')->with('success', 'Successfully added');


        }catch (\Exception $e){
            DB::rollBack();
             return redirect()->route('home')->with('error','please try again');
        }

    }


    public function block(Request $request,$id){

        $this->authorize('block', "App\User");
        try {
            if($request->ajax()){

                $user = User::find($id);
            if (!$user) return redirect()->route('home')->with('error', 'please try again');

            $user->active = '0';
            $user->save();

            return response()->json([
                'success' => 'Record has been deleted successfully!'
            ]);
        }
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Record can not deleted!'
            ]);
        }

    }

    public function unblock(Request $request,$id){

        $this->authorize('unblock', "App\User");
        try {
            if($request->ajax()){

                $user = User::find($id);
            if (!$user) return redirect()->route('home')->with('error', 'please try again');

            $user->active = '1';
            $user->save();

            return response()->json([
                'success' => 'Record has been deleted successfully!'
            ]);
         }
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Record can not deleted!'
            ]);
        }
        }






    public function viewBlock(){
        $this->authorize('viewBlock', "App\User");

        $users =  User::selection()->where('role','2')->where('active','0')->paginate(PAGINATION_COUNT);;
        return view('managers.block')->with('users',$users);
    }



}
