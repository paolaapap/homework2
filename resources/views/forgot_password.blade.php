<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL::to("images/logo_mini.png") }}'>
      <title>Forgot password | MoMA</title>
      <link rel="stylesheet" href='{{ URL::to("forgot_password.css") }}'/>
      <script src='{{ URL::to("forgot_password.js") }}' defer></script>
      <link rel="preconnect" href='{{ URL::to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL::to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="forgot_password">
            <img id="logo" src='{{ URL::to("images\logo.png") }}'/>
            <h1>Enter the email associated with the account whose password you forgot.</h1>
            <span>You will receive an email to the address provided below with instructions to change your password.</span>
            @foreach($errors->all() as $err)
              <div class='error_php'>{{ $err }}</div>
              @endforeach
            <form name="form_forgot_password" method="post">
              @csrf
              <input type="email" name="email" placeholder="Email address" class="input" value='{{ old("email") }}'>
              <div id="email_error" class="error hidden">Enter your email</div>
              <input type="submit" value="Send email" class="button">
            </form>
            <a href='{{ URL::to("login") }}'>&#8592; Return to login</a>
            <a href='{{ URL::to("new_account") }}'>&#8592; Go to new account section</a>
            <a href='{{ URL::to("index") }}'>&#8592; Return to home page</a>
          </div>
      </section>
    </section>
  </body>