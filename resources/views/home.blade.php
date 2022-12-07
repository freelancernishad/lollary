@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile">
                <p class="my-acc">{{ __('messages.account') }}</p>
                <p class="pro-name">{{ __('messages.Name') }}: {{ Auth::user()->name }} </p>
                <p class="pro-country">{{ __('messages.Country') }}: {{ Auth::user()->country }} </p>
                <p class="pro-phone">{{ __('messages.Phone') }}: {{ Auth::user()->phone }} </p>
                <p class="pro-state">{{ __('messages.State') }}: {{ Auth::user()->city }}</p>
            </div>

            <div class="profile-bank-cheque">
                <p class="bank-cheque">{{ __('messages.cheque') }}</p>
                <img class="cheque-photo" width="100%"
                    src="{{ Auth::user()->bank_check }}"
                    alt="">
            </div>


            <div class="profile-bank-cheque">
                <p class="bank-cheque">{{ __('messages.balance') }}</p>
                {{ Auth::user()->money }}
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
                    <a href="/home/checkout?type=Western_union" class="western-union Bank-trans"><img class="icon-details" src="img/Untitled design.png">{{ __('messages.Western') }}  </a>
                </div>
            </div>





        </div>
    </div>
</div>
@endsection
