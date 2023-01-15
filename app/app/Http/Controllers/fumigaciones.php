<?php

namespace App\Http\Controllers;



class fumigaciones extends Controller
{
   public function selectfumigacion(){

    return view('selectfumigacion');
   }
   public function selectfumigacionactual(){

    return view('selectfumigacionactual');
   }
   public function selectfumigacioneditar($id){

    return $id;
    //view('selectfumigacioneditar');
   }
}
