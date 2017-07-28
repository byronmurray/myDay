@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hello</div>

                <div class="panel-body">
                    
                    @if (Session::has('cart'))
                      <div>
                        <ul>
                          @foreach ($activities as $activity)
                            <li>
                              <span class="badge pull-right">{{ $activity['qty'] }}</span>
                              <strong>{{$activity['item']['title']}}</strong>
                              <span>${{$activity['price']}}</span>
                              
                            </li>
                          @endforeach
                        </ul>

                        <hr>
                        <strong>Total Price: {{ $totalPrice }}</strong><br>
                        <button>Checkout</button>

                      </div>

                    @else
                      you dont have any items in your cart
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection