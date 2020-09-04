<?php
require 'inc/Game.php';
require 'inc/Phrase.php';

session_start();

if (isset($_POST['start'])){
 session_destroy();
 header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] . '/play.php');
}

if(!isset($_SESSION['selected'])){
    $_SESSION['selected'] = [];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);
//    $_SESSION['phrase'] = filter_input(INPUT_POST, 'phrase', FILTER_SANITIZE_STRING);

    $_SESSION['selected'][] = $key;
}

//isn't it odd to instantiate the Phrase and Game instances every time this page loads?
if (!isset($_SESSION['phrase'])){
    $phrase = new Phrase(null, $_SESSION['selected']);
} else {
    $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
}
$game = new Game($phrase);

$_SESSION['phrase'] = $phrase->getCurrentPhrase();

$game->calculateLives();
$game->checkForLose();
//var_dump($game->checkForLose());



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    <h2 class="header">Phrase Hunter</h2>
    <?php
    if (!$game->gameOver()) {
        echo $phrase->addPhraseToDisplay();
        echo '</div>';
        echo'<p class="helper">Click a button or type on your keyboard</p>';
        echo $game->displayKeyboard();
        echo $game->displayScore();
    } else {
        ?>


    <?= $game->gameOver(); ?>
    <form action="play.php" method="post">
        <input id="btn__reset" type="submit" name="start" value="Play Again" />
    </form>
    <?php
    }
    ?>

    <script src="scripts.js"></script>
</body>
</html>

