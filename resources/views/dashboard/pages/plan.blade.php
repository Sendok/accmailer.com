@extends('dashboard.layouts.default')

@section('title', 'Plan')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="plan">Home</a></li>
      </ol>
    </nav>
    <h1>Plan</h1>
  </div>
</div>
@endsection

@section('content')     
<div class="rui-page-content">
  <div class="container-fluid">
  @if(isset($resource["payment_status"]))
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-brand" role="alert">
              You have payment process that yet completed, please complate to continue.
            </div>
          </div>
        </div>
      </div>
      @else
     <div class="rui-profile row vertical-gap justify-content-center">
            <div class="col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Single Price Plan -->
                        <div class="single-price-plan color-1 bg-hover hover-top text-center p-5">
                        <!-- Plan Title -->
                        <div class="plan-title mb-2 mb-sm-3">
                            <h3 class="mb-2">Free</h3>
                            <p>Free plan you just have 20 verification quota every day</p>
                        </div>
                        <!-- Plan Price -->
                        <div class="plan-price pb-2 pb-sm-3">
                            <span class="color-primary fw-7">$</span>
                            <span class="h1 badge badge-pill badge-warning">0</span>
                            <sub class="validity text-muted fw-5">/day</sub>
                        </div>
                        <!-- Plan Description -->
                                <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>20 Email Verification</span></p>
                                <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Free Reporting</span></p>
                                <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Single Verification</span></p>
                                <p>x  <span><s>Limited Bulk Verification</s></span></p>
                                <p>x  <span><s>API Verification</s></span></p>
                        <!-- Plan Button -->
                        <div class="plan-button">
                            @if(isset($resource["plan_id"]) && $resource["plan_id"] == 1)
                            <button type="button" class="btn btn-outline-primary btn-block justify-content-center " disabled>Your Current Plan</button>
                            @else
                            <a href="{{ route('checkout.detail', ['slug' => 1]) }}" class="btn btn-outline-primary btn-block justify-content-center submit">Checkout</a>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <!-- Single Price Plan -->
                <div class="card">
                <div class="card-body">
                <div class="single-price-plan color-2 bg-hover active hover-top text-center p-5">
                    <!-- Plan Title -->
                    <div class="plan-title mb-2 mb-sm-3 ">
                        <h3 class="mb-2">Silver <sup><span class="badge badge-pill badge-success ml-2">Save 20%</span></sup></h3>
                        <p>Silver Pro plan is still with low cost with hight cap limitation.</p>
                    </div>
                    <!-- Plan Price -->
                    <div class="plan-price pb-2 pb-sm-3">
                        <span class="color-primary fw-7">$</span>
                        <span class="h1 fw-7 badge badge-pill badge-warning">40</span>
                        <sub class="validity text-muted fw-5">/month</sub>
                    </div>
                    <!-- Plan Description -->
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>20000 Email Verification</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Free Reporting</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Single Verification</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Limited Bulk Verification</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>API Verification</span></p>
                    <!-- Plan Button -->
                    <div class="plan-button">
                        @if(isset($resource["plan_id"]) && $resource["plan_id"] == 2)
                        <button type="button" class="btn btn-outline-success btn-block justify-content-center" disabled>Your Current Plan</button>
                        @else
                        <a href="{{ route('checkout.detail', ['slug' => 2]) }}" class="btn btn-outline-success btn-block justify-content-center">Checkout</a>
                        @endif
                    </div>
                </div>
                </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="card">
                <div class="card-body">
                <!-- Single Price Plan -->
                <div class="single-price-plan color-3 bg-hover hover-top text-center p-5">
                    <!-- Plan Title -->
                    <div class="plan-title mb-2 mb-sm-3">
                        <h3 class="mb-2">Gold<sup></sup></h3>
                        <p>Gold plan make your mailing more easy and clear with high CAP.</p>
                    </div>
                    <!-- Plan Price -->
                    <div class="plan-price pb-2 pb-sm-3">
                        <span class="h1 badge badge-pill badge-warning">100</span>
                        <sub class="validity text-muted fw-5">/month</sub>
                    </div>
                    <!-- Plan Description -->
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>45000 Email Verification</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Free Reporting</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Single Verification</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>Custom Limit Bulk Verification</span></p>
                    <p><span data-feather="check" class="rui-icon rui-icon-stroke-1_5"></span><span>API Verification</span></p>
                    <!-- Plan Button -->
                    <div class="plan-button">
                        @if(isset($resource["plan_id"]) && $resource["plan_id"] == 3)
                        <button type="button" class="btn btn-outline-brand btn-block justify-content-center" disabled>Your Current Plan</button>
                        @else
                        <a href="{{ route('checkout.detail', ['slug' => 3]) }}" class="btn btn-outline-brand btn-block justify-content-center">Checkout</a>
                        @endif
                    </div>
                    </div>
                </div>
                </div>
            </div>
     </div>
     @endif
  </div>
</div>
@endsection