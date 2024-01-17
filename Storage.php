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
}
?>
