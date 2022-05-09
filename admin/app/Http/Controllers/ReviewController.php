<?php

namespace App\Http\Controllers;
use App\Models\ReviewModel;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
     function ReviewIndex(){

        return view('Review');
    }

    function getReviewData(){
       $result = json_encode(ReviewModel::orderBy('id','desc')->get()) ;

       return $result;
    }

     function getReviewDetails(Request $req){
      $id = $req->input('id');
      $result = json_encode(ReviewModel::where('id','=',$id)->get());
       return $result;
    }

    function ReviewDelete(Request $req){
    $id = $req->input('id');
    $result =  ReviewModel::where('id','=',$id)->delete();

    if($result == true){
      return 1;
    }
    else{
      return 0;
    }

    }


     function ReviewUpdate(Request $req){
    $id = $req->input('id');
    $course_name = $req->input('name');
    $course_des = $req->input('des');
    


    $result =  ReviewModel::where('id','=',$id)->update(
        [ 'name'=>$course_name, 
        'des'=>$course_des, 
        ]);

    if($result == true){
      return 1;
    }
    else{
      return 0;
    }
        
    }




    function ReviewAdd(Request $req){
    $course_name = $req->input('name');
    $course_des = $req->input('des');
   

    $result =  ReviewModel::insert([
        'name'=>$course_name, 
        'des'=>$course_des, 
       ]);

    if($result == true){
      return 1;
    }
    else{
      return 0;
    }
        
    }
}
