<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <script src="https://kit.fontawesome.com/3cfd8f1d7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.2.1/hamburgers.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/styles/styles.css">
</head>

<body>
    <header>
        <section class="container-head">

            <a href="index.php" class="brand ">
                <div class="logo">
                     <img src="assets/img/logo.svg" alt="log">
                </div>
                WEBMINDS
            </a>
            

            <button class="hamburger panel_btn hamburger--spring" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>

            <aside class="panel">
            <nav class="menu  head_nav">
                    <a class="menu-link" href="index.php#budget">Budget</a>
                    <a class="menu-link" href="index.php?page=contact">Contact</a>
                    <?php if(isset($_SESSION['client_username']) || isset($_SESSION['admin_username'])):?>
                    <a class="menu-link" href="index.php?page=profile">Profile</a>
                    <a id="logout_btn" class="menu-link" href="app/controllers/logoutController.php">Logout</a>
                    <?php else: ?>
                        <a class="menu-link btn nav_btn" href="index.php?page=login">Login</a>
                        <a class="menu-link btn nav_btn" href="index.php?page=register">Sing up</a>
                    <?php endif;?>

                </nav>
            </aside>
                

            </div>
        </section>

    </header>
