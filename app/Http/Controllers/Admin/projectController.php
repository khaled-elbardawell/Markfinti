<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\noteRequest;
use App\Http\Requests\projectRequest;
use App\Http\Requests\transactionRequest;
use App\Notes;
use App\Progress;
use App\Project;
use App\Service;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class projectController extends Controller
{
    public function index(){
        if (auth()->user()->role == '3' ){
            $projects =  Project::with(['progress' => function($q){
                $q->select('id','name')->where('is_deleted','0')->first();
            }])->where('user_id',auth()->id())->paginate(PAGINATION_COUNT);
        }else if(auth()->user()->role == '2') {
            $projects =  Project::with(['progress' => function($q){
                $q->select('id','name')->where('is_deleted','0')->first();
            }])->where('manger_id',auth()->id())->paginate(PAGINATION_COUNT);
        }else{
             $projects =  Project::with(['progress' => function($q){
                $q->select('id','name')->where('is_deleted','0')->get();
            }])->paginate(PAGINATION_COUNT);
        }
      return view('project.index')->with('projects',$projects);
    }

    public function edit($id){

        $this->authorize('edit', "App\Project");


        $project = Project::with(['progress' => function($q){
             $q->where('is_deleted','0')->get();
         },'client','manger','services'])->find($id);

        if (!$project){
            return redirect()->route('admin.project.index')->with('error','The project you are trying to access is not available !!');
        }

          $progress = Progress::select('id','name')->where('is_deleted','0')->get();
          $services = Service::select('id','name')->where('is_deleted','0')->get();
          $mangers = User::select('id','fname','lname')->where('role','2')->get();

        if (auth()->user()->role == "2"){
            $clients = User::select('id','fname','lname')->where('manger_id',auth()->id())->get();
            return view('project.edit')->with(['project'=> $project , 'progresses' => $progress , 'managers'=> $mangers , 'services' => $services ,  'clients' => $clients]);
        }

        return view('project.edit')->with(['project'=> $project , 'progresses' => $progress , 'managers'=> $mangers , 'services' => $services]);
    }

    public function update(projectRequest $request , $id){

        $this->authorize('update', "App\Project");

        try{


        // validate
        $project =  Project::find($id);
        if (!$project){
            return redirect()->route('admin.project.index')->with('error','The manager account you are trying to access is not available !!');
        }

        if (auth()->user()->role == 1){
            if(  !validateInteger($request->manager_id)  ){
                return redirect()->route('admin.project.index')->with('error','please try again!!');
            }
        }
        if( !validateInteger($request->user_id) || !validateInteger($request->progress)   ){
            return redirect()->route('admin.project.index')->with('error','please try again!!');
        }

        if($request->has('service_id')){
            foreach ($request->service_id as $s){
                if( !validateInteger($s) ){
                    return redirect()->route('admin.project.index')->with('error','please try again!!');
                }
            }
        }

if (auth()->user()->role == 1){
    // admin
    // update in DB
    $project->update([
        'name' => $request->name,
        'budget' => $request->budget,
        'discription' => $request->discription,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'manger_id' => $request->manager_id ,
        'progress_id' => $request->progress
    ]);
}else{
    // manager


    // update in DB
    $project->update([
        'name' => $request->name,
        'user_id' => $request->user_id,
        'budget' => $request->budget,
        'discription' => $request->discription,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'progress_id' => $request->progress
    ]);
}



        $project->services()->sync($request->service_id);
       return redirect()->route('admin.project.index')->with('success','Successfully updated');

           }catch (\Exception $e){
            return $e;
       return redirect()->route('admin.project.index')->with('error','please try again');

   }
    }

    public function create(){

        $this->authorize('create', "App\Project");


        $services = Service::where('is_deleted','0')->get();
         $progresses = Progress::where('is_deleted','0')->get();
         $clients = User::select('id','fname','lname')->where('role','3')->get();
         return view('project.create')->with(['clients'=> $clients , 'services' => $services,'progresses'=> $progresses]);
    }

    public function store(projectRequest $request){

        $this->authorize('store', "App\Project");
        // validate
       if( !validateInteger($request->user_id) || !validateInteger($request->progress) ){
           return redirect()->route('admin.project.index')->with('error','please try again!!');
       }

       foreach ($request->service_id as $s){
           if( !validateInteger($s) ){
               return redirect()->route('admin.project.index')->with('error','please try again!!');
           }
       }

        // validate
        try {
           // counter
             if(!Project::first()){
                 $c = 111111;
             }else{
                 $c =code_number() + 1;
             }

          DB::beginTransaction();
            // store in DB
            $project =    Project::create([
                'name' => $request->name,
                'user_id' => $request->user_id,
                'progress_id' => $request->progress,
                'budget' => $request->budget,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'discription' => $request->discription,
                'manger_id' =>  auth()->id(),
                'code_number' => $c,
            ]);

            $project->services()->attach($request->service_id);


          DB::commit();
            return redirect()->route('admin.project.index')->with('success','Successfully added');


        }catch (\Exception $e){
           DB::rollBack();
            return redirect()->route('admin.project.index')->with('error','please try again');
        }

    }

    public function details($id)
    {

        $this->authorize('details', "App\Project");

        $project = Project::with(['client' => function ($q) {
            $q->with('clientinfo')->get();
        }, 'transactions'])->find($id);
        if (!$project)
            return redirect()->route('admin.project.index')->with('error', 'please try again!!');
        $total = 0 ;
        foreach ($project->transactions as $p)
           {
                $total += (float)$p->amount;
           }

        $remain = (double)$project->budget - $total ;

        return view('project.details')->with(['project'=> $project , 'total' =>$total , 'remain' =>$remain ]);
    }

    public function transaction($id){
        $this->authorize('transaction', "App\Project");

        $project =  Project::with(['transactions'])->find($id);
        if (!$project)
            return redirect()->route('admin.project.index')->with('error','please try again!!');

        return view('project.transaction')->with(['project'=> $project ]);
    }

    public function addTransaction(transactionRequest $request , $id){
        $this->authorize('addTransaction', "App\Project");

        // validate
        if( !validateInteger($id) ){
            return response()->json([
                'error' => 'Error pleade try again !!'
            ]);
        }
        if($request->ajax()){
          if($id == $request->id) {
            $project = Project::find($id);
            if ($project) {

                Transaction::create([
                    'amount' => $request->amount,
                    'pay_date' => $request->date,
                    'project_id' => $id,
                ]);

                return response()->json([
                    'success' => 'Record has been added successfully!',
                    'id' => $id,
                    'amount' => $request->amount,
                    'pay_date' => $request->date,
                ]);


            } else {
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

    public function message($id){
        $this->authorize('message', "App\Project");

         $project =  Project::with(['notes'])->find($id);
        if (!$project)
            return redirect()->route('admin.project.index')->with('error','please try again!!');

        return view('project.notes')->with(['project'=> $project ]);
    }

    public function add_msg(noteRequest $request,$id){


       $this->authorize('message', "App\Project");
        try{
            if ($request->ajax()){
                $project =  Project::find($id);

                if (!$project)
                    return redirect()->route('admin.project.index')->with('error','please try again!!');

                $sender = auth()->id();
                $date = Carbon::parse(now())->format('Y/m/d');
            $note =     Notes::create([
                    'sender_id' => $sender,
                    'project_id' => $id,
                    'message' => $request->msg,
                    'date' => $date,
                ]);

                return response()->json([
                    'success' => 'Record has been added successfully!',
                    'id' => $id,
                    'msg' => $request->msg,
                    'date' => $note->date

                ]);


            }
        }catch (\Exception $e){
            return response()->json([
                'error' => 'Error pleade try again !!'
            ]);
        }

    }




}
