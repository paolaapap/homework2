<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL::to("images/logo_mini.png") }}'>
      <title>Change password | MoMA</title>
      <link rel="stylesheet" href='{{ URL::to("change_password.css") }}'/>
      <script src='{{ URL::to("change_password.js") }}' defer></script>
      <link rel="preconnect" href='{{ URL::to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL::to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="change_password">
            <img id="logo" src='{{ URL::to("images\logo.png") }}'/>
            <h1>Change your password.</h1>
            @foreach($errors->all() as $err)
              <div class='error_php'>{{ $err }}</div>
            @endforeach
            <form name="form_change_password" method="post">
                @csrf
              <input type="email" name="email" placeholder="Email address" class="input" value='{{ old("email") }}' >
              <input type="password" name="old_password" placeholder="Old password" class="input" value='{{ old("old_password") }}'>
              <input type="password" name="new_password" placeholder="New password" class="input" value='{{ old("new_password") }}'>
              <input type="password" name="new_password_confirm" placeholder="Repeat new password" class="input" value='{{ old("new_password_confirm") }}'>
              <img id="show_pss" src='{{ URL::to("images\show_pss.jpg") }}' /> 
              <input type="submit" value="Change password" class="button">
            </form>
            <a href='{{ URL::to("personal_area") }}'>&#8592; Return to your personal area</a>
            <a href='{{ URL::to("index") }}'>&#8592; Return to home page</a>
          </div>
      </section>
    </section>
  </body>