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

    // Add more methods as needed
    public function addCard($newCard) {
        $cards = $this->getAllCards();

        // Find the next available card ID
        $nextId = 0;
        while (isset($cards["card" . $nextId])) {
            $nextId++;
        }

        // Assign the new card ID
        $cards["card" . $nextId] = $newCard;

        file_put_contents($this->cardsFile, json_encode($cards, JSON_PRETTY_PRINT));
    }
}
?>
