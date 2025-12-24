<?php
include("templates/header.php");

require("settings/database.php");


$query = "SELECT * FROM news";
$statement = $mysqli->prepare($query);
$statement->execute();
$result = $statement->get_result();
$news_list = $result->fetch_all(MYSQLI_ASSOC);

$query = "SELECT * FROM services";
$statement = $mysqli->prepare($query);
$statement->execute();
$result = $statement->get_result();
$services_list = $result->fetch_all(MYSQLI_ASSOC);


$query = "SELECT * FROM projects";
$statement = $mysqli->prepare($query);
$statement->execute();
$result =  $statement->get_result();
$project_list = $result->fetch_all(MYSQLI_ASSOC);

?>
<div class="banner">
    <div class="company">
        <h1>WEBMINDS </h1>
        <?php if(isset($_SESSION['client_username'])):?>
        <h3>Welcome to WebMinds <?=$_SESSION['client_username'];?></h3>
        <?php endif;?>
        <h5> As a leading web development company, we specialize in crafting custom websites, dynamic web applications, and seamless e-commerce platforms that drive results. Whether you're a startup, a growing business, or an established enterprise, we are here to bring your vision to life.</h5>
    </div>
</div>

<main>

    <div class="container-fluid mb-5 news_wrapper">
        <div class="row row_news">
            <?php foreach ($news_list as $new): ?>
                <div class="card card_news"  id="card_news" style="width: 18%;">
                    <img id="new_img" src="assets/img/news/<?= $new['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 id="new_title" class="card-title"><?= $new['title']; ?></h5>
                        <p id="new_description" class="card-text hide "><?= $new['description']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row show_new hide ">
            <div class="close_new_btn">&#x2715</div>
            <div class="card mb-3 new_container" >
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="" class="img-fluid img_new rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div id="large_new" class="card-body">
                            <h5 class="card-title new-card_title">Card title</h5>
                            <p class="card-text new_card_text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary"><a href="https://www.developer-tech.com/"> See more...</a></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container mt-5 mb-5 services_wrapper">
        <div class="row row_services">
            <?php
            $counter = 1;
            foreach ($services_list as $service):
            ?>
                <div <?php echo ($counter <= 3) ?  "class='card text-center mb-3' style='width: 30%';" : "class='card  mb-3 text-center' style='width: 75%'"; ?>>
                    <div class="card-body">

                        <h5 class="card-title"><i class="fa-solid <?php echo $service['icone']; ?>"> </i><?php echo $service['title']; ?></h5>
                        <p class="card-text"><?php echo $service['description']; ?></p>
                    </div>
                </div>

            <?php
                $counter++;
            endforeach;
            ?>

        </div>

    </div>

    <div class="container proyects_wrapper">
        <div class="row row_proyects">
            <?php foreach ($project_list as $project):
                $techArray = explode(",", $project["technologies"]) ?>
                <div class="card">
                    <img src="assets/img/projects/<?php echo $project['image']; ?>" class=" mt-1 card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $project['title']; ?></h5>
                        <p class="card-text hide"><?php echo $project['description']; ?></p>
                        <div class="technologies">
                            <?php
                            foreach ($techArray as $tech) {
                                switch ($tech) {
                                    case "html":
                                        echo "<i class='fa-brands   tech fa-html5'></i> ";
                                        break;
                                    case "css":
                                        echo "<i class='fa-brands  tech fa-css'></i> ";
                                        break;
                                    case "javascript":
                                        echo "<i class=' tech fa-brands fa-js'></i> ";
                                        break;
                                    case "php":
                                        echo "<i class=' tech fa-brands fa-php'></i> ";
                                        break;
                                    case "mysql":
                                        echo "<i class=' tech fa-solid fa-database'></i> ";
                                        break;
                                }
                            };
                            ?>
                        </div>
                    </div>


                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="container budget_container " id="budget">
        <div class="row row_budget justify-content-center">
            <div class="card budget_card w-75">
                <div class=" h2 card-header">
                    Budget
                </div>
                <div class="card-body" id="card_body">
                    <form class="budget_form" action="" method="post">
                        <div class="form-group">
                            <label for="months">Term in Months:</label>
                            <input required type="text" class="form-control" name="months" id="monthsid"
                                aria-describedby="helpId" placeholder="Enter the term in months" pattern="^\d{1,2}$" title="Enter your deadline in months (1,2,3...)">
                        </div>
                        <div class="form-group">
                            <label for="websites_select">Options:</label>
                            <select class="form-control" name="websites_select" id="websites_select">
                                <option value="1200">Restaurant Website 1200€</option>
                                <option value="900">Personal portfolio 900€</option>
                                <option value="1000">technical assistence 1000€</option>
                                <option value="2800">Site for company 2800€</option>
                            </select>
                        </div>
                        <div class="row show_discount">
                            <small><i> You receive a discount based on the number of months you choose.</i></small>

                            <h4><i>Subtotal with discount<p class="porcent"></p>: <b class="h2 subtotal"></b></i></h4>
                        </div>

                        <div class="row check_wrapper">


                            <h3 class=" "><i>Add the section you need! <small>200€/each.</i></small></h3>
                            <div class="col-xs-4 check_box">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input checkbox" name="checkbox" id="checkbox"
                                            value="200">
                                        News
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox"
                                            value="200">
                                        Contact
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox"
                                            value="200">
                                        Location
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-4 check_box">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox"
                                            value="200">
                                        E-shop
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox"
                                            value="200">
                                        Portfolio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="checkbox" id="checkbox"
                                            value="200">
                                        Adminitrator
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <label for="subtotal " class="h3">The total is:</label>
                                <span class="total h2"></span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
include("templates/footer.php")
?>