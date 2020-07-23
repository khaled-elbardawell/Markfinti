<?php



function get_default_lang(){
    return Config::get('app.locale');
}

function save_img($img,$path){
    $file_exe = $img->getClientOriginalExtension();
    $file_name = time().'.'.$file_exe;
    $img->move($path,$file_name);
    return $file_name;
}

function default_img_profile(){
      $name = auth()->user()->fname;
      return   strtoupper($name[0]);
}

function default_img_sender($name){
    return   strtoupper($name[0]);
}


function validateInteger($value)
{
    return filter_var($value, FILTER_VALIDATE_INT) !== false;
}

function code_number()
{
    $p =  \App\Project::latest()->first();
    if($p){
      return (int)  $p->code_number;
    }

}


function save_file($file,$path){
    $file_exe = $file->getClientOriginalExtension();
    $file_name = time().'.'.$file_exe;
    $file->move($path,$file_name);
    return $file_name;
}


