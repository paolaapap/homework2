<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL::to("images/logo_mini.png") }}'>
      <title>Reset password | MoMA</title>
      <link rel="stylesheet" href='{{ URL::to("reset_password.css") }}'/>
      <script src='{{ URL::to("reset_password.js") }}' defer></script>
      <link rel="preconnect" href='{{ URL::to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL::to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="reset_password">
            <img id="logo" src='{{ URL::to("images\logo.png") }}'/>
            <h1>Reset your password.</h1>
            @foreach($errors->all() as $err)
              <div class='error_php'>{{ $err }}</div>
              @endforeach
            <form name="form_reset_password" method="post">
               @csrf
              <input type="email" name="email" placeholder="Email address" class="input" value='{{ old("email") }}'>
              <input type="input" name="token" placeholder="Token" class="input" value='{{ old("token") }}'>
              <input type="password" name="password" placeholder="Create a new password" class="input" value='{{ old("password") }}'>
              <input type="password" name="password_confirm" placeholder="Confirm password" class="input" value='{{ old("password_confirm") }}'>
              <img id="show_pss" src='{{ URL::to("images\show_pss.jpg") }}' /> 
              <input type="submit" value="Reset password" class="button">
            </form>
            <a href='{{ URL::to("index") }}'>&#8592; Return to home page</a>
            <a href='{{ URL::to("login") }}'>&#8592; Return to log in</a>
            <a href='{{ URL::to("forgot_password") }}'>&#8592; Return to forgot password</a>
          </div>
      </section>
    </section>
  </body>