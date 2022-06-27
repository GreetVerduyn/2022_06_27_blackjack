<?php
declare(strict_types=1);


class Blackjack{

    private $player = new Player()
    private $dealer = new Player();
    private $deck = new Deck();

    public function getPlayer(){
        return $this->player;
        }

    public function getDealer(){
        return $this->dealer;
        }

    public function getDeck(){
        return $this->deck;
        }


    }

}