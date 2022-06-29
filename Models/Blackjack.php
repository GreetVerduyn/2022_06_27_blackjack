<?php
declare(strict_types=1);


class Blackjack{

    private Player $player;
    private Dealer $dealer;
    private Deck $deck;


    public function __construct(){
        $this->deck = new Deck();
        $this->deck->shuffle();
        $this->player = new Player($this->deck);
        $this->dealer = new Dealer($this->deck);

    }


    /**
     * @return Player
     */
    public function getPlayer(): Player {
        return $this->player;
    }
    /**
     * @return Dealer
     */
    public function getDealer(): Dealer {
        return $this->dealer;
    }
    /**
     * @return Deck
     */
    public function getDeck(): Deck {
        return $this->deck;
    }


    public function winner (): string {
        if ($this->getPlayer()->hasLost()){
            return 'dealer';
        }
        if ($this->getDealer()->hasLost()){
            return 'player';
        }
        if ($this->getPlayer()->getScore() <= 21 && $this->getPlayer()->getScore() > $this->getDealer()->getScore()){
            return 'player';
        }
        return 'dealer';
    }

}
