<?php

// The queries file


// Check if the user exist
function isUserExist(string $email): int
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT email FROM users WHERE email = :email");
    $statement->execute([
        'email' => $email,
    ]);

    return $statement->rowCount();
}

function isThePersonIWantToChatWithExists(int $idUser): int
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT id FROM users WHERE id = :id_user");
    $statement->execute([
        'id_user' => $idUser,
    ]);

    return $statement->rowCount();
}

// Get the user informations in the table "users"
function getUserInformations(string $email): array
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT * FROM users WHERE email = :email");
    $statement->execute([
        'email' => $email,
    ]);
    return $statement->fetch();
}

// Get the profil picture
function getUserPicture(int $idUser): array
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT picture FROM user_informations WHERE id_user = :id_user");
    $statement->execute([
        'id_user' => $idUser,
    ]);
    return $statement->fetch();
}

// Check if user informations exist
function isUserInformationsExist(int $idUSer): int
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT * FROM user_informations WHERE id_user = :idUser");
    $statement->execute([
        'idUser' => $idUSer,
    ]);

    return $statement->rowCount();
}

// Create a new account
function createAccount(string $username, string $email, string $pass): bool
{
    $database = dbConnection();
    $statement = $database->prepare("INSERT INTO users(username, email, pass) VALUES(:username, :email, :pass)");
    return $statement->execute([
        'username' => $username,
        'email' => $email,
        'pass' => $pass,
    ]);
}

// Insert user informations
function createUserInformations(string $idUser): bool
{
    $database = dbConnection();
    $statement = $database->prepare("INSERT INTO user_informations(id_user) VALUES(:id_user)");
    return $statement->execute([
        'id_user' => $idUser,
    ]);
}

// Update photo
function updatePhoto(string $picture, string $extension, string $idUser): bool
{
    $database = dbConnection();
    $statement = $database->prepare("UPDATE user_informations SET picture = :picture WHERE id_user = :id_user");
    return $statement->execute([
        'picture' => $picture . '.' . $extension,
        'id_user' => $idUser,
    ]);
}

// Add user into the online's users table
function createUserOnline(int $idUser): bool
{
    $database = dbConnection();
    $statement = $database->prepare("INSERT INTO online_users(id_user) VALUES(:id_user)");
    return $statement->execute([
        'id_user' => $idUser,
    ]);
}

function getOnlineUsers(): array
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT u.id id, u.username username, u.email email, user.picture picture, o.id_user FROM users u JOIN user_informations user ON u.id = user.id_user JOIN online_users o ON u.id = o.id_user ORDER BY o.online_date DESC");
    $statement->execute();
    return $statement->fetchAll();
}

function getOnlineUser(string $idOnlineUser): array
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT u.id id, u.username username, u.email email, user.picture picture, o.id_user FROM users u JOIN user_informations user ON u.id = user.id_user JOIN online_users o ON u.id = o.id_user WHERE o.id_user = :idOnlineUser ORDER BY o.online_date DESC");
    $statement->execute([
        'idOnlineUser' => $idOnlineUser,
    ]);
    return $statement->fetch();
}

// Check if there're online users
function checkIfOnline(): int
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT * FROM online_users");
    $statement->execute();
    return $statement->rowCount();
}

// Check if there's an online user
function isOnlineUser(int $idOnlineUser): int
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT * FROM online_users WHERE id_user = :id_user");
    $statement->execute([
        'id_user' => $idOnlineUser,
    ]);
    return $statement->rowCount();
}

// Log out the user
function logout(string $idUser): bool
{
    $database = dbConnection();
    $statement = $database->prepare("DELETE FROM online_users WHERE id_user = :id_user");
    return $statement->execute([
        'id_user' => $idUser,
    ]);
}

// Count the number of online users
function countOnlineUsers(): array
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT COUNT(*) AS nbOnlineUser FROM online_users");
    $statement->execute();
    return $statement->fetch();
}

// Add a new message
function sendMessage(int $idSender, int $idReceiver, string $message): bool
{
    $database = dbConnection();
    $statement = $database->prepare("INSERT INTO messages(id_sender, id_receiver, messages, message_date) VALUES(:id_sender, :id_receiver, :messages, NOW())");
    return $statement->execute([
        'id_sender' => $idSender,
        'id_receiver' => $idReceiver,
        'messages' => $message,
    ]);
}

// Get messages
function getMessages(int $idReceiver): array
{
    $database = dbConnection();
    $statement = $database->prepare("SELECT * FROM messages WHERE id_receiver = :id_receiver");
    $statement->execute([
        'id_receiver' => $idReceiver,
    ]);
    return $statement->fetchAll();
}
function dbConnection(): PDO
{
    try {

        $database = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    } catch (Exception $e) {

        die('Erreur: ' . $e->getMessage());
    }

    return $database;
}
