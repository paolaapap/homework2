<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL::to("images/logo_mini.png") }}'>
      <title>Personal Area | MoMA</title>
      <link rel="stylesheet" href='{{ URL::to("personal_area.css") }}'/>
      <script src='{{ URL::to("personal_area.js") }}' defer></script>
      <link rel="preconnect" href='{{ URL::to("https://fonts.googleapis.com") }}'>
      <link rel="preconnect" href='{{ URL::to("https://fonts.gstatic.com") }}' crossorigin>
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap") }}' rel="stylesheet">
      <link href='{{ URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap") }}' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <header id="fix_header">
        <div id="header_nav_upper">
            <img class="logo" src='{{ URL::to("images\logo.png") }}'/>
            <a href='{{ URL::to("logout") }}'>Logout</a>
        </div>
        <div id="header_nav_lower">
            <a href='{{ URL::to("index") }}'>Home</a> 
            <a href='{{ URL::to("change_password") }}'>Change Password</a>  
            <a href='{{ URL::to("new_auction") }}'>New auction</a>  
            <a href='{{ URL::to("running_auction") }}'>Running auction</a>  
            <a href='{{ URL::to("collection") }}'>Collection</a>
            <div class="header_nav_lower_right"></div>
        </div>
    </header>
    <section id="notifications" class='hidden'>
    </section>
    <section id="dinamic_header" class='hidden'>
            <div class="left">
            <a href='{{ URL::to("index") }}'>Home</a> 
            <a href='{{ URL::to("change_password") }}'>Change Password</a>  
            <a href='{{ URL::to("new_auction") }}'>New auction</a>   
            <a href='{{ URL::to("running_auction") }}'>Running auction</a>  
            <a href='{{ URL::to("collection") }}'>Collection</a>
            </div>
            <div class="right">
                @if(!isset($error))
                <h1>Hello, {{ $nome }}</h1>
                @if($genere == "Female")
                <img src='{{ URL::to("images\women.jpg") }}'/>
                    @elseif ($genere == "Male")
                    <img src='{{ URL::to("images\man.jpg") }}'/> 
                        @else 
                        <img src='{{ URL::to("images\personal_area.jpeg") }}'/>
                @endif
                @endif
                <a href='{{ URL::to("logout") }}'>Logout</a>
            </div>
    </section>
    <section id="user">
                @if($genere == "Female")
                <img src='{{ URL::to("images\women.jpg") }}'/>
                    @elseif ($genere == "Male")
                    <img src='{{ URL::to("images\man.jpg") }}'/> 
                        @else 
                        <img src='{{ URL::to("images\personal_area.jpeg") }}'/>
                @endif
                @if(!isset($error))
                <h1>{{ $cognome . ' ' . $nome }}</h1>
                @endif
    </section>
    <section id="collection">
        <h1>Favourites for my MoMA tour</h1>
        <div id="collection_figlio"></div>
    </section>
    <section id="tour">
        <h1>My MoMA tour saved</h1>
        <div id="tour_figlio"></div>
    </section>
    <section id="auction_ongoing">
        <h1>My auction ongoing</h1>
        <div id="ongoing_figlio"></div>
    </section>
    <section id="auction">
        <h1>My auctions</h1>
        <div id="auction_figlio"></div>
    </section>
  </body>