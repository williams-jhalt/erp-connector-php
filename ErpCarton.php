<?php

namespace Williams\Erp;

class ErpCarton {

    protected $cartonNumber;
    protected $orderNumber;
    protected $recordSequence;
    protected $ucc;

    public function getCartonNumber() {
        return $this->cartonNumber;
    }

    public function getOrderNumber() {
        return $this->orderNumber;
    }

    public function getRecordSequence() {
        return $this->recordSequence;
    }

    public function getUcc() {
        return $this->ucc;
    }

    public function setCartonNumber($cartonNumber) {
        $this->cartonNumber = $cartonNumber;
        return $this;
    }

    public function setOrderNumber($orderNumber) {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function setRecordSequence($recordSequence) {
        $this->recordSequence = $recordSequence;
        return $this;
    }

    public function setUcc($ucc) {
        $this->ucc = $ucc;
        return $this;
    }

}
