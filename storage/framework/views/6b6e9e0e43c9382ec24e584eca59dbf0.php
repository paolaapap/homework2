<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>Change password | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("change_password.css")); ?>'/>
      <script src='<?php echo e(URL::to("change_password.js")); ?>' defer></script>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="change_password">
            <img id="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <h1>Change your password.</h1>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class='error_php'><?php echo e($err); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <form name="form_change_password" method="post">
                <?php echo csrf_field(); ?>
              <input type="email" name="email" placeholder="Email address" class="input" value='<?php echo e(old("email")); ?>' >
              <input type="password" name="old_password" placeholder="Old password" class="input" value='<?php echo e(old("old_password")); ?>'>
              <input type="password" name="new_password" placeholder="New password" class="input" value='<?php echo e(old("new_password")); ?>'>
              <input type="password" name="new_password_confirm" placeholder="Repeat new password" class="input" value='<?php echo e(old("new_password_confirm")); ?>'>
              <img id="show_pss" src='<?php echo e(URL::to("images\show_pss.jpg")); ?>' /> 
              <input type="submit" value="Change password" class="button">
            </form>
            <a href='<?php echo e(URL::to("personal_area")); ?>'>&#8592; Return to your personal area</a>
            <a href='<?php echo e(URL::to("index")); ?>'>&#8592; Return to home page</a>
          </div>
      </section>
    </section>
  </body><?php /**PATH C:\Users\paola\Desktop\hw2\hw2\resources\views/change_password.blade.php ENDPATH**/ ?>