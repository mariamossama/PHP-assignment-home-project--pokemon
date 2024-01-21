<?php

class User {
    private $id;
    private $username;
    private $email;
    private $password; 
    private $isAdmin;
    private $cards; 
    private $balance; 

    public function __construct($id, $username, $email, $password, $isAdmin = false, $cards = [], $balance = 0) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password; 
        $this->isAdmin = $isAdmin;
        $this->cards = $cards;
        $this->balance = $balance;
    }

    
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

   
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password; 
    }

    public function setCards($cards) {
        $this->cards = $cards;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
    }

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

    public function purchaseCard($card, $cardPrice) {
        if ($this->balance >= $cardPrice && !in_array($card->getId(), $this->cards)) {
            $this->balance -= $cardPrice;
            $this->addCard($card->getId());
        }
    }

}

?>
