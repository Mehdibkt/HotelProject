<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>
        <?php echo $settings_r['site_title'] ?>
    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <style>
        * {
            font-family: 'Rubik', sans-serif;
        }

        .h-font {
            font-family: 'Rubik', sans-serif;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Header -->
    <?php require('inc/header.php'); ?>

    <!-- Carousel -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/carousel/1.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/2.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/3.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/4.png" class="w-100 d-block" />
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/5.png" class="w-100 d-block" />
                </div>
            </div>
        </div>
    </div>

    <!-- Chaines Hotels -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR HOTEL CHAINS</h2>
    <div class="container">
        <div class="row">
            <?php
            $chain_res = selectAll('chains');

            while ($chain_data = mysqli_fetch_assoc($chain_res)){

            //get thumbnail of the chain
            $chain_thumb = CHAINS_IMG_PATH . "1.jpg";
            $thumb_q = mysqli_query($con, "SELECT * FROM `chain_images` 
            WHERE `chain_id`='$chain_data[chain_id]'
            AND `thumb`='1'");

            if (mysqli_num_rows($thumb_q) > 0) {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $chain_thumb = CHAINS_IMG_PATH . $thumb_res['image'];
            }

            
            //print room card
        
            echo <<<data
    
            <div class="col-lg-4 col-md-6 my-3">  
            <div class="card border-0 shadow" style=" max-width: 350px; margin: auto;">
                <img src=$chain_thumb class="card-img-top">
                <div class="card-body ">
                        <h5 class="fw-bold">$chain_data[name]</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lectus orci, mattis sed auctor a, blandit in lorem. Donec bibendum metus non turpis malesuada, ut tempus sapien scelerisque. </p>
                        <div class="Address mb-3">
                            <div class="row">
                                <div class="col-auto">
                                    <h6 class="d-inline mb-1">Address</h6>
                                </div>
                                <div class="col">
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">$chain_data[c_address]</span>
                                </div>
                            </div>
                        </div>
                        <div class="Contact mb-3">
                            <div class="row">
                                <div class="col-auto">
                                    <h6 class="d-inline mb-1">Contact</h6>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">Email: $chain_data[c_email] </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">Phone Number: $chain_data[c_pn]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a href="hotels.php" class="btn btn-sm custom-bg text-white shadow-none">Discover hotels</a>
                        </div>
                </div>
            </div>
            </div>
            
            data;
            }
            ?>
        </div>
    </div>

    <!-- Reach Us -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100" height="320 px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call us</h5>
                    <a href="tel: (819) 123-4567" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +1
                        <?php echo $contact_r['pn'] ?>
                    </a>
                    <br>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: <?php echo $contact_r['email'] ?>"
                        class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i>
                        <?php echo $contact_r['email'] ?>
                    </a>
                    <br>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow Us</h5>
                    <?php
                    if ($contact_r['tw'] != '') {
                        echo <<<data
                <a href="$contact_r[tw]" class="d-inline-block mb-3">
                  <span class="badge bg-light text-dark fs-6 p-2"> 
                  <i class="bi bi-twitter me-1"></i> Twitter
                  </span>
                </a>
                <br>
              data;
                    }
                    ?>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <?php require('inc/footer.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            }
        });
    </script>
</body>

</html>