<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/chat/chatbox.css">
    <title>Minichat - Chatbox</title>
</head>

<body>
    <?php
    require_once('../../back/queries/queries.php');
    // Call the function that counts the number of online users
    $nbOnlineUsers = countOnlineUsers();
    // If the session exists, continue, otherwise, redirect to the login page
    if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) {
    ?>
        <h1 style="text-align:center;">
            Minichat <br>
            <a href="../../back/auth/logout.php" style="font-size:0.6em;">Log out</a>
        </h1>
        <main id="container">
            <header>
                <h1>Who to chat with?</h1>
                <p>Choose people you would like to chat with. <?= $_SESSION['id']; ?></p>
            </header>
            <section style="padding:10px;">
                <h2 style="margin-bottom: 0;">Online users</h2>
                <small>
                    <?php
                        if($nbOnlineUsers['nbOnlineUser'] <= 1) {
                            echo 'There is ' . '<strong>' . $nbOnlineUsers['nbOnlineUser'] . '</strong> online user.';
                        } else {
                            echo 'There are ' . '<strong>' . $nbOnlineUsers['nbOnlineUser'] . '</strong> online users.';
                        }
                    ?>
                </small>
                <?php
                $onlines = getOnlineUsers();
                $checkIfOnline = checkIfOnline();

                if($checkIfOnline > 0) {
                    foreach ($onlines as $online) {
                        if ($_SESSION['id'] != $online['id']) {
                    ?>
                            <a href="chat.php?chatWith=<?= urlencode($online['id']); ?>" class="link">
                                <div class="panel">
                                    <div class="photo">
                                        <?php
                                            if($online['picture'] == null) {
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
                    <?php
                        }
                    }
                } else {
                    // Add actual user in the online users
                    createUserOnline($_SESSION['id']);
                    echo 'There\'s no online users.';
                }
                ?>
            </section>
        </main>
    <?php
    } else {
        header('Location: ../auth/login.php');
    }
    ?>
</body>

</html>