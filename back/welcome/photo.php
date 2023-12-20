<?php

// If the server request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post = $_POST;
    require_once('../../back/queries/queries.php');

    if (isset($post['submit'])) {
        // Check if a file has been sent
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {

            // Check the file size
            if ($_FILES['picture']['size'] <= 2000000) {

                // Get the path file
                $fileInfo = pathinfo($_FILES['picture']['name']);
                $extension = $fileInfo['extension'];
                $extentionAllowed = ['jpeg', 'jpg', 'png', 'gif', 'JPEG', 'JPG', 'PNG', 'GIF'];
                if (in_array($extension, $extentionAllowed)) {
                    // If okay, we save the photo
                    move_uploaded_file($_FILES['picture']['tmp_name'], '../profil/picture/' . $_SESSION['id'] . '.' . $extension);

                    // Add the photo in the database
                    $photoUpdated = updatePhoto($_SESSION['id'], $extension, $_SESSION['id']);
                    if ($photoUpdated) {
                        header('Location: overview.php?id=' . $_SESSION['id']);
                    }
                } else {
                    $errorMessage = 'Only .jpg, .jpeg, .png and .gif extensions are allowed.';
                }
            } else {
                $errorMessage = 'The size must not surpasse 2MO.';
            }
        } else {
            $errorMessage = 'There is an error with your image.';
        }
    }
}
