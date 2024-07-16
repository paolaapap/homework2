<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Request;
use App\Models\Auction;
use App\Models\Offer;
use App\Models\Notification;

class AuctionController extends BaseController{

    public function check(){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if (!$userId) {
            return redirect('login');
        }
        else return view('new_auction');
    }

    public function new_auction(){

        if(!empty(Request::hasFile('uploaded_image')) && !empty(Request::post('title')) && !empty(Request::post('deadline')) && !empty(Request::post('starting_price'))){
            $error = array();

            if(!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', Request::post('deadline'))){
                $error[] = "Invalid deadline format.";
            }
        
            if(!preg_match('/^(?!0\d)\d*(\.\d{1,2})?$/', Request::post('starting_price')) || floatval(Request::post('starting_price')) <= 0){
                $error[] = "Invalid price format.";
            }
        
            $deadline = Request::post('deadline');
            $current_time = date('Y-m-d H:i:s'); 
            if (strtotime($current_time) > strtotime($deadline)) { 
                    $error[] = "The deadline must be a future date.";
            }
        
            $target_dir = "C:/Users/paola/Desktop/hw2/hw2/public/uploads/";
            $fileName = Request::file('uploaded_image')->getClientOriginalName();
            $target_file = $target_dir . $fileName;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 

            $check = getimagesize(Request::file('uploaded_image')->getRealPath()); 
            if($check == false) {
                $error[] = "Uploaded file is not an image.";
            }

            if (Request::file('uploaded_image')->getSize() > 500000) {
                $error[] = "Uploaded image is too large.";
            }

            
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $error[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        
            }

            if (count($error) == 0) {

                $uploadedImage = Request::file('uploaded_image');
                $uploadedImage->move($target_dir, $fileName);

                $title = Request::post('title');
                $authController = new AuthController();
                $userId = $authController->check_auth();
                $starting_price = Request::post('starting_price');
        
                $auction = new Auction();
                $auction->user_id = $userId;
                $auction->foto = $target_file;
                $auction->titolo = $title;
                $auction->durata = $deadline;
                $auction->prezzo_iniziale = $starting_price;

                if ($auction->save()) {
                    return redirect('running_auction');
                } else {
                    $error[] = "Something went wrong.";
                }
            }
        }

        return redirect('new_auction')->withInput()->withErrors($error);
    }

    public function new_offer($id){

        if(!empty(Request::post('offers'))){

            $authController = new AuthController();
            $userId = $authController->check_auth();

            if (!$userId) {
                return redirect('login');
            }

            $errors = array();
        
            $auction = Auction::find($id);
            $offer = Request::post('offers');

            if ($offer < $auction->ultimo_prezzo) {
                $errors[] = "Your offer must be greater than the latest price.";
            } else if ($offer < $auction->prezzo_iniziale) {
                $errors[] = "Your offer must be greater than the starting price.";
            }

            if(!preg_match('/^(?!0\d)\d*(\.\d{1,2})?$/', Request::post('offers')) || floatval(Request::post('offers')) <= 0){
                $errors[] = "Invalid price format.";
            }

            if ($auction->user_id == $userId) {
                $errors[] = "You cannot bid on an auction you own.";
            }

            if (count($errors) == 0) {

                $new_offer = new Offer();
                $new_offer->user_id = $userId;
                $new_offer->auction_id = $auction->id;
                $new_offer->prezzo = $offer;
                $new_offer->save();

                $content = "You have a new offer for your auction: " . $auction->titolo . ". Amount: " . $offer . "$";
                $notification = new Notification();
                $notification->content = $content;
                $notification->user_id = $auction->user_id;
                $notification->save();
            }

            return redirect()->route('info_auction', ['id' => $id])->withInput()->withErrors($errors);
        }

    }
}