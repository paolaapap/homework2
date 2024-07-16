<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use App\Models\Collection;

class MainController extends BaseController{

    public function failed_mail(){
        return view("failed_mail");
    }

    public function success_mail(){
        return view("success_mail");
    }

    public function collection (){
        return view("collection");
    }

    public function running_auction (){
        return view("running_auction");
    }

    public function info_collection($id){

        $collection = Collection::find($id);
          
        return view("info_collection")->with([
            'id' => $collection->id,
            'num_like' => $collection->num_like, 
            'category' => $collection->category,
            'content' => json_decode($collection->content)
        ]);

    }

    public function info_auction($id){

        return view("info_auction")->with([
            'id' => $id
        ]);   
    }

    public function forgot_password (){
        return view("forgot_password");
    }

    public function reset_password (){
        if (Session::has('token')) {
            return view("reset_password");
        } else {
            return redirect("forgot_password");
        }
    }
}