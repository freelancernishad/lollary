@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile">
                <p class="my-acc" style="    font-size: 30px">{{ __('messages.account') }}</p>
                <p class="pro-name">{{ __('messages.Name') }}: {{ Auth::user()->name }} </p>
                <p class="pro-country">{{ __('messages.Country') }}: {{ Auth::user()->country }} </p>
                <p class="pro-phone">{{ __('messages.Phone') }}: {{ Auth::user()->phone }} </p>
                {{-- <p class="pro-state">{{ __('messages.State') }}: {{ Auth::user()->city }}</p> --}}
                <p class="pro-state">{{ __('N/P No') }}: {{ Auth::user()->national_or_passport }}</p>
            </div>

            <div class="profile-bank-cheque" style="font-family: sans-serif;">
                <p class="bank-cheque" style="    font-size: 30px">{{ __('messages.cheque') }}</p>
                <img class="cheque-photo" width="100%"
                    src="{{ asset(Auth::user()->bank_check) }}"
                    alt="">
            </div>


            <div class="profile-bank-cheque" style="font-family: sans-serif;">
                <p class="bank-cheque" style="    font-size: 30px">{{ __('messages.balance') }}</p>
                {{ Auth::user()->money }} {{ Auth::user()->currency }}
            </div>





            <div class="row">
                <div class="col-md-6 col-6 text-center p3">
                    <a href="/home/checkout?type=Bank_Transfer" class="Bank-trans"><img class="icon-details"
                            src="https://img.icons8.com/nolan/40/merchant-account.png" />{{ __('messages.Bank') }}</a>
                </div>
                <div class="col-md-6 col-6 text-center p3">
                    <a href="/home/checkout?type=Cashout" class="cashout Bank-trans"><img class="icon-details"
                            src="https://img.icons8.com/external-flatarticons-blue-flatarticons/40/000000/external-loan-banking-money-and-business-economics-flatarticons-blue-flatarticons.png" />{{ __('messages.Cashout') }}
                        </a>
                </div>



                <div class="col-md-6 col-6 text-center p3">
                    <a href="/home/checkout?type=Paypal" class="paypal Bank-trans"><img class="icon-details"
                            src="https://img.icons8.com/cute-clipart/40/000000/paypal.png" />{{ __('messages.Paypal') }} </a>
                </div>
                <div class="col-md-6 col-6 text-center p3">
                    <a href="/home/checkout?type=Western_union" class="western-union Bank-trans"><img class="icon-details" src="{{ asset('img/Untitled design.png') }}">{{ __('messages.Western') }}  </a>
                </div>
            </div>



            <a class="dropdown-item" href="{{ route('logout') }}" style="    background: red;color: white;text-align: center;font-size: 25px;padding: 7px;margin-top: 30px;margin-bottom: 30px;"
            onclick="event.preventDefault();
                          document.getElementById('logout-form2').submit();">
             {{ __('Logout') }}
         </a>

         <form id="logout-form2" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>


        </div>
    </div>





</div>
@endsection
