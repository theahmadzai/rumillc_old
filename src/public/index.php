<?php
session_start();
error_reporting(1);

require '../app/app.php';

$db = new mysqli('127.0.0.1', 'root', '', 'rumillc');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$app = new App();
$app->basePath('immortal/rumillc/src/public/');
$app->viewsPath('../app/views/');

$app->map('/', function ($params) use ($app, $db) {
    $query = $db->query("SELECT news FROM news WHERE active='1' LIMIT 1");

    if ($query->num_rows > 0) {
        $news = $query->fetch_all(MYSQLI_ASSOC);
        $app->render('home', $news[0]);
    } else {
        $app->render('home');
    }
});

$app->map('/products', function ($params) use ($app) {
    $app->render('products');
});

$app->map('/about', function ($params) use ($app) {
    $app->render('about');
});

$app->map('/contact', function ($params, $method, $data) use ($app) {
    if ($method == 'POST') {

        $response = [];
        extract($data);

        if (empty($fullname) || empty($email) || empty($subject) || empty($message)) {
            $response['error'][] = 'Please fill all the fields!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['error'][] = 'Invalid email address.';
        } else {
            $headers = [
                'MIME-Version: 1.0',
                'Content-type: text/html; charset=iso-8859-1',
                'From: ' . htmlspecialchars($fullname) . " <$email>",
            ];

            $send = mail('info@rumillc.com',
                htmlspecialchars($subject),
                nl2br(htmlspecialchars($message)),
                implode("\r\n", $headers)
            );

            if (!$send) {
                $response['error'][] = 'Service down, Please try later';
            } else {
                $response['success'][] = 'Email successfully sent!';
            }
        }
        echo json_encode($response);

    } else {
        $app->render('contact');
    }
});

$app->map('/admin', function ($params, $method, $data) use ($app, $db) {
    if (!isset($_SESSION['username'])) {
        $app->render('admin/login');
    }

    if ($method == 'POST') {
        if (!empty($data['activate'])) {
            $id      = $data['activate'];
            $user    = $_SESSION['username'];
            $updated = date("Y-m-d H:i:s");
            $query   = $db->query("UPDATE news SET active = 0 WHERE active = 1");
            $query   = $db->query("UPDATE
                news SET
                    username = '$user',
                    updated_at = '$updated',
                    active = 1
                WHERE id =$id");
            echo "Successfully Activated <b>{$id}</b>";exit;

        } elseif (!empty($data['remove'])) {
            $id    = $data['remove'];
            $query = $db->query("DELETE FROM news WHERE id = $id");
            echo "Successfully Deleted <b>{$id}</b>";exit;

        } elseif (!empty($data['update'])) {
            $username = $_SESSION['username'];
            $update   = htmlspecialchars($data['update']);

            $query = $db->prepare("INSERT INTO news (username,news) VALUES (?, ?)");
            $query->bind_param("ss", $username, $update);
            if ($query->execute()) {
                echo "Successfully added update! Please press f5";exit;
                $query->close();
            }
            echo "Please try later";exit;
        } else {
            echo "<b>Error: </b> Please insert value or press f5!";exit;
        }
    }

    $username = $_SESSION['username'];
    $query    = $db->query("SELECT * FROM admins WHERE username='$username'");

    if (!$query->num_rows > 0) {
        $app->render('admin/login', 'Session expired, Please re-login.');
    }
    $result = $query->fetch_assoc();

    $app->render('admin/home', $result, $db);
});

$app->map('/admin/login', function ($params, $method, $data) use ($app, $db) {
    if (isset($_SESSION['username'])) {
        $app->redirect('/admin');
    }

    if ($method == 'POST') {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $response[] = [];

        $response['message'] = 'Please fill all the fields!';
        if (!empty($email) && !empty($password)) {

            $query = $db->query("SELECT username FROM admins WHERE email='$email' AND password='$password'");

            if ($query->num_rows > 0) {
                $result               = $query->fetch_assoc();
                $_SESSION['username'] = $result['username'];
                $app->redirect('/admin');
            }
            $response['message'] = 'Incorrect username or password!';
        }
        $app->render('admin/login', $response);
    } else {
        $app->render('admin/login');
    }
});

$app->map('/test', function ($params) use ($app) {
    $app->render('slider');
});

$app->dispatch();
