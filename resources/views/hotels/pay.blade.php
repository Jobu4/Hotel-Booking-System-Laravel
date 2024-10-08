@extends('layouts.app')

@section('content')


<div class="hero-wrap js-fullheight" style="margin-top:25px; background-image: url('{{asset('assets/images/room-1.jpg')}}');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate">
            <h2 class="subheading">Pay with Paypal</h2>
            <h1 class="mb-4"></h1>
          {{-- <p><a href="{{route('home')}}" class="btn btn-primary">Go Home</a> </p> --}}
        </div>
      </div>
    </div>
  </div>


    <div class="container">  
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    {{-- so basically the link below will be the business account to which the money is being sent. by clearly addingthe client ID --}}
                    <script src="https://www.paypal.com/sdk/js?client-id=AcCYK6AjBxfjEJF6_F5Cnfx7hiQnRMekVTQIAB5Evu68kmnD1-ZqlqKFi3gO_JmzNKFCDa9aI_UpVsjX&currency=USD"></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                    <script>
                        paypal.Buttons({
                        // Sets up the transaction when a payment button is clicked
                        createOrder: (data, actions) => {
                            return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    // creating a session that gets the price that we fetched earlier to have the amont to be dynamic
                                value: '{{Session::get('price')}}' // Can also reference a variable or function
                                }
                            }]
                            });
                        },
                        // Finalize the transaction after payer approval
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
                          
                             window.location.href='http://127.0.0.1:8000/hotels/success';
                            });
                        }
                        }).render('#paypal-button-container');
                    </script>
                  
                </div>
     
@endsection