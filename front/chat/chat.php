<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/chat/chat.css">
    <title>Document</title>
</head>

<body>
    <?php

    // Including some files
    require_once('../../back/queries/queries.php');
    require_once('../../back/chat/chat.php');

    if (isset($_GET['chatWith']) && $_GET['chatWith'] !== '') {
        $_GET['chatWith'] = (int) $_GET['chatWith'];
        $idChatter = strip_tags($_GET['chatWith']);
        $messages = getMessages($idChatter);
        // Check if the session is open
        if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
            // Check if the user currently online exists
            if (isUserExist($_SESSION['email']) == 1) {
                // Check if the person which who the current online user wants to chat with exists
                if (isThePersonIWantToChatWithExists($idChatter) == 1) {
                    if ($_SESSION['id'] == $idChatter) {
                        // echo "No you can't chat with yourself.";
                        header('Location: chatbox.php');
                    } else {
                        // Check if the user we want to chat with is online
                        $isTheUserWithWantoChatWithOnline = isOnlineUser($idChatter);
                        if ($isTheUserWithWantoChatWithOnline == 1) {
    ?>
                            <h1 style="text-align:center;">
                                Minichat <br>
                                <a href="../../back/auth/logout.php" style="font-size:0.6em;">Log out</a>
                            </h1>
                            <main id="container">
                                <header>
                                    <?php $online = getOnlineUser($idChatter); ?>
                                    <a href="" class="link">
                                        <div class="panel">
                                            <div class="photo">
                                                <?php
                                                if ($online['picture'] == null) {
                                                ?>
                                                    <img src="../icons/solid/user-circle.svg" alt="Avatar" width="65" height="65">
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="../profil/picture/<?= $online['picture']; ?>" alt="Profil picture" width="65" height="65" style="border-radius:50%;border:2px solid #ff284d;object-fit:cover;">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="informations">
                                                <h3><?= strip_tags($online['username']); ?></h3>
                                                <h4><?= strip_tags($online['email']); ?></h4>
                                                <h5>Online</h5>
                                            </div>
                                        </div>
                                    </a>
                                </header>
                                <section>
                                    <article class="message">
                                        <?php foreach ($messages as $message) : ?>
                                            <p><?= strip_tags($message['messages']); ?></p>
                                        <?php endforeach; ?>
                                    </article>
                                </section>
                                <footer>
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                        <fieldset>
                                            <input type="text" name="message" id="message" placeholder="Type message...">
                                        </fieldset>
                                        <fieldset>
                                            <button type="submit" name="submit">Send</button>
                                        </fieldset>
                                    </form>
                                </footer>
                            </main>
    <?php
                        } else {
                            header('Location: chatbox.php');
                        }
                    }
                } else {
                    echo 'The user you want to chat with doesn\'t exist.';
                }
            } else {
                echo 'This account doesn\'t exist, please <a href="../auth/enroll.php">create an account</a>';
            }
        } else {
            header('Location: ../auth/login.php');
        }
    } else {
        echo 'The id is missing in the url.';
        return;
    }
    ?>
</body>

</html>