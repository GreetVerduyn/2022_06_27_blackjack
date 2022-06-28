<?php
declare(strict_types=1);

class Player{

    private $cards = [];
    private $lost = false;
    private const MAX_SCORE = 21;

    public function __construct(Deck $deck)
    {
        array_push($this->cards, $deck->drawCard());
        array_push($this->cards, $deck->drawCard());
     }

    public function getScore(): int
    {
        $score = 0;
        foreach ($this->cards as $card) {
            $score += $card->getValue();
        }

        return $score;
    }

    public function hit(Deck $deck): void
    {
        array_push($this->cards, $deck->drawCard());

        if ($this->getScore() > self::MAX_SCORE) {
            $this->lost = true;
        }
    }

    public function surrender(): void
    {
        $this->lost = true;
    }

    public function hasLost(): bool
    {
        return $this->lost;
    }

    public function getCards(): array {
        return $this->cards;
    }

}
class Dealer extends Player {

    public function hit(Deck $deck): void
    {
        if ($this->getScore() < 14) {
            parent::hit($deck);
        }
    }
}
