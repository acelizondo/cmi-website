<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 5/30/16
 * Time: 12:10 PM
 */

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$from = 'From: CMI Website';
$to = 'acelizondo11@gmail.com';
$subject = "Feedback from $email";

$body = "From: $name\n E-Mail: $email\n Message:\n $message";
if (isset($_POST['submit'])) {
    if (mail ($to, $subject, $body, $from)) {
        echo '<p>Your message has been sent!</p>';
    } else {
        echo '<p>Something went wrong, go back and try again!</p>';
    }
}