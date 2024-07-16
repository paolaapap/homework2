<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\Image;
use App\Models\Collection;
use App\Models\Utenti;
use App\Models\Notification;
use App\Models\Auction;
use App\Models\Tour;
use App\Models\Offer;
use DateTime;
use DateTimeZone;

class FetchController extends BaseController{

    public function fetch_api_tour()
    {
        $apiKey = env('API_KEY_JOJ');
        $url = "https://joj-image-search.p.rapidapi.com/v2/?q=moma%20tour&hl=en";
        $headers = array(
            "x-rapidapi-key: $apiKey",
            "X-RapidAPI-Host: joj-image-search.p.rapidapi.com"
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function fetch_api_hotel($check_in_value, $check_out_value, $adults_value, $rooms_value){
        $latitude = "40.730610";
        $longitude = "-73.935242";

        $url = "https://tripadvisor16.p.rapidapi.com/api/v1/hotels/searchHotelsByLocation?latitude=$latitude&longitude=$longitude&checkIn=$check_in_value&checkOut=$check_out_value&pageNumber=1&adults=$adults_value&rooms=$rooms_value&currencyCode=USD";
        $apiKey = env('API_KEY_HOTEL');

        $headers = [
            "x-rapidapi-key: $apiKey",
            "X-RapidAPI-Host: tripadvisor16.p.rapidapi.com"
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    public function fetch_api_artsy($name = '', $id = ''){
        $clientId = env('CLIENT_ID_ARTSY');
        $clientSecret = env('CLIENT_SECRET_ARTSY');

        $url_token = "https://api.artsy.net/api/tokens/xapp_token?client_id=$clientId&client_secret=$clientSecret";

        $curl = curl_init($url_token);
        curl_setopt($curl, CURLOPT_URL, $url_token);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $token = json_decode(curl_exec($curl), true);
        curl_close($curl);

        $accessToken = $token['token'];

    
        if ($name && (strcmp($name, "null")!=0)) {
            $name = str_replace(' ', '-', $name);

            $url = "https://api.artsy.net/api/artists/$name";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Xapp-Token:'. $accessToken)
            );

            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        }

        if ($id) {
            $url = "https://api.artsy.net/api/artworks?artist_id=$id";

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Xapp-Token:'. $accessToken)
            );

            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        }

    }

    public function fetch_images($section){
            $results = Image::where('section', $section)->get();
            $resultsArray = $results->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'content' => json_decode($entry->content)
                ];
            });

