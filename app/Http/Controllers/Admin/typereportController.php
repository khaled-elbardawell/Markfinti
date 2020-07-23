<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\serviceRequest;
use App\Http\Requests\typeReportRequest;
use App\Project;
use App\Service;
use App\TypeReport;
use App\User;
use http\Client;
use Illuminate\Http\Request;

class typereportController extends Controller
{

    public function index(){
        $this->authorize('viewAny', "App\TypeReport");

        $types =  TypeReport::where('is_deleted','0')->paginate(PAGINATION_COUNT);
       return view('typeReport.index')->with('types',$types);
    }



    public function update(typeReportRequest $request , $id){
        $this->authorize('update', "App\TypeReport");

        try{
           if ($request->ajax()){
               if($id == $request->id){
                   $type = TypeReport::find($id);
                   if($type){
                       if ($type->is_deleted == '0') {
                           $type->update([
                               'name' => $request->name
                           ]);
                           return response()->json([
                               'success' => 'Record has been updated successfully!',
                               'id'  => $type->id,
                               'name' => $type->name
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



    public function store(typeReportRequest $request,$id){
        $this->authorize('store', "App\TypeReport");

        try{
            if ($request->ajax()){

                if($id == $request->id){
                    $user = User::find($id);
                    if($user){
                        if ($user->role == '1') {
                            $type=   TypeReport::create([
                                'name' => $request->name
                            ]);

                         $number_page = ceil( TypeReport::where('is_deleted','0')->count() /  PAGINATION_COUNT );

                            return response()->json([
                                'success' => 'Record has been deleted successfully!',
                                'id'  => $type->id,
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
        $this->authorize('delete', "App\TypeReport");

        try{
            if ($request->ajax()){
                $this->validate($request,[
                    'id'  => "required"
                ]);
                $type = TypeReport::find($id);
                if($type) {
                    $type->update([
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
