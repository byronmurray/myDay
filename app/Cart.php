<?php

namespace App;


class Cart
{
    public $items;
    public $totalQty = 0;
    public $totalAdults = 0;
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
    	$storeItem['price'] = $item->price * $storeItem['qty'];


    	$this->items[$id] = $storeItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->price;
    }


    public function update($item, $id, $num) {

        $oldtotal = $this->items[$id]['qty'] * $this->items[$id]['item']['price'];

        $storeItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if (array_key_exists($id, $this->items)) {
            $storeItem = $this->items[$id];
        }

        $storeItem['qty'] = $num;
        $storeItem['price'] = $item->price * $storeItem['qty'];

        $this->items[$id] = $storeItem;
        $this->totalPrice += $storeItem['price'] - $oldtotal;
        
    }

    public function removeItem($id) { 
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

}
