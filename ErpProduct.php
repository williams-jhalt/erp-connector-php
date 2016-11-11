<?php

namespace Williams\Erp;

class ErpProduct {

    protected $itemNumber;
    protected $name;
    protected $binLocation;
    protected $committedQuantity;
    protected $onHandQuantity;
    protected $price;

    public function getItemNumber() {
        return $this->itemNumber;
    }

    public function getName() {
        return $this->name;
    }

    public function getBinLocation() {
        return $this->binLocation;
    }

    public function getCommittedQuantity() {
        return $this->committedQuantity;
    }

    public function getOnHandQuantity() {
        return $this->onHandQuantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setItemNumber($itemNumber) {
        $this->itemNumber = $itemNumber;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setBinLocation($binLocation) {
        $this->binLocation = $binLocation;
        return $this;
    }

    public function setCommittedQuantity($committedQuantity) {
        $this->committedQuantity = $committedQuantity;
        return $this;
    }

    public function setOnHandQuantity($onHandQuantity) {
        $this->onHandQuantity = $onHandQuantity;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

}
