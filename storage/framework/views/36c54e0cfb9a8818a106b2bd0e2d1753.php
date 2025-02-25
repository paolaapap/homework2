<!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
      <link rel="icon" type="image/png" href='<?php echo e(URL::to("images/logo_mini.png")); ?>'>
      <title>MoMA</title>
      <link rel="stylesheet" href='<?php echo e(URL::to("index.css")); ?>'/>
      <script src='<?php echo e(URL::to("index.js")); ?>' defer></script>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.googleapis.com")); ?>'>
      <link rel="preconnect" href='<?php echo e(URL::to("https://fonts.gstatic.com")); ?>' crossorigin>
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Lalezar&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Ramabhadra&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap")); ?>' rel="stylesheet">
      <link href='<?php echo e(URL::to("https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&display=swap")); ?>' rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <header>
        <div id="header_nav_upper">
            <img class="logo" src='<?php echo e(URL::to("images\logo.png")); ?>'/>
            <span class="hotel">Nearby Hotel</span>
            <a class="a1" href='<?php echo e(URL::to("login")); ?>'>Membership</a>
            <a class="a2" href=''>Tickets</a>
        </div>
        <div id="header_nav_lower">
            <span data-index="1">Visit</span> 
            <span data-index="2">Auctions</span>  
            <span data-index="3">Art and artist</span>  
            <a href="">Store</a>   
            <img src='<?php echo e(URL::to("images\search_icon.png")); ?>' />
            <div class="profile">
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
            </div>
        </div>
    </header>
    <section id="menu_personal_area" class="hidden">
        <a href='<?php echo e(URL::to("personal_area")); ?>'>Personal Area</a>
        <a href='<?php echo e(URL::to("change_password")); ?>'>Change password</a>
        <a href='<?php echo e(URL::to("logout")); ?>'>Logout</a>
    </section>
    <section id="header_scroll" class="hidden">
        <div class="left">
            <span data-index="1">Visit</span> 
            <span data-index="2">Auctions</span>  
            <span data-index="3">Art and artist</span>  
            <a href="">Store</a>   
            <img src='<?php echo e(URL::to("images\search_icon.png")); ?>' />   
        </div>
        <div class="right">
            <span class="hotel">Nearby Hotel</span>
            <a href='<?php echo e(URL::to("login")); ?>'>Membership</a>
            <a href="">Tickets</a>
        </div>
    </section>
    <section id="book_a_tour" class="hidden"></section>
    <section id="pop_up_m_v" class='pop_up_menu hidden'>
        <span>Tickets</span>
        <span>Locations,hours,and admission</span>
        <span>Map,audio,and more</span>
        <span>Where to start</span>
        <span>Customized tours</span>
        <span>Frequently asked questions</span>
        <span class="tour">Book a tour</span>
        <span class="close">X</span>
    </section>
    <section id="pop_up_m_w" class='pop_up_menu hidden'>
        <a href='<?php echo e(URL::to("new_auction")); ?>'>New auction</a>
        <a href='<?php echo e(URL::to("running_auction")); ?>'>Running auction</a>
        <span>Where to start</span>
        <span>Performance programs</span>
        <span class="close">X</span>
    </section>
    <section id="pop_up_m_a" class='pop_up_menu hidden'>
        <a href='<?php echo e(URL::to("collection")); ?>'>The Collection</a>
        <span>Artists</span>
        <span>Art terms</span>
        <span>Audio</span>
        <span>Magazine</span>
        <span class="close">X</span>
    </section>
    <section id="search_artist" class="hidden">
        <form>
            <input type="text" spellcheck="false" placeholder="Search an artist on MoMA.org" class='text_box'>
            <input type="submit" id="submit_artist" value="">
        </form>
    </section>
    <section id="modal_view_artworks" class='hidden'>
        <div id="artworks_results">
        </div>
    </section>
    <section id="modal_view_hotel" class='hidden'>
        <h1>click esc to return</h1>
        <form>
            <input type="text" id="check_in" class="box" placeholder="check-in date YYYY-MM-DD">
            <input type="text" id="check_out" class="box" placeholder="check-out date YYYY-MM-DD">
            <input type="number" id="adult" class="box" placeholder="adults" min="1" step="1">
            <input type="number" id="rooms" class="box" placeholder="rooms" min="1" max= "4" step="1">
            <input type="submit" id="enter" value="&#8594;">
        </form>
        <div class="hotel_grid"></div>
    </section>
    <section id="exibitions"></section>
    <section id="home_location">
        <div class='home h1'>
            <span class="home_descr">MoMA</br>
                11 West 53 Street, Manhattan</br>
                Open today, 10:30 a.m.-5:30p.m.
            </span>
            <span class='home_descr d2'>Plan your visit &#8594;</span>
        </div>
        <div class='home h2'>
            <span class="home_descr">MoMA PS1</br>
                Visit MoMA PS1 in Queens</br>
                Free for New Yorkers
            </span>
            <span class='home_descr d2'>Learn more &#8599;</span>
        </div>
    </section>
    <section id="news_letter">
        <span class='newsl_descr n1'>Get art and ideas in your inbox</span>
        <span class='newsl_descr n2'>
            <input type="text" spellcheck="false" placeholder="Sign up for our newsletter" class="a" data-info="newsLetter"/>
        </span>
    </section>
    <section id="magazine">
        <h1 class="mag1">Magazine</h1>
        <div class="mag2"></div>
    </section>
    <section id="collection">
        <div class="title">In the collection</div>
        <div class="subtitle">See what's on view &#8594;</div>    
    </section>
    <?php if(isset($error)): ?>
    <section id='orange'>
        <a href='<?php echo e(URL::to("login")); ?>'><div class='orange_figlio'>
            <div class='o1'>
                <span class='title'>Discover more</br> 
                    as a member</span>
                <span class='subtitle'>Join today &#8594;</span>
            </div> 
            <div class='o2'>
                <img src='images\orange.gif'/>
            </div> 
        </div></a>
    </section>
    <?php endif; ?>
    <section id="store">
        <div class="store1">
            <div class="title">Store</div>
            <img src='<?php echo e(URL::to("images\store1.jpg")); ?>'/>
            <div class="subtitle">Good Design in Living Color</div> 
        </div>
        <div class="store2">
            <div class="title">Store</div>
            <img src='<?php echo e(URL::to("images\store2.png")); ?>'/>
            <div class="subtitle">Jean-Michel Basquiat Edition Polaroid</div> 
        </div>   
    </section>
    <section id="sponsor">
        <span class="title">MoMA gratefully acknowledges its major partners.</span>
    </section>
    <footer id="footer">
        <div class="footer_section">
            <div class="left">
                <span class="word">About us</span>
                <span class="word">Support</span>
                <span class="word">Research</span>
                <span class="word">Teaching</span>
                <span class="word">Magazine</span>
            </div>
            <a href='<?php echo e(URL::to("login")); ?>' class='word right'>Log in</a>
        </div>
        <div class="footer_address">
            <div class="left">
                <span class="word">MoMA</br>
                    11 West 53 Street, Manhattan</br>
                    Open today, 10:30 a.m.-5:30 p.m.
                </span>
                <div class="social">
                    <img class="icon" src='<?php echo e(URL::to("images/instagram.png")); ?>'/>
                    <img class='icon f' src='<?php echo e(URL::to("images/facebook.png")); ?>'/>
                    <img class="icon" src='<?php echo e(URL::to("images/mail.png")); ?>'/>
                    <img class="icon" src='<?php echo e(URL::to("images/tiktok.png")); ?>'/>
                    <img class='icon s' src='<?php echo e(URL::to("images/spotify.png")); ?>'/>
                    <img class="icon" src='<?php echo e(URL::to("images/youtube.png")); ?>'/>
                  
                </div>
            </div>
            <span class='word right'>MoMA PS1</br>
                Visit MoMA PS1 in Queens</br>
                Free for New Yorkers
            </span>   
        </div>
        <div class="footer_mail">
            <input type="text" spellcheck="false" placeholder="Art and ideas in your inbox" class='word a' data-info="footer"/>  
        </div>
        <div class="footer_info">
            <span class="title">MoMA</span>
            <span class="info">
                <span class="word">Privacy policy</span>
                <span class="word">Terms of use</span>
                <span class="word">Visitor guidelines and policies</span>
                <span class="word">Reset text contrast</span>
            </span>
            <span class="trademark">© 2024 The Museum of Modern Art</span>
        </div>
    </footer>
  </body>
 </html><?php /**PATH C:\Users\paola\Desktop\Università\5. TERZO ANNO\Web programming\HomeWork\hw2\hw2\resources\views/index.blade.php ENDPATH**/ ?>