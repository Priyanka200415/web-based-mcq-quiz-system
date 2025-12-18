<?php
session_start();
include 'qconnection.php';

// Debugging: Print the session topic
echo "Current Topic: " . (isset($_SESSION['topic']) ? $_SESSION['topic'] : "Not Set") . "<br>";

// Check if an answer was selected
if (!isset($_POST['answer'])) {
    echo "No answer selected!<br>";
    exit();
}

// Initialize score if not set
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

// Compare selected answer with the correct one
if ($_POST['answer'] === $_SESSION['correct_answer']) {
    $_SESSION['score']++; // Increment score if correct
}

// Move to next question
$_SESSION['current_question']++;

// Redirect based on the topic stored in session
// Redirect to the correct topic-based page
if (isset($_SESSION['topic'])) {
    switch ($_SESSION['topic']) {
        case 'Basics':
            header("Location: cbasics.php");
            break;
        case 'Pointers':
            header("Location: cpointers.php");
            break;
        case 'Data Structures':
            header("Location: cdata.php");
            break;
        case 'Java Basics':
            header("Location: javabasics.php");
            break;
        case 'OOP':
            header("Location: javaoop.php");
            break;
        case 'Advanced':
            header("Location: javaadvanced.php");
            break;
        case 'Python Basics':
            header("Location: pythonbasics.php");
            break;
        case 'Python OOP':
            header("Location: pythonoop.php");
            break;
        case 'Python Advanced':
            header("Location: pythonadvanced.php");
            break;
        default:
            header("Location: index.php"); // Default fallback
    }
} else {
    header("Location: index.php");
}

  exit();

?>
