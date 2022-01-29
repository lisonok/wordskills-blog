<?php

if (isset($_SESSION['loggedin'])) {
    header('location:feed.php');
}
