<html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>Failed Email | MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("failed_email.css")); ?>'/>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <section id="background">
      <section id="main">
          <div id="failed_email">
            <img id="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <span>An unexpected error occurred and sending the email to the address you provided failed. Please try again in the forgot password section. </span>
            <a href='<?php echo e(URL::to("forgot_password")); ?>'>&#8592; Return to forgot password</a>
            <a href='<?php echo e(URL::to("index")); ?>'>&#8592; Return to home page</a>
          </div>
      </section>
    </section>
  </body><?php /**PATH C:\Users\paola\Desktop\hw2\hw2\resources\views/failed_mail.blade.php ENDPATH**/ ?>