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


//var_dump($_SESSION['game']);

?>


<?php
if(isset($_POST['hit_button'])){
    $_SESSION['game']->getPlayer()->hit($_SESSION['game']->getDeck());
}
if(isset($_POST['stand_button'])) {
    $_SESSION['game']->getDealer()->hitD($_SESSION['game']->getDeck(), $_SESSION['game']->getPlayer()->getScore());
    $winner = $_SESSION['game']->Winner();
}

if(isset($_POST['surrender_button'])) {
    $_SESSION['game']->getPlayer()->surrender();
}

if(isset($_POST['playAgain_button'])) {
    session_unset();
    $game = new Blackjack();
    $_SESSION['game']=$game;
}

//var_dump ($_SESSION['game']->getPlayer()->getCards());

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Blackjack</title>
</head>
<body>
<div class="game flex-container">
    <div class="player">
        <h2>Player</h2>
        <p>Your current score is: </p>
        <p>
            <?php
            echo $_SESSION['game']->getPlayer()->getScore();
            echo '<br/>';
            ?>
        </p>
        <div><?php
            foreach ($_SESSION['game']->getPlayer()->getCards() as $index => $value):?>
                <span class="cards"> <?= $value->getUnicodeCharacter() ?></span>

            <?php
            endforeach
            ?>
        </div>
    </div>

    <div class="dealer">
        <h2>Dealer</h2>
        <div><?php
            if (isset($_POST['stand_button'])) {?>
                <p>Dealers score is: </p>
                <?php echo $_SESSION['game']->getDealer()->getScore();
            }?>
        </div>
        <div>
            <p> <?php
                if (isset($_POST['stand_button'])) {

                    foreach ($_SESSION['game']->getDealer()->getCards() as $index => $value){?>
                        <span class="cards"> <?= $value->getUnicodeCharacter() ?> </span>
                        <?php
                    }
                }else {?>
                    <span class="cards"> <?= $_SESSION['game']->getDealer()->getCards()[0]->getUnicodeCharacter() ?></span>
                    <?php
                }
                ?>
            </p>
        </div>
       <!--<div>
         //   <h1>
          //     <?php
          //   if (isset($_POST['stand_button']) && ($_SESSION['game']->getDealer()->hasLost())) {
          //     echo '<br/>';
          //          echo 'Dealer lost';
          //      }
                ?>
          //  </h1>
       //</div>-->

    </div>




</div>
<div class="text">
    <p>
        <?php
        if ($_SESSION['game']->getPlayer()->getScore() === 21) {
            echo '<br/>';
            echo '<h1>You Win</h1>';
        } else if ($_SESSION['game']->getPlayer()->hasLost()) {
            echo '<br/>';
            echo 'You Lose, dealer Wins';
        }
        if (isset($_POST['stand_button'])) {
            if ($_SESSION['game']->winner() != null) {
                echo $_SESSION['game']->winner() . ' wins the game.';
            }
        }
        ?>
    </p>
</div>

<div class="buttons">
    <form method="post" class="selectionForm">
        <button type="submit" name="hit_button" <?php if (isset($_POST['stand_button']) || $_SESSION['game']->getPlayer()->hasLost() || $_SESSION['game']->getPlayer()->getScore()>=21) { echo 'disabled';} ?>
                class="button" value="Button1">hit</button>
        <button type="submit" name="stand_button" <?php if ($_SESSION['game']->getPlayer()->getScore()>=21) { echo 'disabled';} ?>
                class="button" value="Button2">stand</button>
        <button type="submit" name="surrender_button"
                class="button" value="Button3">surrender</button>
        <button type="submit" name="playAgain_button"
                class="button" value="Button4">play again</button>
    </form>
</div>






</body>
</html>
