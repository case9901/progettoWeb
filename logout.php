<?php
require_once 'bootstrap.php';
setcookie("cart", "", time() - 3600);
session_unset();
include("index.php");
?>