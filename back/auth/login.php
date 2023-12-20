<?php

// Check the server method and make it sure that it is a POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /**
     * Check all the fields
     * If everything is okay, we log the user in
     */
    $post = $_POST;
    require_once('../../back/queries/queries.php');
    if (
        !isset($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL) || empty($post['email']) || !isset($post['password']) || empty($post['password'])
    ) {
        $errorMessage = 'Make sure to fill all the fields before continue.';
    } else {
        $email = strip_tags($post['email']);
        $password = strip_tags($post['password']);

        // Check if the user exists
        $isUserExist = isUserExist($email);
        if ($isUserExist == 1) {
            $user = getUserInformations($email);
            // Check the password
            $isPasswordCorrect = password_verify($password, $user['pass']);
            if (!$isPasswordCorrect) {
                $errorMessage = 'Wrong credentials, please try again.';
            } else {
                // Create sessions
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                // If the user informations exist, redirect him to the chat box
                if (isUserInformationsExist($user['id']) == 1) {
                    // User is online
                    createUserOnline($_SESSION['id']);
                    header('Location: ../chat/chatbox.php');
                } else {
                    // Add user informations
                    createUserInformations($_SESSION['id']);
                    // User is online
                    createUserOnline($_SESSION['id']);
                    // Otherwise, redirect him to the welcome page and insert informations in the database
                    header('Location: ../welcome/welcome.php');
                }
            }
        } else {
            $errorMessage = 'Wrong credentials, please try again.';
        }
    }
}
