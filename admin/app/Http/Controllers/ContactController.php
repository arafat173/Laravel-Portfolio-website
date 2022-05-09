<?php

namespace App\Http\Controllers;
use App\Models\ContactModel;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    function ContactIndex(){

        return view('Contact');
    }

    function getContactData(){
       $result = json_encode(ContactModel::orderBy('id','desc')->get()) ;

       return $result;
    }

     function getContactDetails(Request $req){
      $id = $req->input('id');
      $result = json_encode(ContactModel::where('id','=',$id)->get());
       return $result;
    }

    function ContactDelete(Request $req){
    $id = $req->input('id');
    $result =  ContactModel::where('id','=',$id)->delete();

    if($result == true){
      return 1;
    }
    else{
      return 0;
    }

    }


     function ContactUpdate(Request $req){
    $id = $req->input('id');
    $course_name = $req->input('course_name');
    $course_des = $req->input('course_des');
    $course_fee = $req->input('course_fee');
    $course_totalenroll  = $req->input('course_totalenroll');
    $course_totalclass = $req->input('course_totalclass');
    $course_link = $req->input('course_link');
    $course_img = $req->input('course_img');


    $result =  ContactModel::where('id','=',$id)->update(
        [ 'course_name'=>$course_name, 
        'course_des'=>$course_des, 
        'course_fee'=>$course_fee, 
        'course_totalenroll'=>$course_totalenroll, 
        'course_totalclass'=>$course_totalclass, 
        'course_link'=>$course_link, 
        'course_img'=>$course_img ]);

    if($result == true){
      return 1;
    }
    else{
      return 0;
    }
        
    }




    function ContactAdd(Request $req){
    $course_name = $req->input('course_name');
    $course_des = $req->input('course_des');
    $course_fee = $req->input('course_fee');
    $course_totalenroll  = $req->input('course_totalenroll');
    $course_totalclass = $req->input('course_totalclass');
    $course_link = $req->input('course_link');
    $course_img = $req->input('course_img');

    $result =  ContactModel::insert([
        'course_name'=>$course_name, 
        'course_des'=>$course_des, 
        'course_fee'=>$course_fee, 
        'course_totalenroll'=>$course_totalenroll, 
        'course_totalclass'=>$course_totalclass, 
        'course_link'=>$course_link, 
        'course_img'=>$course_img]);

    if($result == true){
      return 1;
    }
    else{
      return 0;
    }
        
    }
}
