<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/welcome/photo.css">
    <title>Welcome to Minichat</title>
</head>

<body>
    <?php if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) : ?>

        <?php
            require_once('../../back/welcome/photo.php');
        ?>
        <!-- The main page -->
        <main id="container">
            <header>
                <img src="../icons/solid/user-circle.svg" alt="The user icon" width="100" height="100">
                <h1>Welcome to Minichat, <?= $_SESSION['username']; ?> !</h1>
                <p>Choose a profil picture to make it easier for your chatting friends to recognize you.</p>
            </header>
            <article>
                <form action="photo.php?id=<?= urlencode($_SESSION['id']); ?>" method="post" enctype="multipart/form-data">
                    <?php if(isset($errorMessage)): ?>
                        <fieldset class="error">
                            <?= $errorMessage; ?>
                        </fieldset>
                    <?php endif; ?>
                    <fieldset>
                        <label for="picture">Choose a profil picture:</label><br>
                        <input type="file" name="picture" id="picture">
                    </fieldset>
                    <fieldset>
                        <button type="submit" name="submit">See an overview</button>
                    </fieldset>
                </form>
            </article>
        </main>
    <?php else: ?>
        <p>Session expired, please <a href="">Log in again</a></p>
    <?php endif; ?>
    <footer>
        <small>Minichat 2023 - All Right Reserved | Highly build by <a href="https://www.facebook.com/nathanlefuturmillionaire" title="See the creator's facebook page" target="_blank">Nathan le futur millionaire</a> </small>
    </footer>
</body>

</html>