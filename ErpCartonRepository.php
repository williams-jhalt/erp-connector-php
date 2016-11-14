<?php

namespace Williams\Erp;

class ErpCartonRepository extends AbstractErpRepository {    
    
    private $productService;
    
    public function __construct(ErpConnector $erp) {
        parent::__construct($erp);
        $this->productService = new ErpProductRepository($erp);
    }
    
    public function getCartons($order, $seq) {

        $query = "FOR EACH ed_ucc128ln NO-LOCK "
                . "WHERE ed_ucc128ln.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND ed_ucc128ln.order = '" . $order . "' "
                . "AND ed_ucc128ln.rec_seq = '" . $seq . "'";

        $response = $this->erp->read($query, "ed_ucc128ln.order,ed_ucc128ln.rec_seq,ed_ucc128ln.ucc,ed_ucc128ln.carton");
        
        $result = array();
        $uccs = array();
        
        foreach ($response as $erpItem) {
            if (array_search($erpItem->ed_ucc128ln_ucc, $uccs) !== false) {
                continue;
            }
            $carton = new ErpCarton();
            $carton->setCartonNumber($erpItem->ed_ucc128ln_carton);
            $carton->setOrderNumber($erpItem->ed_ucc128ln_order);
            $carton->setRecordSequence($erpItem->ed_ucc128ln_rec_seq);
            $carton->setUcc($erpItem->ed_ucc128ln_ucc);
            $result[] = $carton;
            $uccs[] = $erpItem->ed_ucc128ln_ucc;
        }
        
        return $result;
        
    }
    
    public function getCartonItems($ucc) {

        $query = "FOR EACH ed_ucc128pk NO-LOCK "
                . "WHERE ed_ucc128pk.company_oe = '" . $this->erp->getCompany() . "' "
                . "AND ed_ucc128pk.ucc = '" . $ucc . "'";

        $response = $this->erp->read($query, "ed_ucc128pk.item,ed_ucc128pk.qty_shp");
        
        $result = array();
        
        foreach ($response as $erpItem) {
            $product = $this->productService->getByItemNumber($erpItem->ed_ucc128pk_item);
            
            $cartonItem = new ErpCartonItem();
            $cartonItem->setBinLocation($product->getBinLocation());
            $cartonItem->setCommittedQuantity($product->getCommittedQuantity());
            $cartonItem->setItemNumber($product->getItemNumber());
            $cartonItem->setName($product->getName());
            $cartonItem->setPrice($product->getPrice());
            $cartonItem->setQuantityShipped($erpItem->ed_ucc128pk_qty_shp);
            $cartonItem->setOnHandQuantity($product->getOnHandQuantity());
            
            $result[] = $cartonItem;
        }
        
        return $result;
        
    }
    
}