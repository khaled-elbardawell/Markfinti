<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\mangerRequest;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\profileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class profileController extends Controller
{
    public function edit(){
          return view('profile.profile');
    }

    public function update(profileRequest $request){
        try{
           // validate


            if ($request->has('photo')){

                // delete file from upload
                if (auth()->user()->photo){
                    $image ='assest/upload/profiles/'.auth()->user()->photo;
                    $image = base_path( $image);
                  unlink($image); //delete from folder
                }


                // save img whene request has img
                $img = save_img($request->photo,'assest/upload/profiles');
            }else{
                $img = auth()->user()->photo;
            }




           // update in DB
            User::where('id', auth()->id())
                ->update([
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'photo'   => $img
                ]);


            return redirect()->route('home')->with('success','Successfully updated your profile !!');

        }catch (\Exception $e){
            return redirect()->route('home')->with('error','please try again');

        }
    }


    public function changePassword(changePasswordRequest $request){
        try{

            // validate
            if(!$request->has('current_password'))
                return redirect()->route('home')->with('error','please try again');

             // check current password field with session
            if ( Hash::check($request->current_password,auth()->user()->password) ){
                // chang password

                    User::find(auth()->id())->update(['password' => bcrypt($request->new_password)]);

                return redirect()->route('home')->with('success','Successfully updated your password !!');


            }else{
                return redirect()->route('home')->with('error','The current password  in-valid');

            }


        }catch (\Exception $e){
            return redirect()->route('home')->with('error','please try again');

        }


    }
}
