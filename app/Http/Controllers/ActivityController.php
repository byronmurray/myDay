<?php

namespace App\Http\Controllers;

use App\Cart;
use Session;
use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $activities = Activity::all();

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $products = $cart->items;

        return view('activities.index', compact('activities', 'products', 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Activity::create([
            'title' => $request->title,
            'body' => $request->body,
            'adultPrice' => $request->adultPrice,
            'childPrice' => $request->childPrice
        ]);

        return redirect('/');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request, $id)
    {
        $activity = Activity::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($activity, $activity->id);

        $request->session()->put('cart', $cart);

        return redirect('/');
    }

    public function getRemovedItem($id) {

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function viewCart(Activity $activity)
    {
        if (!Session::has('cart')) {
            return view('cart.show');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('cart.show', ['activities' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // so we are going to have to go throught the cart array and get the number of items and the item ids of each(array)
        // then loop though each one and update the qty by the number passed.
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->totalAdults = $request->adults;
        $cart->totalChildren = $request->children;

       // return var_dump($cart);

        $products = $cart->items;
        foreach($products as $items) {

                $id = $items['item']['id'];
                $activity = Activity::find($id);
                $cart->update($activity, $activity->id, $request->adults);
         
        }

        $request->session()->put('cart', $cart);


        //return var_dump($cart);
        

        return redirect('/'); 



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
