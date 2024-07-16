<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>New Account | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("new_account.css")); ?>'/>
      <script src='<?php echo e(URL::to("new_account.js")); ?>' defer></script>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet") }}'>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="new_account">
            <img id="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <h1>Create your new account.</h1>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class='error_php'><?php echo e($err); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <form name="form_new_account" method="post">
                <?php echo csrf_field(); ?>
              <input type="input" name="last_name" placeholder="Last name" class="input" value='<?php echo e(old("last_name")); ?>'>
              <input type="input" name="first_name" placeholder="First name" class="input" value='<?php echo e(old("first_name")); ?>' > 
              <select id="gender" name="gender" placeholder="Gender" class="input" value='<?php echo e(old("gender")); ?>'>
                <option value="Other">Non-Specific</option>  
                <option value="Female">Female</option>
                <option value="Male">Male</option>
              </select>            
              <input type="email" name="email" placeholder="Email address" class="input" value='<?php echo e(old("email")); ?>' >
              <input type="password" name="password" placeholder="Create password" class="input" value='<?php echo e(old("password")); ?>' >
              <input type="password" name="password_confirm" placeholder="Confirm password" class="input" value='<?php echo e(old("password_confirm")); ?>' >
              <img id="show_pss" src='<?php echo e(URL::to("images\show_pss.jpg")); ?>' /> 
              <input type="submit" value="Create account" class="button">
            </form>
            <a href='<?php echo e(URL::to("index")); ?>'>&#8592; Return to home page</a>
            <a href='<?php echo e(URL::to("login")); ?>'>&#8592; Return to log in</a>
          </div>
      </section>
    </section>
  </body><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/new_account.blade.php ENDPATH**/ ?>