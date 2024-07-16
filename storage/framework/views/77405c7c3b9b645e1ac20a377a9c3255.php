<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL:: to("images/logo_mini.png")); ?>'>
      <title>Collection details | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL:: to("info_collection.css")); ?>'/>
      <script src='<?php echo e(URL:: to("info_collection.js")); ?>' defer></script>
      <link rel="preconnect" href='<?php echo e(URL:: to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL:: to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL:: to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL:: to("https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL:: to("https://fonts.googleapis.com/css2?family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL:: to("https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <header id="fix_header">
        <div id="header_nav_upper">
            <img class="logo" src='<?php echo e(URL:: to("images\logo.png")); ?>'/>
                <a class="a1" href='<?php echo e(URL:: to("personal_area")); ?>'>Personal area</a>
        </div>
        <div id="header_nav_lower">
            <span>Visit</span> 
            <span class="current_page">Auctions</span>  
            <span>Art and artist</span>  
            <span>Store</span>   
            <a href='<?php echo e(URL:: to("collection")); ?>'>Collection</a>
            <div class="header_nav_lower_right"></div>
        </div>
    </header>
    <section id="dinamic_header" class='hidden'>
            <div class="left">
                <span>Visit</span> 
                <span class="current_page">Auctions</span>  
                <span>Art and artist</span>  
                <span>Store</span>    
                <a href='<?php echo e(URL:: to("collection")); ?>'>Collection</a> 
            </div>
            <div class="right">
                <a class="a1" href='<?php echo e(URL:: to("personal_area")); ?>'>Personal area</a>
            </div>
    </section>
    <section id="show_collection">
    <div id="image">
        <?php if(!empty($content->image)): ?>
            <img src="<?php echo e(URL::to($content->image)); ?>" />
        <?php endif; ?>
    </div>
    <div id="details">
        <div class="left">
            <span class="title"><?php echo e($content->name); ?></span>
            <span><?php echo e($content->period); ?></span>
            <span class="now_on_view">Now on view</span>
            <span><?php echo e($content->location); ?></span>
        </div>
        <div class="right">
            <span class="title">Description</span>
            <span><?php echo e($content->description); ?></span>
            <span class="little_title">Dimension</span>
            <span><?php echo e($content->dimension); ?></span>
            <span class="little_title">Credit</span>
            <span><?php echo e($content->credit); ?></span>
            <span class="little_title">Department</span>
            <span><?php echo e($category); ?></span>
            <span class="little_title">Number of likes</span>
            <span><?php echo e($num_like); ?></span>
        </div>
    </div>
    </section>
  </body><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/info_collection.blade.php ENDPATH**/ ?>