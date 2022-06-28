<?php

require_once('./Models/Suit.php');
require_once('./Models/Card.php');
require_once('./Models/Deck.php');
require_once ('./Models/Player.php');
require_once ('./Models/Dealer.php');
require_once ('./Models/Blackjack.php');

session_start();
$game=new Blackjack();
$_SESSION['game']=$game;

//var_dump($game);

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Blackjack</title>
</head>
<body>


<form method="post">
    <button type="submit" name="hit_button"
           class="button" value="Button1">hit</button>
    <button type="submit" name="stand_button"
           class="button" value="Button2">stand</button>
    <button type="submit" name="surrender_button"
           class="button" value="Button3">surrender</button>
    <button type="submit" name="playAgain_button"
           class="button" value="Button4">play again</button>
</form>


<?php
if(isset($_POST['hit_button'])){
    $_SESSION['game']->getPlayer()->hit($_SESSION['game']->getDeck());
}
if(isset($_POST['stand_button'])) {
//$game->getPlayer()->
}

if(isset($_POST['surrender_button'])) {
    $_SESSION['game']->getPlayer()->surrender();
}

if(isset($_POST['playAgain_button'])) {
    session_unset();
    $game = new Blackjack();
    $_SESSION['game']=$game;
}

var_dump ( $_SESSION['game']->getPlayer()->getScore());
var_dump ( $_SESSION['game']->getPlayer()->getCards());

?>


</body>
</html>

