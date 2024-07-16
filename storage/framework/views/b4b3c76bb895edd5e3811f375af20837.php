<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>New Auction | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("new_auction.css")); ?>'/>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="new_auction">
            <img id="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <h1>Create a new auction.</h1>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class='error_php'><?php echo e($err); ?></div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <form name="form_new_auction" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <input type="file" name="uploaded_image" placeholder="Select image to upload" class="input">
              <input type="input" name="title" placeholder="Title" class="input" value='<?php echo e(old("title")); ?>' >             
              <input type="input" name="deadline" placeholder="Deadline YYYY-MM-DD HH:MM:SS" class="input" value='<?php echo e(old("deadline")); ?>' >
              <input type="input" name="starting_price" placeholder="Starting price" class="input" value='<?php echo e(old("starting_price")); ?>' >
              <input type="submit" value="Create new auction" class="button">
            </form>
            <a href='<?php echo e(URL::to("index")); ?>'>&#8592; Return to home page</a>
            <a href='<?php echo e(URL::to("personal_area")); ?>'>&#8592; Return to personal area</a>
          </div>
      </section>
    </section>
  </body><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/new_auction.blade.php ENDPATH**/ ?>