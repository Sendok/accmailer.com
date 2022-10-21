@extends('dashboard.layouts.default')

@section('title', 'API Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('single') }}">Home</a></li>
      </ol>
    </nav>
    <h1>API Email Verification</h1>
  </div>
</div>
@endsection

@section('content')     
<div class="rui-page-content">
  <div class="container-fluid">
     <div class="rui-profile row vertical-gap">
      @if(isset($resource["payment_status"]))
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-brand" role="alert">
              You have payment process that yet completed, please complate to continue. <a href="{{ route('payment.cancel.id') }}"><button type="button" class="btn btn-brand btn-hover-outline btn-hover-primary">Click Here to Cancel Payment</button>&nbsp;</a>
            </div>
          </div>
        </div>
      </div>
      @elseif(isset($resource["plan_free"]))
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-warning" role="alert">
              Free Plan cannot Access this API Verification, Please upgrade your Plan.
            </div>
          </div>
        </div>
      </div>
      @else
     <div class="col-12">
        <div class="card">
          <div class="card-body">
          <h5>This Day You Have {{ $resource["type"] }} Email Verification <span class="badge badge-pill badge-success">{{ $resource["quota"] }} Validation</span></h5>
          <p><em>Generate API KEY to use API Verification.</em></p>
            <blockquote class="blockquote">
                <div class="row">
                  <div class="col-11">
                  <p class="mb-0" id='display' onClick='copyText(this)'>{{ $resource["token"] }}</p>
                  </div>
                  <div class="col-1">
                  <a href="" onClick='copyText(display)' data-original-title="Copy to clipboard"><span stroke-width="2"  data-feather="copy"></span></a>
                  </div>
                </div>
                
            </blockquote>
            @if($resource["token"] == 'Please Generate New Token')
            <form class="needs-validation" method="POST" action="{{ route('api.generate') }}" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button class="btn btn-brand btn-sm" type="submit">Generate</button>
            </form>
            @endif
            
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5>How to Use API Verification</h5>
            <p>Copy or open this JSON link of Postman then import to you Postman Collection :  <a href="https://www.getpostman.com/collections/1629e7405363e63d78f8"><button type="button" class="btn btn-brand btn-hover-outline btn-hover-primary">Postman Collection</button>&nbsp;</a></p> 
            <div class="rui-timeline rui-timeline-left-lg">
                <div class="rui-timeline-line"></div>
                <div class="rui-timeline-item">
                    <div class="rui-timeline-icon">
                        <span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span>
                    </div>
                    <div class="rui-timeline-content">
                        <h3>Set Header using API Key Accmailer.com and Request Body.</h3>
                        <p>1. Copy Generate API KEY to use API Verification .</p>
                        <div class="col-12"><a href="./assets/images/CopyApikey.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/CopyApikey.png" class="rui-img" alt=""></a></div>
                        <p>2. Open Postman -> Open Collection AccMailer.com API Verification -> Click API Verification</p>
                        <div class="col-12"><a href="./assets/images/APIVerification.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/APIVerification.png" class="rui-img" alt=""></a></div>
                        <p>3. Replace API Key on Header value {Your API Key}.</p>
                        <div class="col-12"><a href="./assets/images/APIKey.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/APIKey.png" class="rui-img" alt=""></a></div>
                        <p>4. Request Body using raw JSON.</p>
                        <div class="col-12"><a href="./assets/images/Request.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/Request.png" class="rui-img" alt=""></a></div>
                        
                        <!-- <button type="button" class="btn btn-brand">Read More</button> -->
                    </div>
                    <div class="rui-timeline-date"></div>
                </div>
                
                <div class="rui-timeline-item rui-timeline-item-swap">
                    <div class="rui-timeline-icon">
                        <span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span>
                    </div>
                    <div class="rui-timeline-content">
                        <h3>Use Any Language to use API</h3>
                        <p>1. You can choose any language programing to apply, use this Code Snippet tab on Postman then choose language programming that you use</p>
                        <div class="col-12"><a href="./assets/images/CodeSnipp.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/CodeSnipp.png" class="rui-img" alt=""></a></div>
                        <p>2. For Example i will choose cURL, then it will show you how to use it on cURL</p>
                        <div class="col-12"><a href="./assets/images/cURL.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/cURL.png" class="rui-img" alt=""></a></div>
                        <!-- <button type="button" class="btn btn-brand">Read More</button> -->
                    </div>
                    <div class="rui-timeline-date"></div>
                </div>
                <div class="rui-timeline-item ">
                    <div class="rui-timeline-icon">
                        <span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span>
                    </div>
                    <div class="rui-timeline-content">
                        <h3>GET Response</h3>
                        <p>You can use All Response and response Code here</p>
                        <div class="col-12"><a href="./assets/images/responseAll.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/responseAll.png" class="rui-img" alt=""></a></div>
                        <p>1. API Verification Success Code 200</p>
                        <div class="col-12"><a href="./assets/images/code200.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/code200.png" class="rui-img" alt=""></a></div>
                        <p>status callback is 'valid', 'invalid' and 'disposable' </p>
                        <p>2. API Verification Unauthorized Code 403</p>
                        <div class="col-12"><a href="./assets/images/code403.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/code403.png" class="rui-img" alt=""></a></div>
                        <p>3. API Verification Quota Max code 200</p>
                        <div class="col-12"><a href="./assets/images/quotalimit.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/quotalimit.png" class="rui-img" alt=""></a></div>
                        <p>4. API Verification Error Request code 500</p>
                        <div class="col-12"><a href="./assets/images/code500.png" data-fancybox="images" class="rui-gallery-item"> <img src="./assets/images/code500.png" class="rui-img" alt=""></a></div>
                        <!-- <button type="button" class="btn btn-brand">Read More</button> -->
                    </div>
                    <div class="rui-timeline-date"></div>
                </div>
                
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection