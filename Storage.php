<?php
class Storage {
    private $usersFile;
    private $cardsFile;

    public function __construct($usersFile, $cardsFile) {
        $this->usersFile = $usersFile;
        $this->cardsFile = $cardsFile;
    }

    public function getAllCards() {
        $cards = json_decode(file_get_contents($this->cardsFile), true);
        return $cards ?: [];
    }

    public function addCard($newCard) {
        $cards = $this->getAllCards();

        $nextId = 0;
        while (isset($cards["card" . $nextId])) {
            $nextId++;
        }

        $cards["card" . $nextId] = $newCard;

        file_put_contents($this->cardsFile, json_encode($cards, JSON_PRETTY_PRINT));
    }
}
?>
