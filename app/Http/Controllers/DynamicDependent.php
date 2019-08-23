<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DynamicDependent extends Controller
{
    function index()
    {
      $serie_list=DB::table('series')->orderBy('name')->get();
      return view('dynamic_dependent')->with('serie_list',$serie_list);
    }
    function fetch(Request $request){
      $select=$request->get('select');
      $value=$request->get('value');
      $dependent=$request->get('dependent');
      if($dependent=='question'){
      $data=DB::table('questions')->where('serie_id','=',$value)->orderBy('name','asc')->get();
    }else{
      $data=DB::table('answers')->where('question_id','=',$value)->orderBy('name','asc')->get();
    }

      $output='<option value="" >Select'.ucfirst($dependent).'</option>';
      foreach ($data as $row) {
        $output.='<option value="'.$row->id.'">'.$row->name.'</option>';
      }
      echo $output;
    }
}
