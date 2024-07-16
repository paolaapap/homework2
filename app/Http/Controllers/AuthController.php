<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie as FacadeCookie; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Cookie;
use App\Models\Utenti;
use App\Models\Token;

class AuthController extends BaseController{

    public function check_auth(){

        if (!Session::has('user_id')) {
            if (FacadeCookie::has('user_id') && FacadeCookie::has('token') && FacadeCookie::has('cookie_id')) {
                $cookieId = FacadeCookie::get('cookie_id');
                $userId = FacadeCookie::get('user_id');
                $token = FacadeCookie::get('token');

                $cookieRecord = Cookie::where('id', $cookieId)->where('user_id', $userId)->first();
          
                if ($cookieRecord) {
                    if (time() > $cookieRecord->expires) {
                        Cookie::where('id', $cookieRecord->id)->delete();
                        return redirect('logout');
                    } else if (password_verify($token, $cookieRecord->hash)) {
                        Session::put('user_id', $userId);
                        return $userId;
                    }
                }
            }
        } else {
            return Session::get('user_id');
        }
        return null; 
    }


    public function logout(){

        if (FacadeCookie::has('user_id') && FacadeCookie::has('token') && FacadeCookie::has('cookie_id')) {

            $cookieId = FacadeCookie::get('cookie_id');
            $userId = FacadeCookie::get('user_id');
            $token = FacadeCookie::get('token');

            $cookieRecord = Cookie::where('id', $cookieId)->where('user_id', $userId)->first();
            
            if ($cookieRecord && (strcmp($token, $cookieRecord->hash) == 0)) {
                Cookie::where('id', $cookieId)->delete();
                FacadeCookie::forget('user_id');
                FacadeCookie::forget('cookie_id');
                FacadeCookie::forget('token');
            }

        }
        Session::flush();   
        return redirect('index');
    }

    public function check_login(){ 
        
        $userId = $this->check_auth();

        if ($userId) {
            return redirect('index');
        }
        else return view('login');
    }

    public function login(){ 

        if(!empty(Request::post('email')) && !empty(Request::post('password'))){
            $errors = array();
            $email = strtolower(Request::post('email'));
            $password = Request::post('password');

            $user = Utenti::where('email', $email)->first();

            if ($user) {

                if (password_verify($password, $user->password)) {
    
                    if (!empty(Request::post('remember'))) {
                        $token = bin2hex(random_bytes(12));
                        $hash = bcrypt($token);
                        $expires = now()->addDays(7);
    
                        $cookie = new Cookie();
                        $cookie->user_id = $user->id;
                        $cookie->hash = $hash;
                        $cookie->expires = $expires;
                        $cookie->save();

                        $expires = strtotime($expires);
                        FacadeCookie::queue('user_id', $user->id, $expires);
                        FacadeCookie::queue('cookie_id', $user->cookies->last()->id, $expires);
                        FacadeCookie::queue('token', $hash, $expires);
                        Session::put('user_id', $user->id);
                        
                    } else {

                        Session::put('user_id', $user->id);
                    }
    
                    return redirect('index');

                } else {

                    $errors[] = "Wrong password. Try again or go to forgot password section.";
                }
            } else {

                $errors[] = "You aren't registered with the email address you provided. Change email address or create a new account.";
            }
    
            return redirect('login')->withInput()->withErrors($errors);
        }
    
    }

    public function check_new_account(){ 
        
        $userId = $this->check_auth();

        if ($userId) {
            return redirect('index');
        }
        else return view('new_account');
    }

