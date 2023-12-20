<?php

// Check if there's a opened session
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    if (isset($_GET['chatWith']) && $_GET['chatWith'] != '') {
        $_GET['chatWith'] = (int) $_GET['chatWith'];
        $idUserIWantToChatWith = strip_tags($_GET['chatWith']);
        /**
         * Start checking if the user actually online
         * and the user we want to send a message exist
         */
        $isActualOnlineUserExists = isUserExist($_SESSION['email']);
        $isUserIWantToChatWithExists = isUserExist($idUserIWantToChatWith);
        // If actual online user exists
        if ($isActualOnlineUserExists != 0) {
            // Check the form validity
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $post = $_POST;
                if(isset($post['submit'])) {
                    if(!isset($post['message']) || empty($post['message'])) {
                        echo '';
                    } else {
                        $message = htmlspecialchars($post['message']);
                        // Send the message
                        sendMessage(
                            $_SESSION['id'],
                            $idUserIWantToChatWith,
                            $message,
                        );

                    }
                }
            }
        } else {
            echo 'This user doesn\'t exists';
            return;
        }
    } else {
        echo 'ID is missing in the url.';
        return;
    }
}
