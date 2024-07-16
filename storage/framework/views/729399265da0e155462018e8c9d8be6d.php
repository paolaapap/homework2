<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>Login | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("login.css")); ?>'/>
      <script src='<?php echo e(URL::to("login.js")); ?>' defer></script>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
      <section id="background">
        <section id="main">
            <div id="login">
              <img id="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
              <h1>Log in to your account with your email and password.</h1>

              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class='error_php'><?php echo e($err); ?></div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <form name="form_login" method="post">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="Email address" class="input" value='<?php echo e(old("email")); ?>'>
                <input type="password" name="password" placeholder="Password" class="input" value='<?php echo e(old("password")); ?>'>
                <img id="show_pss" src='<?php echo e(URL::to("images\show_pss.jpg")); ?>' /> 
                <input type="submit" value="Log in" class="button">
                <label id="remember"><input type="checkbox" name="remember"<?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me</label>
              </form>
              <a href='<?php echo e(URL::to("forgot_password")); ?>'>Forgot your password?</a>
            </div>
            <div id="new_account">
              <div><a href='<?php echo e(URL::to("new_account")); ?>'>
                <h1>Create your new account login &#8594;</h1>
                <span>We recently updated our sign-in process. If you have never created an online account with MoMA, click here to create one now.</span>
              </a></div>
              <a href='<?php echo e(URL::to("index")); ?>' id="return">&#8592; Return to home page</a>
            </div>
        </section>
      </section>
  </body><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/login.blade.php ENDPATH**/ ?>