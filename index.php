<?php
if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    require 'categorie.php';
} else {
    require 'home.php';
}
