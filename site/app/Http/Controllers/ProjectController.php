<?php

namespace App\Http\Controllers;
use App\Models\projects_model;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function Project(){
        $ProjectData = json_decode(projects_model::orderBy('id','desc')->get());
        return view('Project',['ProjectData'=>$ProjectData]);
    }
}
