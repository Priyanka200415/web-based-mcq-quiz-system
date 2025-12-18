<?php
session_start();
include 'qconnection.php';

$currentTopic = "Python OOP";
if (!isset($_SESSION['topic']) || $_SESSION['topic'] != $currentTopic) {
    $_SESSION['questions'] = [];
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['topic'] = $currentTopic;
    
    // Fetch 5 random questions for Python OOP (language: Python)
    $sql = "SELECT * FROM quizzes WHERE language='Python' AND topic='Python OOP' ORDER BY RAND() LIMIT 5";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
         $_SESSION['questions'][] = $row;
    }
}

if ($_SESSION['current_question'] >= count($_SESSION['questions'])){
    header("Location: result.php");
    exit();
}

$question = $_SESSION['questions'][$_SESSION['current_question']];
$_SESSION['correct_answer'] = $question['correct_answer'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Python OOP Quiz</title>
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
    .option {
      display: block;
      background-color: #e0e0e0;
      color: black;
      padding: 12px;
      margin: 8px auto;
      border-radius: 5px;
      width: 90%;
      border: 1px solid #ccc;
      transition: background-color 0.3s, border-color 0.3s;
      cursor: pointer;
    }
    .option:hover {
      background-color: #d0d0d0;
      border-color: #999;
    }
    input[type="radio"] {
      display: none;
    }
    input[type="radio"]:checked + label {
      background-color: #b0d6a5;
      border-color: #6aa84f;
    }
    .next-btn {
      margin-top: 20px;
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .next-btn:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="quiz-container">
    <h2>Python OOP Quiz</h2>
    <form action="next.php" method="POST">
      <p class="question"><?php echo $question['question']; ?></p>
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