<?php
session_start();
$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$total = isset($_SESSION['questions']) ? count($_SESSION['questions']) : 5; // Default 5

// Destroy session AFTER fetching score
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <style>
        body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
        }

        .result-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 300px;
            color: black;
        }

        .score {
            font-size: 20px;
            font-weight: bold;
        }

        .restart-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }

        .restart-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="result-container">
    <h2>Quiz Completed!</h2>
    <p class="score">Your Score: <?php echo $score; ?> / <?php echo $total; ?></p>
    <a href="cbasics.php"><button class="restart-btn">Try Again</button></a>
</div>

</body>
</html>