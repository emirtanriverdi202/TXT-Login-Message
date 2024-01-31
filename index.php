<?php
if (isset($_COOKIE['username']) || isset($_COOKIE['userNumber'])) {
    header('Location: message');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>TXT register and message system</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Registration part
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $userList = file_get_contents('users.txt');
    if (strpos($userList, $username) === false) {
        $userNumber = rand(1000, 9999);
        $userList .= "$username:$userNumber\n";
        file_put_contents('users.txt', $userList);
        setcookie('username', $username, time() + 86400, '/');
        setcookie('userNumber', $userNumber, time() + 86400, '/');
        echo "Registration successful! Your username: $username, Your number: $userNumber <a href='message'>Write a message</a>";
    } else {
        echo "This username has already been used!";
    }
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>