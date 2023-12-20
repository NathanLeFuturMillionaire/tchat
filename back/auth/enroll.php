<?php

// If the request is a POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /**
     * Check all the fields validity
     * If the submit buttton has been clicked on,
     * Treat all the datas sent by the user,
     * and include some files
     */
    $post = $_POST;
    require_once('../../back/queries/queries.php');
    if (isset($post['submit'])) {
        if (
            !isset($post['username']) || empty($post['username']) || !isset($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)
            || empty($post['email']) || !isset($post['password']) || empty($post['password'])
        ) {
            $errorMessage = 'Make sure to field all the fields before continue.';
        } else {
            $usernamme = strip_tags($post['username']);
            $email = strip_tags($post['email']);
            $password = strip_tags($post['password']);
            // Check the length of the username and passworrd
            if(strlen($usernamme) >= 3) {
                if(strlen($password) >= 6) {
                    // Check if the user exists
                    $isUserExist = isUserExist($email);
                    if($isUserExist == 1) {
                        $errorMessage = sprintf('The email address <strong>%s</strong> is already in use.', $email);
                    } else {
                        // Hash the user password
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $createAccount = createAccount($usernamme, $email, $passwordHash);
                        // If the account has been created
                        if($createAccount) {
                            $successMessage = 'Account created successfully, now <a href="login.php" title="Log in now">log in</a>';
                        }
                    }
                } else {
                    $errorMessage = 'Short password, use a more than 6 characters one.';
                }
            } else {
                $errorMessage = 'Short username, use a more than 3 characters one.';
            }
        }
    }
}
