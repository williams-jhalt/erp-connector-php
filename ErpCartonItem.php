<?php

namespace Williams\Erp;

class ErpCartonItem extends ErpProduct {

    protected $quantityShipped;

    public function getQuantityShipped() {
        return $this->quantityShipped;
    }

    public function setQuantityShipped($quantityShipped) {
        $this->quantityShipped = $quantityShipped;
        return $this;
    }

}
