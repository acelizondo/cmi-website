<?php
/**
 * Created by PhpStorm.
 * User: Aaron
 * Date: 1/14/2016
 * Time: 9:55 PM
 */
if(!isset($_GET['album'])){
    echo "Error loading page";
}else{require 'album.php';}