<?php
session_start();
require_once('init.php');


if (isset($_POST['submit-signup'])) {

    $user_name = $_POST['user_name'];
    $user_second_name = $_POST['user_second_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_rep_password = $_POST['user_rep_password'];
    $user_admin = $_POST['user_admin'];

    $new_user = new SignUpController($user_name, $user_second_name, $user_email, $user_password, $user_rep_password, $user_admin);
    $new_user->checkUserInput();

    header('Location: ../frontend/signup.php?succes=newAccount');
}

if (isset($_POST['submit-login'])) {

    $user_email_login = $_POST['user_email_login'];
    $user_password_login = $_POST['user_password_login'];

    $login = new LoginController($user_email_login, $user_password_login);
    $login->checkUserInputLogin();

    header('Location: ../frontend/index.php');
}