    public function new_account(){

        
        if(!empty(Request::post('last_name')) && !empty(Request::post('first_name')) && !empty(Request::post('email')) && 
        !empty(Request::post('password')) && !empty(Request::post('password_confirm')) && !empty(Request::post('gender'))){

        $errors = array();
        
        
        if(!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙçÇ ]+$/', Request::post('last_name'))){
            $errors[] = "Last name not valid.";
        }

        
        if(!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙçÇ ]+$/', Request::post('first_name'))){
            $errors[] = "First name not valid.";
        }

        
        if(!filter_var(Request::post('email'), FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email not valid.";
        } else {
            $email = strtolower(Request::post('email')); 
            if(Utenti::where('email', $email)->exists()){
                $errors[] = "Email already used.";
            }
        }

        
        if(!(preg_match('/.{8,}/', Request::post('password')) && preg_match('/[A-Z]/', Request::post('password')) && preg_match('/[a-z]/', Request::post('password')) &&
            preg_match('/[0-9]/', Request::post('password')) && preg_match('/[!@#$%^&*(),.?]/', Request::post('password')))){
            $errors[] = "Password not valid.";
        }

        
        if (strcmp(Request::post('password'), Request::post('password_confirm')) != 0) {
            $errors[] = "Passwords don't match";
        }

        
        if (count($errors) == 0) {
            $password = Request::post('password');
            $password = bcrypt($password);

            $user = new Utenti;
            $user->email = Request::post('email');
            $user->password = $password;
            $user->nome = Request::post('first_name');
            $user->cognome = Request::post('last_name');
            $user->genere = Request::post('gender');
            $user->save();

            Session::put('user_id', $user->id);
            return redirect('index');
        } 

        return redirect('new_account')->withInput()->withErrors($errors);
        }
    }

    public function change_pss(){
        return view('change_password');    
    }

    public function change_password(){
        if(!empty(Request::post('email')) && !empty(Request::post('old_password')) && !empty(Request::post('new_password')) && !empty(Request::post('new_password_confirm'))){

            $errors = array();
            
            
            if(!(preg_match('/.{8,}/', Request::post('new_password')) && preg_match('/[A-Z]/', Request::post('new_password')) && preg_match('/[a-z]/', Request::post('new_password')) &&
                preg_match('/[0-9]/', Request::post('new_password')) && preg_match('/[!@#$%^&*(),.?]/', Request::post('new_password')))){
                $errors[] = "Password not valid.";
            }
    
            
            if (strcmp(Request::post('new_password'), Request::post('new_password_confirm')) != 0) {
                $errors[] = "Passowrds don't match.";
            }
    
            
            if (strcmp(Request::post('new_password'), Request::post('old_password')) == 0) {
              $errors[] = "Your new password must be different from your old.";
            }
    
            
            $email = strtolower(Request::post('email')); 
            $user = Utenti::where('email', $email)->first();
            if(!$user){
                $errors[] = "There is no account associated with this email.";
            } else {
                if (!password_verify(Request::post('old_password'), $user->password)) {
                    $errors[] = "The password is wrong. Try again.";    
                }
            }
    
    
            
            if(count($errors) == 0){
                $new_password = Request::post('new_password');
                $new_password = bcrypt($new_password);

                if ($user) {
                    $user->password = $new_password;
                    $user->save();
                    Session::put('user_id', $user->id);
                    return redirect('index');
                }
            }
            return redirect('change_password')->withInput()->withErrors($errors);  
        }
    }

    public function user_data($viewName){

        $userId = $this->check_auth();
    
        if ($userId) {
            $user = Utenti::where('id', $userId)->first();
            if ($user) {
                $nome = $user->nome;
                $genere = $user->genere;
                $data = compact('nome', 'genere');
    
                if ($viewName == 'personal_area') {
                    $cognome = $user->cognome;
                    $data['cognome'] = $cognome;
                }
    
                return view($viewName, $data);

            } else {
                return view($viewName, ['error' => 'true']);
            }
        } else {
            return view($viewName, ['error' => 'true']);
        }
    }

    public function user_data_index(){
        return $this->user_data('index');
    }
    
    public function user_data_personal(){

        $userId = $this->check_auth();
        if ($userId) {
            return $this->user_data('personal_area');
        }
        else return redirect('index');
    }
  

    public function forgot_password(){

        $error = [];

        if(!empty(Request::post('email'))){

            $email = strtolower(Request::post('email'));

           
            $user = Utenti::where('email', $email)->first();
            if (!$user) {
                $error[] = "There is no account associated with this email. Go to the new account section.";
            }

           
            if (count($error) == 0) {

                $token = rand(10000, 99999); 
                $token_str = (string) $token; 
                $token_hash = password_hash($token_str, PASSWORD_DEFAULT); 


                $tokenRecord = new Token();
                $tokenRecord->email = $email;
                $tokenRecord->token = $token_hash;

                if (!$tokenRecord->save()) {
                    $error[] = "Something went wrong.";
                }
            }

            
            if (count($error) == 0) {
                $subject = "Reset password MoMA account";
                $from = "momanewyork00@gmail.com";
                $message = "This is your token to reset your password \n $token \n To reset your password click this link \n " . url('/reset_password');
    
                $res_mail = Mail::raw($message, function ($mail) use ($email, $subject, $from) {
                    $mail->from($from)
                         ->to($email)
                         ->subject($subject);
                });
    
                if ($res_mail) {
                    Session::put('token', $token);
                    return redirect('success_email');
                } else {
                    return redirect('failed_email');
                }
            }
    
        }

        return redirect('forgot_password')->withInput()->withErrors($error);
    }    

     
    public function reset_password(){

        if(!empty(Request::post('token')) && !empty(Request::post('email')) && !empty(Request::post('password')) && !empty(Request::post('password_confirm'))){

            $errors = array();
            
           
            if(!(preg_match('/.{8,}/', Request::post('password')) && preg_match('/[A-Z]/', Request::post('password')) && preg_match('/[a-z]/', Request::post('password')) &&
                preg_match('/[0-9]/', Request::post('password')) && preg_match('/[!@#$%^&*(),.?]/', Request::post('password')))){
                $errors[] = "Password not valid.";
            }
    
            
            if (strcmp(Request::post('password'), Request::post('password_confirm')) != 0) {
                $errors[] = "Passwords don't match.";
            }
    
            
            if (Request::post('token') != Session::get('token')) {
                $errors[] = "Tokens don't match.";
            }
    
            
            $tokenEntry = Token::where('email', strtolower(Request::post('email')))->first();

            if (!$tokenEntry || !password_verify(Request::post('token'), $tokenEntry->token)) {
                $errors[] = "Wrong token or wrong email.";
            }

            
            if(count($errors) == 0){
                $user = Utenti::where('email', strtolower(Request::post('email')))->first();
                $user->password = bcrypt(Request::post('password'));
                if($user->save()){
                    Token::where('email', strtolower(Request::post('email')))->delete();
                    Session::forget('token'); 
                    Session::put('user_id', $user->id);
                    return redirect("index");
                } else {
                    $errors[]= "Problem during update.";
                }
            }
            
            return redirect('reset_password')->withInput()->withErrors($errors);    
        }     
    }
}