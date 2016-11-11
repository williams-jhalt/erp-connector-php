<?php

namespace Williams\Erp;

class ErpProductRepository extends AbstractErpRepository {

    public function getByItemNumber($itemNumber) {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '" . $this->erp->getCompany() . "' "
                . "AND item.item = '" . $itemNumber . "', "
                . "EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item";

        $response = $this->erp->read($query, "item.item,item.descr,wa_item.ship_location,wa_item.list_price,wa_item.qty_cmtd,wa_item.qty_oh");

        if (empty($response)) {
            return null;
        }

        $item = $response[0];

        $product = new Product();
        $product->setItemNumber($item->item_item);
        $product->setName(join(" ", $item->item_descr));
        $product->setBinLocation($item->wa_item_ship_location);
        $product->setPrice($item->wa_item_list_price);
        $product->setStockQuantity($item->wa_item_qty_oh);
        $product->setCommittedQuantity($item->wa_item_qty_cmtd);

        return $product;
    }

    public function findBySearchTerms($searchTerms) {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '" . $this->erp->getCompany() . "' "
                . "AND item.sy_lookup MATCHES '*" . $searchTerms . "*', "
                . "EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item";

        $response = $this->erp->read($query, "item.item,item.descr,wa_item.ship_location,wa_item.list_price,wa_item.qty_cmtd,wa_item.qty_oh");

        $result = array();

        foreach ($response as $item) {

            $product = new Product();
            $product->setItemNumber($item->item_item);
            $product->setName(join(" ", $item->item_descr));
            $product->setBinLocation($item->wa_item_ship_location);
            $product->setPrice($item->wa_item_list_price);
            $product->setStockQuantity($item->wa_item_qty_oh);
            $product->setCommittedQuantity($item->wa_item_qty_cmtd);

            $result[] = $product;
        }

        return $result;
    }

    public function findCommitted($searchTerms = null, $offset = 0, $limit = 100) {

        $query = "FOR EACH item NO-LOCK "
                . "WHERE item.company_it = '" . $this->erp->getCompany() . "' ";

        if ($searchTerms !== null) {
            $query .= "AND item.sy_lookup MATCHES '*" . $searchTerms . "*'";
        }

        $query .= ", EACH wa_item NO-LOCK WHERE "
                . "wa_item.company_it = item.company_it AND "
                . "wa_item.item = item.item AND "
                . "wa_item.qty_cmtd > 0";

        $response = $this->erp->read($query, "item.item,item.descr,wa_item.ship_location,wa_item.list_price,wa_item.qty_cmtd,wa_item.qty_oh", $offset, $limit);

        $result = array();

        foreach ($response as $item) {

            $product = new Product();
            $product->setItemNumber($item->item_item);
            $product->setName(join(" ", $item->item_descr));
            $product->setBinLocation($item->wa_item_ship_location);
            $product->setPrice($item->wa_item_list_price);
            $product->setStockQuantity($item->wa_item_qty_oh);
            $product->setCommittedQuantity($item->wa_item_qty_cmtd);
            
            $result[] = $product;
        }

        return $result;
    }

}
