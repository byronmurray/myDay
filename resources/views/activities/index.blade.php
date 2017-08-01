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
                                    <span>Adults: ${{$activity->adultPrice}}</span><br>
                                    <span>Children: ${{$activity->childPrice}}</span>
                                </div>
                                <br>
                                <a class="btn btn-success" href="/add-to-cart/{{$activity->id}}">Add to planner</a>
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
                                      <h2><strong>{{$product['item']['title']}}</strong></h2>
                                      <div>
                                        <span class="badge">{{ $cart->totalAdults }}</span>
                                        <span>Adult Price: ${{$product['item']['adultPrice']}}</span>
                                      </div>
                                      <div>
                                        <span class="badge">{{ $cart->totalChildren }}</span>
                                        <span>Children Price: ${{$product['item']['childPrice']}}</span>
                                      </div>
                                      <span>Total Price of Activity: ${{$product['price']}}</span>
                                  </div>
                                  <a href="/remove/{{$product['item']['id']}}">Remove Item</a>
                                </div>

                              @endforeach
                              </div>
                              <hr>
                              <span>total Price ${{ $cart->totalPrice}}</span>
                              <form action="/update/" method="POST" class="form-inline">
                                  {{ csrf_field() }}
    
                                  <div class="form-group">
                                    <label>Number of Adults</label>
                                    <select class="form-control" name="adults">
                                      <option {{ $cart->totalAdults == 1 ? 'selected="selected' : '' }}>1</option>
                                      <option {{ $cart->totalAdults == 2 ? 'selected="selected' : '' }}>2</option>
                                      <option {{ $cart->totalAdults == 3 ? 'selected="selected' : '' }}>3</option>
                                      <option {{ $cart->totalAdults == 4 ? 'selected="selected' : '' }}>4</option>
                                      <option {{ $cart->totalAdults == 5 ? 'selected="selected' : '' }}>5</option> 
                                    </select>
                                  </div>
                                  <br>
                                  <div class="form-group">
                                    <label>Number of Children</label>
                                    <select class="form-control" name="children">
                                      <option {{ $cart->totalChildren == 0 ? 'selected="selected' : '' }}>0</option>
                                      <option {{ $cart->totalChildren == 1 ? 'selected="selected' : '' }}>1</option>
                                      <option {{ $cart->totalChildren == 2 ? 'selected="selected' : '' }}>2</option>
                                      <option {{ $cart->totalChildren == 3 ? 'selected="selected' : '' }}>3</option>
                                      <option {{ $cart->totalChildren == 4 ? 'selected="selected' : '' }}>4</option>
                                      <option {{ $cart->totalChildren == 5 ? 'selected="selected' : '' }}>5</option> 
                                    </select>
                                  </div>

                                      
                                      
                                      



                                  <br>
                                  <button type="submit" id="submit" class="btn btn-default">Continue</button>
                                </form>
                                
                                add current location to this
                                
                                @foreach ($products as $item)
                                  @if (count($cart->items) > 1)
                                    @if ($loop->first)
                                        <input type="hidden" id="start" value="{{ $item['item']['location'] }}">
                                        <select multiple id="waypoints" type="hidden">
                                    @elseif ($loop->last)
                                        </select>
                                        <input type="hidden" id="end" value="{{ $item['item']['location'] }}">
                                    @else
                                        <option selected='selected' type="hidden" id="waypoints" value="{{ $item['item']['location'] }}"></option>
                                    @endif
                                  @endif
                                    

                                @endforeach
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
                           <style>
                              #right-panel {
                                font-family: 'Roboto','sans-serif';
                                line-height: 30px;
                                padding-left: 10px;
                              }

                              #right-panel select, #right-panel input {
                                font-size: 15px;
                              }

                              #right-panel select {
                                width: 100%;
                              }

                              #right-panel i {
                                font-size: 12px;
                              }
                              html, body {
                                height: 100%;
                                margin: 0;
                                padding: 0;
                              }
                              #map {
                                height: 100%;
                                float: left;
                                width: 70%;
                                height: 100%;
                              }
                              #right-panel {
                                margin: 20px;
                                border-width: 2px;
                                width: 20%;
                                height: 400px;
                                float: left;
                                text-align: left;
                                padding-top: 0;
                              }
                              #directions-panel {
                                margin-top: 10px;
                                background-color: #FFEE77;
                                padding: 10px;
                                overflow: scroll;
                                height: 174px;
                              }
                            </style>

                            <div id="map"></div>
                            <div id="right-panel">
                            <div>
                            <div id="directions-panel"></div>
                            </div>
                        </section>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


    <script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: -38.1443828, lng: 176.2629304}
        });
        directionsDisplay.setMap(map);

        
        calculateAndDisplayRoute(directionsService, directionsDisplay);

      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }

        directionsService.route({
          origin: document.getElementById('start').value,
          destination: document.getElementById('end').value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route to Activity: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxOOoDq4fJx7ChxpeDb8r6iJLO3iImcSs&callback=initMap">
    </script>
@endsection
