<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/welcome/overview.css">
    <title>Welcome to Minichat</title>
</head>

<body>
    <?php if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) : ?>
        <?php
        require_once('../../back/queries/queries.php');
        $userPicture = getUserPicture($_SESSION['id']);
        $user = getUserInformations($_SESSION['email']);
        if ($_SESSION['id'] == $_GET['id']) {
        ?>
            <!-- The main page -->
            <main id="container">
                <header>
                    <?php if($userPicture['picture'] == null): ?>
                        <img src="../icons/solid/user-circle.svg" alt="The user icon" width="100" height="100">
                    <?php else: ?>
                        <img src="../profil/picture/<?= $userPicture['picture']; ?>" alt="User profil picture" class="profilPicture">
                    <?php endif; ?>
                    <h1>Welcome to Minichat, <?= $_SESSION['username']; ?> !</h1>
                    <p>Now you ended up with your photo, you can start chatting.</p>
                </header>
                <article>
                    <form action="../chat/chatbox.php" method="post">
                        <fieldset>
                            <button type="submit" name="submit" title="Start chatting">Start chatting</button>
                        </fieldset>
                    </form>
                </article>
            </main>
        <?php
        } else {
            echo 'Id is missing in the url.';
            return;
        }
        ?>
    <?php else : ?>
        <p>Session expired, please <a href="">Log in again</a></p>
    <?php endif; ?>
    <footer>
        <small>Minichat 2023 - All Right Reserved | Highly build by <a href="https://www.facebook.com/nathanlefuturmillionaire" title="See the creator's facebook page" target="_blank">Nathan le futur millionaire</a> </small>
    </footer>
</body>

</html>