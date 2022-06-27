<?php
declare(strict_types=1);

class Player{

    private $cards = [];
    private $lost = false;

    public function __construct(Deck $deck)
    {   array_push($this->cards, $deck->drawCard());
        array_push($this->cards, $deck->drawCard());
     }


    public function getScore(): int
    { $score = 0;
        foreach ($this->cards AS $card)
         { $score += $card->getValue();}

        return $score;
    }

    public function hit()
    {
    }
    public function surrender()
    {
    }

    public function hasLost()
    {
    }

}
