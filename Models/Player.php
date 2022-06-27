<?php
declare(strict_types=1);

class Player{

    private $cards = [];
    private $lost = false;

    public function __construct(Deck $deck)
    {
        $deck->drawCard();
        $deck->drawCard();
    }

    //public function drawCard() :? Card
    //    {
    //        return array_shift($this->cards);
    //    }



    public function hit()
    {
    }
    public function surrender()
    {
    }
    public function getScore()
    {
    }
    public function hasLost()
    {
    }

}
