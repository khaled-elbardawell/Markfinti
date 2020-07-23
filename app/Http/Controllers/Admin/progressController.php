<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\progressRequest;
use App\Http\Requests\serviceRequest;
use App\Progress;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class progressController extends Controller
{
    public function index(){
        $this->authorize('viewAny', "App\Progress");

        $progresses =  Progress::where('is_deleted','0')->paginate(PAGINATION_COUNT);
        return view('progress.index')->with('progresses',$progresses);
    }


    public function update(progressRequest $request , $id){
        $this->authorize('update', "App\Progress");

        try {
            if($request->ajax()){

            if ($id == $request->id) {
                $progress = Progress::find($id);
                if ($progress) {
                    if ($progress->is_deleted == '0') {
                        $progress->update([
                            'name' => $request->name
                        ]);
                        return response()->json([
                            'success' => 'Record has been updated successfully!',
                            'id' => $progress->id,
                            'name' => $progress->name
                        ]);
                    } else {
                        return response()->json([
                            'error' => 'Error pleade try again !!'
                        ]);
                    }

                } else {
                    return response()->json([
                        'error' => 'Error pleade try again !!'
                    ]);
                }
            } else {
                return response()->json([
                    'error' => 'Error pleade try again !!'
                ]);
            }
        }
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Error pleade try again !!'
            ]);
        }


    }



    public function store(progressRequest $request,$id){
        $this->authorize('store', "App\Progress");
  try {
      if($request->ajax()){

          if ($id == $request->id) {
          $user = User::find($id);
          if ($user) {
              if ($user->role == '1') {
                  $progress = Progress::create([
                      'name' => $request->name
                  ]);

                    $number_page = ceil( Progress::where('is_deleted','0')->count() /  PAGINATION_COUNT );

                  return response()->json([
                      'success' => 'Record has been deleted successfully!',
                      'id' => $progress->id,
                      'number_page' => $number_page,
                      'name' => $request->name
                  ]);
              } else {
                  return response()->json([
                      'error' => 'Error pleade try again !!'
                  ]);
              }

          } else {
              return response()->json([
                  'error' => 'Error pleade try again !!'
              ]);
          }

      } else {
          return response()->json([
              'error' => 'Error pleade try again !!'
          ]);
      }
  }



  }catch (\Exception $e){
      return response()->json([
          'error' => 'Error pleade try again !!'
      ]);
  }


    }

    public function delete(Request $request , $id){

        $this->authorize('delete', "App\Progress");

        try{
            if($request->ajax()){
                $this->validate($request,[
                    'id'  => "required"
                ]);
                $progress = Progress::find($id);
                if($progress) {
                    $progress->update([
                        'is_deleted' => '1'
                    ]);
                    return response()->json([
                        'success' => 'Record has been Deleted successfully!',
                    ]);
                }else{
                    return response()->json([
                        'error' => 'Error pleade try again !!'
                    ]);
                }

            }


        }catch (\Exception $e){
            return response()->json([
                'error' => 'Error pleade try again !!'
            ]);
        }


    }
}
