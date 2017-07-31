<?php

namespace App;


class Cart
{
    public $items;
    public $totalQty = 0;
    public $totalAdults = 1;
    public $totalChildren = 0;
    public $totalPrice;

    public function __construct($oldCart) {
    	if ($oldCart) {
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
            $this->totalAdults = $oldCart->totalAdults;
            $this->totalChildren = $oldCart->totalChildren;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    public function add($item, $id) {
    	$storeItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

    	if ($this->items) {
    		if (array_key_exists($id, $this->items)) {
    			$storeItem = $this->items[$id];
                return;
	    	}
    	}

    	$storeItem['qty']++;
    	$storeItem['price'] = ($this->totalAdults * $item->adultPrice) + ($this->totalChildren * $item->childPrice);


    	$this->items[$id] = $storeItem;
    	$this->totalQty++;
    	$this->totalPrice += ($this->totalAdults * $item->adultPrice) + ($this->totalChildren * $item->childPrice);
    }


    public function update($item, $id) {

        $oldtotal = $this->items[$id]['price'];
        $newPrice = ($this->totalAdults * $item->adultPrice) + ($this->totalChildren * $item->childPrice);

        $this->items[$id]['price'] = ($this->totalAdults * $item->adultPrice) + ($this->totalChildren * $item->childPrice);
        //$this->totalPrice += ($this->totalAdults * $item->adultPrice) + ($this->totalChildren * $item->childPrice) - $oldtotal;
        $this->totalPrice += $newPrice - $oldtotal;
        
    }

    public function removeItem($id) { 
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

}
