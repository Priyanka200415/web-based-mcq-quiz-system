<?php
session_start();
include 'qconnection.php';

// If it's the first question, reset session variables and fetch questions
if (!isset($_SESSION['questions'])) {
    $_SESSION['questions'] = [];
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;

    // Fetch 5 random questions from the quizzes table
    $sql = "SELECT * FROM quizzes WHERE language='C' AND topic='Basics' ORDER BY RAND() LIMIT 5";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $_SESSION['questions'][] = $row;
    }
}

// If all questions are answered, redirect to the results page
if ($_SESSION['current_question'] >= count($_SESSION['questions'])) {
    header("Location: result.php");
    exit();
}

// Get the current question based on the current_question index
$question = $_SESSION['questions'][$_SESSION['current_question']];

// Set the correct answer in the session so next.php can access it
$_SESSION['correct_answer'] = $question['correct_answer'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C Basics Quiz</title>
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
        .quiz-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
            text-align: center;
            width: 500px;
            color: black;
        }
        .question {
            font-size: 18px;
            margin-bottom: 20px;
        }
        /* Updated option style: grey background with hover effect */
        .option {
            display: block;
            background-color: #e0e0e0; /* light grey */
            color: black;
            padding: 12px;
            margin: 8px auto;
            border-radius: 5px;
            width: 90%;
            border: 1px solid #ccc;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            cursor: pointer;
        }
        .option:hover {
            background-color: #d0d0d0; /* slightly darker grey */
            border-color: #999;
        }
        .next-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .next-btn:hover {
            background-color: #218838;
        }
        /* Hide radio buttons */
        input[type="radio"] {
            display: none;
        }
        /* When a radio is checked, style the corresponding label */
        input[type="radio"]:checked + label {
            background-color: #b0d6a5;
            border-color: #6aa84f;
        }
    </style>
</head>
<body>

<div class="quiz-container">
    <h2>C Basics Quiz</h2>
    <form action="next.php" method="POST">
        <p class="question"><?php echo $question['question']; ?></p>
        <!-- Using labels for clickable grey option boxes -->
        <div>
            <input type="radio" id="opt1" name="answer" value="option1" required>
            <label class="option" for="opt1"><?php echo $question['option1']; ?></label>
        </div>
        <div>
            <input type="radio" id="opt2" name="answer" value="option2">
            <label class="option" for="opt2"><?php echo $question['option2']; ?></label>
        </div>
        <div>
            <input type="radio" id="opt3" name="answer" value="option3">
            <label class="option" for="opt3"><?php echo $question['option3']; ?></label>
        </div>
        <div>
            <input type="radio" id="opt4" name="answer" value="option4">
            <label class="option" for="opt4"><?php echo $question['option4']; ?></label>
        </div>
        <button type="submit" class="next-btn">Next Question</button>
    </form>
</div>

</body>
</html>