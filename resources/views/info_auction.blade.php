<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL:: to("images/logo_mini.png") }}'>
      <title>Auction details | MoMA</title>
      <link rel="stylesheet" href='{{ URL:: to("info_auction.css") }}'/>
      <script src='{{ URL:: to("info_auction.js") }}' defer></script>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="preconnect" href='{{ URL:: to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL:: to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL:: to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL:: to("https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap") }}' rel="stylesheet">
      <link href='{{ URL:: to("https://fonts.googleapis.com/css2?family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <link href='{{ URL:: to("https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <header id="fix_header">
        <div id="header_nav_upper">
            <img class="logo" src='{{ URL:: to("images\logo.png") }}'/>
                <a class="a1" href='{{ URL:: to("personal_area") }}'>Personal area</a>
        </div>
        <div id="header_nav_lower">
            <span>Visit</span> 
            <span class="current_page">Auctions</span>  
            <span>Art and artist</span>  
            <span>Store</span>   
            <a href='{{ URL:: to("running_auction") }}'>Running auctions</a>
            <div class="header_nav_lower_right"></div>
        </div>
    </header>
    <section id="dinamic_header" class='hidden'>
            <div class="left">
                <span>Visit</span> 
                <span class="current_page">Auctions</span>  
                <span>Art and artist</span>  
                <span>Store</span>    
                <a href='{{ URL:: to("running_auction") }}'>Running auctions</a> 
            </div>
            <div class="right">
                <a class="a1" href='{{ URL:: to("personal_area") }}'>Personal area</a>
            </div>
    </section>
    <section id="show_auction" data-index="{{ $id }}">
        <div id="image"></div>
        <div id="details_section">
            <div id="error-messages">
            @foreach($errors->all() as $err)
                <h1 style='color:red'>{{ $err }}</h1>
            @endforeach
            </div>
            <div id="details"></div>
        </div>
    </section>
  </body>