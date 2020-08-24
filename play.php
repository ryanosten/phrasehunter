<?php
require 'inc/Game.php';
require 'inc/Phrase.php';

session_start();

if(!isset($_SESSION['selected'])){
    $_SESSION['selected'] = [];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);
    $_SESSION['phrase'] = filter_input(INPUT_POST, 'phrase', FILTER_SANITIZE_STRING);

    $_SESSION['selected'][] = $key;
}

$_SESSION['phrase'] = "You dont know jack";

$phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
$game = new Game($phrase);

var_dump($_SESSION['selected']);


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
    <?= $phrase->addPhraseToDisplay(); ?>
</div>
<?= $game->displayKeyboard(); ?>
<?= $game->displayScore() ;?>

</body>
</html>

