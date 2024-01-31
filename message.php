<?php
if (!isset($_COOKIE['username']) || !isset($_COOKIE['userNumber'])) {
    header('Location: ./');
    exit;
}
$username = $_COOKIE['username'];
$userNumber = $_COOKIE['userNumber'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $messageList = file_get_contents('messages.txt');
    $messageList .= "$userNumber:$username:$message\n";
    file_put_contents('messages.txt', $messageList);
}
$messageList = file_get_contents('messages.txt');
$lines = explode("\n", $messageList);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Message writing system</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Mesajlar
                    </div>
                    <div class="card-body">
                        <p>Howdy, <?php echo $username; ?>!</p>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <input type="text" class="form-control" id="message" name="message" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                        <hr>
                        <h5>Messages:</h5>
                        <?php
                        foreach ($lines as $line) {
                            if (!empty($line)) {
                                list($userNum, $messageUsername, $userMessage) = explode(':', $line);
                                echo "<p>$messageUsername: $userMessage</p>";
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