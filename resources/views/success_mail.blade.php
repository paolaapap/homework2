<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href='{{ URL::to("images/logo_mini.png") }}'>
      <title>Success Email | MoMA</title>
      <link rel="stylesheet" href='{{ URL::to("success_email.css") }}'/>
      <link rel="preconnect" href='{{ URL::to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL::to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="success_email">
            <img id="logo" src='{{ URL::to("images\logo.png") }}'/>
            <span>An email to the address you provided has just been sent successfully. DO NOT close your browser before resetting your password. Follow the instructions in the email.</span>
            <a href='{{ URL::to("forgot_password") }}'>&#8592; Return to forgot password</a>
            <a href='{{ URL::to("index") }}'>&#8592; Return to home page</a>
          </div>
      </section>
    </section>
  </body>