<?php
session_start();
require_once('init.php');

// Change profile picture

if (isset($_POST['submit-profile'])) {

    $picture = $_FILES['picture'];

    $picture_name = $picture['name'];
    $picture_tmp_name = $picture['tmp_name'];
    $picture_size = $picture['size'];
    $picture_error = $picture['error'];
    $picture_type = $picture['type'];

    $picture_extension = explode(".", $picture_name);
    $picture_extension_lower = strtolower(end($picture_extension));

    $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'webp'];

    if (in_array($picture_extension_lower, $allowed)) {
        if ($picture_error === 0) {
            if ($picture_size < 400000) {

                $picture_new_name = uniqid('', true) . '.' . $picture_extension_lower;
                $picture_destination = '../db_img/' . $picture_new_name;
                move_uploaded_file($picture_tmp_name, $picture_destination);

                $new_picture = new UsersClass;
                $new_picture->setPicture($picture_new_name, $_SESSION['id']);
                header('Location: ../frontend/account.php?success=picturechanged');
            } else {
                header('Location: ../frontend/account.php?error=big');
                exit();
            }
        } else {
            header('Location: ../frontend/account.php?error=error');
            exit();
        }
    } else {
        header('Location: ../frontend/account.php?error=invalidExtension');
        exit();
    }
}

// Change details

if (isset($_POST['submit-personal'])) {

    $user_name = $_POST['user_name'];
    $user_second_name = $_POST['user_second_name'];
    $user_email = $_POST['user_email'];

    if (!empty($user_name) && !empty($user_second_name)) {
        if (preg_match("/^[a-zA-Z]*$/", $user_name) && preg_match("/^[a-zA-Z]*$/", $user_second_name)) {
            $updated_user = new UsersClass;
            $updated_user->updateUserPersonalDetails($user_name, $user_second_name, $user_email, $_SESSION['id']);
            header('Location: ../frontend/account.php?success=detailschanged');
        } else {
            header('Location: ../frontend/account.php?error=wrongname');
            exit();
        }
    } else {
        header('Location: ../frontend/account.php?error=emptyfields');
        exit();
    }
}

// Change address LATER

if (isset($_POST['submit-address'])) {

    $user_city = $_POST['city'];
    $user_street = $_POST['street'];
    $user_country = $_POST['country'];

    $address = new Address;
    $address->checkForUserAddress($_SESSION['id'], $user_city, $user_street, $user_country);

    header('Location: ../frontend/account.php?address=inserted');
    exit();
}
