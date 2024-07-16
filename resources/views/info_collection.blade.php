<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='{{ URL:: to("images/logo_mini.png") }}'>
      <title>Collection details | MoMA</title>
      <link rel="stylesheet" href='{{ URL:: to("info_collection.css") }}'/>
      <script src='{{ URL:: to("info_collection.js") }}' defer></script>
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
            <a href='{{ URL:: to("collection") }}'>Collection</a>
            <div class="header_nav_lower_right"></div>
        </div>
    </header>
    <section id="dinamic_header" class='hidden'>
            <div class="left">
                <span>Visit</span> 
                <span class="current_page">Auctions</span>  
                <span>Art and artist</span>  
                <span>Store</span>    
                <a href='{{ URL:: to("collection") }}'>Collection</a> 
            </div>
            <div class="right">
                <a class="a1" href='{{ URL:: to("personal_area") }}'>Personal area</a>
            </div>
    </section>
    <section id="show_collection">
    <div id="image">
        @if(!empty($content->image))
            <img src="{{ URL::to($content->image) }}" />
        @endif
    </div>
    <div id="details">
        <div class="left">
            <span class="title">{{ $content->name }}</span>
            <span>{{ $content->period }}</span>
            <span class="now_on_view">Now on view</span>
            <span>{{ $content->location }}</span>
        </div>
        <div class="right">
            <span class="title">Description</span>
            <span>{{ $content->description }}</span>
            <span class="little_title">Dimension</span>
            <span>{{ $content->dimension }}</span>
            <span class="little_title">Credit</span>
            <span>{{ $content->credit }}</span>
            <span class="little_title">Department</span>
            <span>{{ $category }}</span>
            <span class="little_title">Number of likes</span>
            <span>{{ $num_like }}</span>
        </div>
    </div>
    </section>
  </body>