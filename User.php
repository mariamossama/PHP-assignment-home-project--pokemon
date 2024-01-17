<?php

class User {
    private $id;
    private $username;
    private $email;
    private $password; // Store hashed passwords
    private $isAdmin;
    private $cards; // Array of card IDs owned by the user
    private $balance; // User's balance to buy cards

    public function __construct($id, $username, $email, $password, $isAdmin = false, $cards = [], $balance = 0) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password; // Ensure this is hashed
        $this->isAdmin = $isAdmin;
        $this->cards = $cards;
        $this->balance = $balance;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isAdmin() {
        return $this->isAdmin;
    }

    public function getCards() {
        return $this->cards;
    }

    public function getBalance() {
        return $this->balance;
    }

    // Setters
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password; // Remember to hash the password
    }

    public function setCards($cards) {
        $this->cards = $cards;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
    }

    // Add or remove a card from the user's collection
    public function addCard($cardId) {
        if (!in_array($cardId, $this->cards)) {
            $this->cards[] = $cardId;
        }
    }

    public function removeCard($cardId) {
        $this->cards = array_filter($this->cards, function($cId) use ($cardId) {
            return $cId != $cardId;
        });
    }

    // Method to purchase a card
    public function purchaseCard($card, $cardPrice) {
        if ($this->balance >= $cardPrice && !in_array($card->getId(), $this->cards)) {
            $this->balance -= $cardPrice;
            $this->addCard($card->getId());
        }
    }

    // Other methods as needed for your application
}

?>
