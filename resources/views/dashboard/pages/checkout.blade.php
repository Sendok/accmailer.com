@extends('dashboard.layouts.default')

@section('title', 'Checkout')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plan') }}">Home</a></li>
      </ol>
    </nav>
    <h1>Checkout Plan</h1>
  </div>
</div>
@endsection

@section('content')     
<div class="rui-page-content">
  <div class="container-fluid">
     <div class="row g-5 ">
     
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-brand">Your cart</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">{{ $resource["plan_name"] }}</h6>
              <small class="text-muted">{{ $resource["plan_quota"] }} Verification {{ $resource["plan_type"] }}</small>
            </div>
            <span class="text-muted">${{ $resource["plan_price"] }}</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>${{ $resource["plan_price"] }}</strong>
          </li>
        </ul>

      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-brand">Payment Method</span>
        </h4>
        <form method="GET" action="{{ route('payment') }}">
          <input type="hidden" class="form-control" name="plan_id" value="{{ $resource['plan_id'] }}">
          <hr class="my-4">
          
          <div class="my-3">
          <select class="form-control rui-selectize-element rui-selectize-select rui-selectize-icon" name="payment-method">
              <option value="midtrans" data-data='{"selectize":"<span stroke-width=\"1.5\" data-feather=\"twitter\" class=\"rui-icon\"></span>"}'>Midtrans</option>
              <option value="paypal" data-data='{"selectize":"<span stroke-width=\"1.5\" data-feather=\"facebook\" class=\"rui-icon\"></span>"}'>Paypal</option>
          </select>  
           
          </div>
          
          <hr class="my-4">
          <button class="btn btn-outline-brand btn-block justify-content-center submit" type="submit">Continue to checkout</button>
        </form>
      </div>
     </div>
  </div>
</div>
@endsection
