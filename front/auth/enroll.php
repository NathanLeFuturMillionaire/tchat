<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth/enroll.css">
    <title>MiniChat - The chat app</title>
</head>

<body>
    <!-- Include the back-end file -->
    <?php require_once('../../back/auth/enroll.php'); ?>
    <?php
    // Check if a session exists
    if (isset($_SESSION['id'])) {
        require_once('../../back/queries/queries.php');

        $userPicture = getUserPicture($_SESSION['id']);
        // Check if the user set a profil
        // If not, redirect him to the welcoming page
        if ($userPicture['picture'] == null) {
            header('Location: ../welcome/welcome.php');
        } else {
            header('Location: ../chat/chat.php');
        }
    } else {
    ?>
        <main id="container">
            <header>
                <img src="../icons/solid/user-circle.svg" alt="The user icon" width="100" height="100">
                <h1>Create an account</h1>
            </header>
            <article>
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <?php if (isset($errorMessage)) : ?>
                        <fieldset class="error">
                            <?= $errorMessage; ?>
                        </fieldset>
                    <?php elseif (isset($successMessage)) : ?>
                        <fieldset class="success">
                            <?= $successMessage; ?>
                        </fieldset>
                    <?php endif; ?>
                    <fieldset>
                        <label for="username">Username:</label><br>
                        <input value="<?php if (isset($post['username'])) {
                                            echo strip_tags($post['username']);
                                        } ?>" type="text" name="username" id="username" placeholder="Username">
                    </fieldset>
                    <fieldset>
                        <label for="email">Email address:</label><br>
                        <input value="<?php if (isset($post['email'])) {
                                            echo strip_tags($post['email']);
                                        } ?>" type="text" name="email" id="email" placeholder="Your email address">
                    </fieldset>
                    <fieldset>
                        <label for="password">Password:</label><br>
                        <input type="password" name="password" id="password" placeholder="Use a strong password">
                    </fieldset>
                    <fieldset>
                        <button type="submit" name="submit" title="Create an account">Create an account</button>
                    </fieldset>
                    <fieldset style="text-align: center;">
                        <a href="login.php" style="text-decoration: none;">I have an account</a>
                    </fieldset>
                </form>
            </article>
        </main>
    <?php
    }
    ?>
    <footer>
        <small>Minichat 2023 - All Right Reserved | Highly build by <a href="https://www.facebook.com/nathanlefuturmillionaire" title="See the creator's facebook page" target="_blank">Nathan le futur millionaire</a> </small>
    </footer>
</body>

</html>