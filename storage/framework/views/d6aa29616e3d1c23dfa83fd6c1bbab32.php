<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>Personal Area | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("personal_area.css")); ?>'/>
      <script src='<?php echo e(URL::to("personal_area.js")); ?>' defer></script>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
  <header id="fix_header">
        <div id="header_nav_upper">
            <img class="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <a href='<?php echo e(URL::to("logout")); ?>'>Logout</a>
        </div>
        <div id="header_nav_lower">
            <a href='<?php echo e(URL::to("index")); ?>'>Home</a> 
            <a href='<?php echo e(URL::to("change_password")); ?>'>Change Password</a>  
            <a href='<?php echo e(URL::to("new_auction")); ?>'>New auction</a>  
            <a href='<?php echo e(URL::to("running_auction")); ?>'>Running auction</a>  
            <a href='<?php echo e(URL::to("collection")); ?>'>Collection</a>
            <div class="header_nav_lower_right"></div>
        </div>
    </header>
    <section id="notifications" class='hidden'>
    </section>
    <section id="dinamic_header" class='hidden'>
            <div class="left">
            <a href='<?php echo e(URL::to("index")); ?>'>Home</a> 
            <a href='<?php echo e(URL::to("change_password")); ?>'>Change Password</a>  
            <a href='<?php echo e(URL::to("new_auction")); ?>'>New auction</a>   
            <a href='<?php echo e(URL::to("running_auction")); ?>'>Running auction</a>  
            <a href='<?php echo e(URL::to("collection")); ?>'>Collection</a>
            </div>
            <div class="right">
                <?php if(!isset($error)): ?>
                <h1>Hello, <?php echo e($nome); ?></h1>
                <?php if($genere == "Female"): ?>
                <img src='<?php echo e(URL::to("images\women.jpg")); ?>'/>
                    <?php elseif($genere == "Male"): ?>
                    <img src='<?php echo e(URL::to("images\man.jpg")); ?>'/> 
                        <?php else: ?> 
                        <img src='<?php echo e(URL::to("images\personal_area.jpeg")); ?>'/>
                <?php endif; ?>
                <?php endif; ?>
                <a href='<?php echo e(URL::to("logout")); ?>'>Logout</a>
            </div>
    </section>
    <section id="user">
                <?php if($genere == "Female"): ?>
                <img src='<?php echo e(URL::to("images\women.jpg")); ?>'/>
                    <?php elseif($genere == "Male"): ?>
                    <img src='<?php echo e(URL::to("images\man.jpg")); ?>'/> 
                        <?php else: ?> 
                        <img src='<?php echo e(URL::to("images\personal_area.jpeg")); ?>'/>
                <?php endif; ?>
                <?php if(!isset($error)): ?>
                <h1><?php echo e($cognome . ' ' . $nome); ?></h1>
                <?php endif; ?>
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
  </body><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/personal_area.blade.php ENDPATH**/ ?>