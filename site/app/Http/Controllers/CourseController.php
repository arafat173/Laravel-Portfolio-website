<?php

namespace App\Http\Controllers;
use App\Models\CourseModel;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    function Course(){
        $CoursesData =  json_decode(CourseModel::orderBy('id','desc')->get());

        return view('Course',['CoursesData'=>$CoursesData]);
    }
}
