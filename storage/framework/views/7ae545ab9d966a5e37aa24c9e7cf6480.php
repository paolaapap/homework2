<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>The Collection | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("collection.css")); ?>'/>
      <script src='<?php echo e(URL::to("collection.js")); ?>' defer></script>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <header id="fix_header">
        <div id="header_nav_upper">
            <img class="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <a href='<?php echo e(URL::to("personal_area")); ?>'>Personal Area</a>
        </div>
        <div id="header_nav_lower">
            <span>Visit</span> 
            <span>Auctions</span>  
            <span class="current_page">Art and artist</span>  
            <span>Store</span>   
            <a href='<?php echo e(URL::to("index")); ?>'>Home</a>
            <div class="header_nav_lower_right"></div>
        </div>
    </header>
    <section id="dinamic_header" class='hidden'>
            <div class="left">
                <span>Visit</span> 
                <span>Auctions</span>  
                <span class="current_page">Art and artist</span>  
                <span>Store</span>    
                <a href='<?php echo e(URL::to("index")); ?>'>Home</a>
            </div>
            <div class="right">
                <a href='<?php echo e(URL::to("personal_area")); ?>'>Personal Area</a>
            </div>
    </section>
    <h1 id="page_title">The Collection</h1>
    <section id="filter">
        <input list="filters" id="filter_input" placeholder="Filter by categories" spellcheck="false">
        <datalist id="filters"></datalist>
    </section>
    <section id="artworks_section"></section>
</body><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/collection.blade.php ENDPATH**/ ?>