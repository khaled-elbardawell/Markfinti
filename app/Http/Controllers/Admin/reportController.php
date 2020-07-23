<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\reportRequest;
use App\Http\Requests\serviceRequest;
use App\Http\Requests\typeReportRequest;
use App\Project;
use App\Reports;
use App\Service;
use App\TypeReport;
use App\User;
use http\Client;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public $id;

    public function index($id){

        $this->authorize('viewAny', "App\Report");


        $this->id = $id;
       $reports =  Reports::with(['project' => function($q){
           $q->find($this->id);
       }])->where('project_id',$id)->paginate(PAGINATION_COUNT);



        if (!$reports){
            return redirect()->route('admin.project.index')->with('error','The project you are trying to access is not available !!');
        }

        $project_id = $id;

        $types = TypeReport::where('is_deleted','0')->get();

        return view('project.report')->with(['types'=> $types,'reports' => $reports , 'project_id'=> $project_id]);
    }




    public function store(reportRequest $request,$id){
        $this->authorize('store', "App\Report");

        // validate

        // validate
        if( !validateInteger($request->type_id) ){
            return redirect()->route('admin.project.index')->with('error','please try again!!');
        }

try{

    $project = Project::find($id);
    if ( !$project){
        return redirect()->route('admin.project.report',$id)->with('error','Error pleade try again !!');

    }

    // save file request has file
    $file_name = $request->fileupload->getClientOriginalName();
    $file = save_file($request->fileupload,'assest/upload/reports');




    $type =   TypeReport::find($request->type_id);
    if ( !$type){
        return redirect()->route('admin.project.report',$id)->with('error','Error pleade try again !!');
    }


    $reports =  Reports::create([
        "reports" => $file ,
        "name"    => $file_name,
        "type_id"    => $request->type_id ,
        "project_id"    => $id ,
        "added_date" =>$request->added_date,
    ]);

    return redirect()->route('admin.project.report',$id)->with('success','Successfully Added new report !!');

}catch (\Exception $e){
    return redirect()->route('admin.project.report',$id)->with('error','Error pleade try again !!');

}

}



    public function getDownload($file_name)
        {
            $this->authorize('getDownload', "App\Report");

            // validate

            // file is stored under project/public/download/info.pdf
            $file= base_path() . "/assest/upload/reports/".$file_name;


            $headers = array(
                'Content-Type: application/pdf',
                'Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            );

            if (file_exists($file)){
                return response()->download($file, $file_name,$headers);

            }else{
                return redirect()->route('home')->with('error','Error pleade try again !!');
            }


        }

}
