<?php
$message = $message ?? "An unknown error occurred.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff3f3;
            color: #333;
            padding: 2rem;
        }
        .error-container {
            border: 1px solid #ff6b6b;
            background: #ffecec;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 50px auto;
        }
        h1 {
            color: #c0392b;
        }
    </style>
</head>
<body>
<div class="error-container">
    <h1>Error</h1>
    <p><?= htmlspecialchars($message) ?></p>
<a href="/index.php">Back to Home</a>
</div>
</body>
</html>
