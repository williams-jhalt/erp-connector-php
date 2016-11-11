<?php

namespace Williams\Erp;

abstract class AbstractErpRepository {
    
    /**
     *
     * @var ErpConnector
     */
    protected $erp;
    
    public function __construct(ErpConnector $erp) {
        $this->erp = $erp;
    }
    
}