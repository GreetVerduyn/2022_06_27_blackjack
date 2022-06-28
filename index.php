<?php

require_once('./Models/Suit.php');
require_once('./Models/Card.php');
require_once('./Models/Deck.php');
require_once ('./Models/Player.php');
require_once ('./Models/Dealer.php');
require_once ('./Models/Blackjack.php');

session_start();
if (!isset($_SESSION['game'])) {
    $_SESSION['game']=new Blackjack();
}


//var_dump($game);

?>


<?php
if(isset($_POST['hit_button'])){
    $_SESSION['game']->getPlayer()->hit($_SESSION['game']->getDeck());
}
if(isset($_POST['stand_button'])) {
    $_SESSION['game']->getDealer()->hit($_SESSION['game']->getDeck());
}

if(isset($_POST['surrender_button'])) {
    $_SESSION['game']->getPlayer()->surrender();
}

if(isset($_POST['playAgain_button'])) {
    session_unset();
    $game = new Blackjack();
    $_SESSION['game']=$game;
}


var_dump ( $_SESSION['game']->getPlayer()->getCards());

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Blackjack</title>
</head>
<body>
<div>
    <div class="player">
        <h2>Player</h2>
        <p>"Your current score is "</p>
        <p>
            <?php
            echo $_SESSION['game']->getPlayer()->getScore();
            if ($_SESSION['game']->getPlayer()->hasLost()){
                echo '<br/>';
                echo 'You Lose';
            };
            ?>
        </p>
    </div>
    <div>
        <h2>Dealer</h2>
        <p></p>
        <p>
            <?php
            echo $_SESSION['game']->getDealer()->getScore();
            if ($_SESSION['game']->getDealer()->hasLost()){
                echo '<br/>';
                echo 'You Lose';
            };
            ?>
        </p>
    </div>
</div>


<form method="post">
    <button type="submit" name="hit_button" <?php if ($_SESSION['game']->getPlayer()->hasLost()) { echo 'disabled';} ?>
           class="button" value="Button1">hit</button>
    <button type="submit" name="stand_button"
           class="button" value="Button2">stand</button>
    <button type="submit" name="surrender_button"
           class="button" value="Button3">surrender</button>
    <button type="submit" name="playAgain_button"
           class="button" value="Button4">play again</button>
</form>





</body>
</html>

