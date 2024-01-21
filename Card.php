<?php

class Card {
    private $id;
    private $name;
    private $hp;
    private $element;
    private $attack;
    private $defense;
    private $price;
    private $description;
    private $image;
    private $ownerId;

    public function __construct($id, $name, $hp, $element, $attack, $defense, $price, $description, $image, $ownerId = null) {
        $this->id = $id;
        $this->name = $name;
        $this->hp = $hp;
        $this->element = $element;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->ownerId = $ownerId;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getHP() {
        return $this->hp;
    }

    public function getElement() {
        return $this->element;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->image;
    }

    public function getOwnerId() {
        return $this->ownerId;
    }


    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
    }

}

?>
