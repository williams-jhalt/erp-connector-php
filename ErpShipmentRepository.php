<?php

namespace Williams\Erp;

class ErpShipmentRepository extends AbstractErpRepository  {    
    
    public function getShipment($manifestId) {

        $query = "FOR EACH oe_head NO-LOCK "
                . "WHERE oe_head.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND oe_head.Manifest_id = '" . $manifestId . "'";

        $response = $this->erp->read($query, "oe_head.order,oe_head.rec_seq,oe_head.ord_date,oe_head.customer,oe_head.Manifest_id");
        
        $result = array();

        foreach ($response as $item) {
            
            $salesOrder = new ErpShipment();
            $salesOrder->setCustomerNumber($item->oe_head_customer);
            $salesOrder->setManifestId($item->oe_head_Manifest_id);
            $salesOrder->setOrderDate(new DateTime($item->oe_head_ord_date));
            $salesOrder->setOrderNumber($item->oe_head_order);
            $salesOrder->setRecordSequence($item->oe_head_rec_seq);
            
            $result[] = $salesOrder;
            
        }
        
        return $result[0];

    }
    
}