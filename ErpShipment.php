<?php

namespace Williams\Erp;

//oe_head.order,oe_head.rec_seq,oe_head.ord_date,oe_head.customer,oe_head.Manifest_id

class ErpShipment {

    protected $orderNumber;
    protected $recordSequence;
    protected $orderDate;
    protected $customerNumber;
    protected $manifestId;

    public function getOrderNumber() {
        return $this->orderNumber;
    }

    public function getRecordSequence() {
        return $this->recordSequence;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getCustomerNumber() {
        return $this->customerNumber;
    }

    public function getManifestId() {
        return $this->manifestId;
    }

    public function setOrderNumber($orderNumber) {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function setRecordSequence($recordSequence) {
        $this->recordSequence = $recordSequence;
        return $this;
    }

    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function setCustomerNumber($customerNumber) {
        $this->customerNumber = $customerNumber;
        return $this;
    }

    public function setManifestId($manifestId) {
        $this->manifestId = $manifestId;
        return $this;
    }

}
