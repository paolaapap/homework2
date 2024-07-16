<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL::to("images/logo_mini.png") }}'>
      <title>Login | MoMA</title>
      <link rel="stylesheet" href='{{ URL::to("login.css") }}'/>
      <script src='{{ URL::to("login.js") }}' defer></script>
      <link rel="preconnect" href='{{ URL::to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL::to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
      <section id="background">
        <section id="main">
            <div id="login">
              <img id="logo" src='{{ URL::to("images\logo.png") }}'/>
              <h1>Log in to your account with your email and password.</h1>

              @foreach($errors->all() as $err)
              <div class='error_php'>{{ $err }}</div>
              @endforeach

              <form name="form_login" method="post">
                @csrf
                <input type="email" name="email" placeholder="Email address" class="input" value='{{ old("email") }}'>
                <input type="password" name="password" placeholder="Password" class="input" value='{{ old("password") }}'>
                <img id="show_pss" src='{{ URL::to("images\show_pss.jpg") }}' /> 
                <input type="submit" value="Log in" class="button">
                <label id="remember"><input type="checkbox" name="remember"{{ old('remember') ? 'checked' : '' }}> Remember Me</label>
              </form>
              <a href='{{ URL::to("forgot_password") }}'>Forgot your password?</a>
            </div>
            <div id="new_account">
              <div><a href='{{ URL::to("new_account") }}'>
                <h1>Create your new account login &#8594;</h1>
                <span>We recently updated our sign-in process. If you have never created an online account with MoMA, click here to create one now.</span>
              </a></div>
              <a href='{{ URL::to("index") }}' id="return">&#8592; Return to home page</a>
            </div>
        </section>
      </section>
  </body>