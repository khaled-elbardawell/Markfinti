<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\serviceRequest;
use App\Project;
use App\Service;
use App\User;
use http\Client;
use Illuminate\Http\Request;

class serviceController extends Controller
{
    public function index(){
        $this->authorize('viewAny', "App\Service");

        $services =  Service::where('is_deleted','0')->paginate(PAGINATION_COUNT);
       return view('service.index')->with('services',$services);
    }



    public function update(serviceRequest $request , $id){
        $this->authorize('update', "App\Service");

        try{
            if ($request->ajax()){
                if($id == $request->id){
                    $service = Service::find($id);
                    if($service){
                        if ($service->is_deleted == '0') {
                            $service->update([
                                'name' => $request->name
                            ]);
                            return response()->json([
                                'success' => 'Record has been updated successfully!',
                                'id'  => $service->id,
                                'name' => $request->name
                            ]);
                        }else{
                            return response()->json([
                                'error' => 'Error pleade try again !!'
                            ]);
                        }

                    }else{
                        return response()->json([
                            'error' => 'Error pleade try again !!'
                        ]);
                    }
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



    public function store(serviceRequest $request,$id){

        $this->authorize('store', "App\Service");
        try{
            if ($request->ajax()){
                if($id == $request->id){
                    $user = User::find($id);
                    if($user){
                        if ($user->role == '1') {
                            $s =   Service::create([
                                'name' => $request->name
                            ]);
                          $number_page = ceil( Service::where('is_deleted','0')->count() /  PAGINATION_COUNT );

                            return response()->json([
                                'success' => 'Record has been deleted successfully!',
                                'id'  => $s->id,
                                'number_page' => $number_page,
                                'name' => $request->name
                            ]);
                        }else{
                            return response()->json([
                                'error' => 'Error pleade try again !!'
                            ]);
                        }

                    }else{
                        return response()->json([
                            'error' => 'Error pleade try again !!'
                        ]);
                    }

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

    public function delete(Request $request , $id){
        $this->authorize('delete', "App\Service");

        $this->validate($request,[
            'id'  => "required"
        ]);

        try{
            if ($request->ajax()){
                $service = Service::find($id);
                if($service) {
                    $service->update([
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
