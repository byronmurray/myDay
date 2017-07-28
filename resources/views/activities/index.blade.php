@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Hello</div>

                <div class="panel-body">
                    
                    {{-- Opening paragraph about the how to --}}

                    <section class="text-center">
                        <h1>About the planner</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </section>

                    <hr>

                    {{-- Slider or something to display all the activities --}}

                    <section class="text-center">
                      <h2>All Activities</h2>
                        <form class="form-inline">
                        <div class="form-group">
                          <select class="form-control">
                            <option>All categories</option>
                            <option>Family</option>
                            <option>Kids</option>
                            <option>Adults</option>
                            <option>All day</option>
                            <option>Half day</option>
                            <option>Food</option>
                          </select>
                        </div>
                          <div class="form-group">
                            <label for="inputPassword2" class="sr-only">Search</label>
                            <input type="text" class="form-control" placeholder="Search">
                          </div>
                          <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>

                        <div class="flex-container">
                              
                            @foreach ($activities as $activity)
                              <div class="card">
                                <div><img src="images/image_{{ $activity->id }}.jpg"></div>
                                <div>
                                    <h2>{{$activity->title}}</h2>
                                    <p>{{$activity->body}}</p>
                                    <span>${{$activity->price}}</span>
                                </div>
                                <a href="/add-to-cart/{{$activity->id}}">Add to planner</a>
                              </div>
                            @endforeach
                            

                        </div>
                    </section>

                    <hr>

                    {{-- The inventory planner, where the magic happens --}}

                    <section class="text-center">
                        <h2>My Day</h2>
                        <div class="flex-container">
                            
                            @if (Session::has('cart'))
                 
                              @foreach ($products as $product)
                                <div class="card">
                                  <div><img src="/images/image_{{ $product['item']['id'] }}.jpg"></div>
                                  <div>
                                      <strong>{{$product['item']['title']}}</strong>
                                      <span>${{$product['price']}}</span>
                                      <span class="badge pull-right">{{ $product['qty'] }}</span>
                                  </div>
                                  <a href="/remove/{{$product['item']['id']}}">Remove Item</a>
                                </div>

                              @endforeach
                              </div>
                              <hr>
                              <form>
    
                                  <div class="form-group">
                                    <label>Number of Adults</label>
                                    <select class="form-control">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label>Number of Children</label>
                                    <select class="form-control">
                                      <option>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                  </div>

                                  <button type="submit" class="btn btn-default">Continue</button>
                                </form>
                                <hr>

                            @else
                                you don't have any items in your planner yet!
                              </div>
                              <hr>
                            @endif

                        
                        <h3><< Time details>></h3>
                    </section>

                    <hr>

                   {{--  Google Map where directions time lines and shit will be displayed --}}
                   
                   @if (Session::has('cart'))
                       <section>
                           <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d12553.457406520587!2d176.239236868668!3d-38.13172007355777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x6d6e9d870e2ef5b1%3A0xc26182040f5be75!2sPolynesian+Spa%2C+Rotorua%2C+New+Zealand!3m2!1d-38.1378947!2d176.2582214!4m5!1s0x6d6c27b62116b577%3A0x456085ce2384f5df!2sSkyline+Rotorua+178+Fairy+Springs+Rd%2C+Fairy+Springs%2C+Rotorua+3015%2C+New+Zealand!3m2!1d-38.110431999999996!2d176.221969!5e0!3m2!1sen!2snz!4v1500023313629" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
                       </section>

                       <hr>
                      
                       <section>
                            <div class="container">
                                <form>
                                  <h3>Personal Information</h3>
                                  <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name">
                                  </div>
                                  <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" placeholder="Phone">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                  </div>

                                  <hr>
                                    <h3>Credit Card Information</h3>
                                  <div class="form-group">
                                    <label>Credit Card Name</label>
                                    <input type="text" class="form-control" placeholder="Name">
                                  </div>
                                  <div class="form-group">
                                    <label>Credit Card Number</label>
                                    <input type="text" class="form-control" placeholder="xxxx xxxx xxxx">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Expiry Date</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Date">
                                  </div>

                                  <div>
                                      <strong>Total Price: ${{ $totalPrice }}</strong><br>
                                  </div>

                                  <button type="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                       </section>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
