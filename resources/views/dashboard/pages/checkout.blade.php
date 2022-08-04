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
              <h6 class="my-0">Plan Pro</h6>
              <small class="text-muted">30000 Verification Per Month</small>
            </div>
            <span class="text-muted">$12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">−$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (IDR)</span>
            <strong>Rp 200.000</strong>
          </li>
        </ul>

      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-brand">Payment Method</span>
        </h4>
        <form class="needs-validation" novalidate="">
          
          <hr class="my-4">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="save-info">
            <label class="form-check-label" for="save-info">Save this information for next time</label>
          </div>

          <hr class="my-4">

          

          <div class="my-3">
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
              <label class="form-check-label" for="debit">Midtrans</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
            </div>

          <hr class="my-4">

          <button class="btn btn-outline-brand btn-block justify-content-center submit" type="submit">Continue to checkout</button>
        </form>
      </div>
     </div>
  </div>
</div>
@endsection