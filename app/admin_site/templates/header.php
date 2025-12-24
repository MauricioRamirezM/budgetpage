<?php
session_start();

$base_path = "http://localhost/final_project_php/";
$admin_path = "http://localhost/final_project_php/app/admin_site/";

if (!isset($_SESSION['admin_username'])) {
    header("Location:" . $base_path . "index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3cfd8f1d7a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.2.1/hamburgers.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_path ?>public/styles/admin_styles/admin_styles.css">
    <title>Admin Landingpage</title>
</head>




<body>
    <header>
        <nav class="navbar navbar-expand-sm ps-5 navbar-light bg-light">
            <a href="<?= $admin_path ?>index.php" class="navbar-brand brand">
                <div class="logo">
                    <img src="<?= $base_path ?>assets/img/logo.svg" alt="">
                </div>
                WEBMINDS
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"  data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto admin_nav  mt-2 mt-lg-0">

                    <li class="nav-item active">
                        <a class="nav-link" href="<?= $admin_path ?>sections/news">News </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $admin_path ?>sections/services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $admin_path ?>sections/projects">Proyects</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $admin_path ?>sections/add_admin">Add admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $admin_path ?>sections/clients">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_path ?>app/controllers/logoutController.php">Logout</a>
                    </li>

                </ul>

            </div>
        </nav>

    </header>
    <main>