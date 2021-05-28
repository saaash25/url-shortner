<?php
//session_start();
$textButton = "Login";
if (!isset($_SESSION['US_Username']) && !isset($_SESSION['US_Id'])) {
    $textButton = "Login";
    $linstingLink = "none";
} else {
    $textButton = "Logout";
    $linstingLink = "block";
}
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top" style="background-color: #83408c;">
        <div class="container-fluid">
            <a href="<?= BASEPATH ?>" class="navbar-brand text-white font-weight-bold" >URL Shortener</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white " style="display:<?= $linstingLink ?>" href="<?= BASEPATH ?>admin">Listing</a>
                    </li>
                </ul>
                <button type="button" class="btn btn-sm btn-info ml-auto login-button <?= $textButton ?>" ><?= $textButton ?></button>
            </div>
        </div>
    </nav>
</header>