            return response()->json($resultsArray);
    }

    public function fetch_collection($category = ''){

        if ($category) {

            $collections = Collection::where('category', $category)->get();
            $resultArray = $collections->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'category' => $entry->category,
                    'content' => json_decode($entry->content)
                ];
            });

        } else {
            $collections = Collection::all();
            $resultArray = $collections->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'category' => $entry->category,
                    'content' => json_decode($entry->content)
                ];
            });
        }

        return response()->json($resultArray);
    }
    

    public function check_email($q){

        $email = strtolower(urldecode($q));
        $exists = Utenti::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function fetch_favourites() {

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if(!$userId){
            return response()->json([['res' => false]]);
        } else {
        
            $collections = Utenti::where('id', $userId)->with('collections')->first()->collections;
            $result = $collections->map(function ($collection) {
                return [
                    'res' => true,
                    'id' => $collection->id,
                    'content' => json_decode($collection->content),
                ];
            });

            return response()->json($result);
        }
    }

    public function fetch_notifications($hide = ''){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if (!$userId) {
            return redirect('login');
        } else{
            if ($hide) {
                Notification::where('user_id', $userId)->delete();
            }
            $notifications = Notification::where('user_id', $userId)->get();
            $result = $notifications->map(function ($notifications) {
                return [
                    'id' => $notifications->id,
                    'content' => $notifications->content
                ];
            });
    
            return response()->json($result);
        }
    }
 
    public function fetch_myoffers(){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if (!$userId) {
            return redirect('login');
        } else{  
            $auctions = Auction::whereHas('offers', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get(); 
            
            $resultArray = $auctions->map(function ($auction) {
                return [
                    'asta_id' => $auction->id,
                    'user_id' => $auction->user_id,
                    'foto' => $auction->foto,
                    'titolo' => $auction->titolo,
                    'durata' => $auction->durata,
                    'prezzo_iniziale' => $auction->prezzo_iniziale,
                    'num_offerte' => $auction->num_offerte,
                    'ultimo_prezzo' => $auction->ultimo_prezzo
                ];
            });
    
            return response()->json($resultArray);

        }
    }

    public function fetch_auction($id = '', $user_id= ''){

        if ($id && (strcmp($id, "null")!=0)) {
            $auction = Auction::find($id);
            if (!$auction) {
                return response()->json(['res' => false]);
            } else {
                return response()->json([
                    'res' => true,
                    'asta_id' => $auction->id,
                    'user_id' => $auction->user_id,
                    'foto' => $auction->foto,
                    'titolo' => $auction->titolo,
                    'durata' => $auction->durata,
                    'prezzo_iniziale' => $auction->prezzo_iniziale,
                    'num_offerte' => $auction->num_offerte,
                    'ultimo_prezzo' => $auction->ultimo_prezzo
                ]);
            }
        } 
        else if($user_id) {  

            $authController = new AuthController();
            $userId = $authController->check_auth();

            if (!$userId) {
                return redirect('login');
            } else{  
                $auctions = Auction::where('user_id', $userId)->get();
            }

        } else {  
            $auctions = Auction::all();
        }

        $resultArray = $auctions->map(function ($auction) {
            return [
                'asta_id' => $auction->id,
                'user_id' => $auction->user_id,
                'foto' => $auction->foto,
                'titolo' => $auction->titolo,
                'durata' => $auction->durata,
                'prezzo_iniziale' => $auction->prezzo_iniziale,
                'num_offerte' => $auction->num_offerte,
                'ultimo_prezzo' => $auction->ultimo_prezzo
            ];
        });

        return response()->json($resultArray);
    }

    public function fetch_saved_unsaved_tour($tourId = ''){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if (!$userId) {
            return response()->json(['ok' => false, 'error' => 'Utente non autenticato']);
        } 

        if ($tourId) {
            $tour = Tour::where('tour_id', $tourId)->where('user_id', $userId)->first();

            if ($tour) {
                $tour->delete();
                return response()->json(['ok' => true, 'error' => 'Il tour è stato rimosso dai preferiti']);
            } 
        } else {

            $tours = Tour::where('user_id', $userId)->get();
            $result = $tours->map(function ($tour) {
                return [
                    'tour_id' => $tour->tour_id,
                    'content' => json_decode($tour->content),
                ];
            });
    
            return response()->json($result);;  

        }
  
    }

    public function fetch_check_expires(){

        $timezone = new DateTimeZone('Europe/Rome');
        $currentDatetime = new DateTime('now', $timezone);
        $auctions = Auction::where('durata', '<', $currentDatetime)->get();
        $result = false;
    
        foreach ($auctions as $auction) {
        
            $highestOffer = Offer::where('auction_id', $auction->id)->orderByDesc('prezzo')->first();
            
            if ($highestOffer) {
                $content = "You have won the auction of {$auction->titolo}";
                $notification = new Notification();
                $notification->user_id = $highestOffer->user_id;
                $notification->content = $content;
                $notification->save();
            } 

            $auction->delete();

            if (file_exists($auction->foto)) {
                unlink($auction->foto);
            }
            $result = true;
        }
    
        return response()->json(['ok' => $result]);
    }

    public function fetch_save_tour(Request $request){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if (!$userId) {
            return response()->json(['ok' => false, 'error' => 'Utente non autenticato']);
        } 

        if($request->filled(['id', 'title', 'img', 'link'])){

            $id = $request->post('id');
            $title = $request->post('title');
            $image = $request->post('img');
            $link = $request->post('link');

            $existingTour = Tour::where('user_id', $userId)->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(content, '$.image')) = ?", [$image])->first();
            if ($existingTour) {
                return response()->json(['ok' => true, 'message' => 'Il tour è già nei preferiti']);
            }

            $tour = new Tour();
            $tour->user_id = $userId;
            $tour->tour_id = $id;
            $tour->content = json_encode(['title' => $title, 'image' => $image, 'link' => $link]);

            if ($tour->save()) {
                return response()->json(['ok' => true]);
            } else {
                return response()->json(['ok' => false, 'error' => 'Errore durante il salvataggio']);
            }
    
        }
        return response()->json(['ok' => false, 'error' => 'Dati mancanti']);
    }

    public function fetch_show_like($id_collection){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        $num_likes = Collection::find($id_collection)->users()->count();
        
        if (!$userId) {
            $img = "images/like.png";
        } else {
            $hasLiked = Collection::find($id_collection)->users()->wherePivot('user_id', $userId)->exists();

            if ($hasLiked) {
                $img = "images/unlike.png";
            } else {
                $img = "images/like.png";
            }
        }

        $response = [
            'id' => $id_collection,
            'img' => $img,
            'num_like' => $num_likes
        ];

        return response()->json([$response]);
    }

    public function fetch_category_collection(){

        $categories = Collection::select('category')->distinct()->get()->toArray();
        $categoryArray = [];
        foreach ($categories as $category) {
            $categoryArray[] = ['category' => $category['category']];
        }

        return response()->json($categoryArray);
    }


    public function fetch_add_remove_like($id_collection){

        $authController = new AuthController();
        $userId = $authController->check_auth();

        if (!$userId) {
            return response()->json(['res' => false]);
        }

        $user = Utenti::find($userId);
        $isLiked = $user->collections()->where('collection_id', $id_collection)->exists();

        if ($isLiked) {
            $user->collections()->detach($id_collection);
            $img = "images/like.png"; 
        } else {
            $user->collections()->attach($id_collection);
            $img = "images/unlike.png"; 
        }
        return response()->json(['res' => true, 'id' => $id_collection, 'img' => $img]);
    }
   
}