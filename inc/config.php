<?php

// add a slash if the file is included in index.php
$slash = isset($add_slash) ? "/" : "";

/* Variables */
require $_SERVER['DOCUMENT_ROOT'] . $slash . "inc/variables.php";  /* Fixed */

/* Database */
require $_SERVER['DOCUMENT_ROOT'] . $slash . "inc/database.php"; /* Fixed */

/* Controllers */
require $_SERVER['DOCUMENT_ROOT'] . $slash . "controllers/BasketController.php";

/* Models */
require $_SERVER['DOCUMENT_ROOT'] . $slash . "models/Product.php";
require $_SERVER['DOCUMENT_ROOT'] . $slash . "models/Offer.php";