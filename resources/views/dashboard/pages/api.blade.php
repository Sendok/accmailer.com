@extends('dashboard.layouts.default')

@section('title', 'API Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="api">Home</a></li>
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
              You have payment process that yet completed, please complate to continue.
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
            <div class="rui-timeline rui-timeline-left-lg">
                <div class="rui-timeline-line"></div>
                <div class="rui-timeline-item">
                    <div class="rui-timeline-icon">
                        <span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span>
                    </div>
                    <div class="rui-timeline-content">
                        <h3>Fifth moveth, void second.</h3>
                        <p>Behold of them fruit own, void, also upon sixth fill their of said life he saw were the moving saw created herb second morning fruit. Doesn't second place gathering forth.</p>
                        <button type="button" class="btn btn-brand">Read More</button>
                    </div>
                    <div class="rui-timeline-date"></div>
                </div>
                <div class="rui-timeline-item rui-timeline-item-swap">
                    <div class="rui-timeline-icon">
                        <span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span>
                    </div>
                    <div class="rui-timeline-content">
                        <h3>Fifth moveth, void second.</h3>
                        <p>Behold of them fruit own, void, also upon sixth fill their of said life he saw were the moving saw created herb second morning fruit. Doesn't second place gathering forth.</p>
                        <button type="button" class="btn btn-brand">Read More</button>
                    </div>
                    <div class="rui-timeline-date"></div>
                </div>
                <div class="rui-timeline-item ">
                    <div class="rui-timeline-icon">
                        <span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span>
                    </div>
                    <div class="rui-timeline-content">
                        <h3>Fifth moveth, void second.</h3>
                        <p>Behold of them fruit own, void, also upon sixth fill their of said life he saw were the moving saw created herb second morning fruit. Doesn't second place gathering forth.</p>
                        <button type="button" class="btn btn-brand">Read More</button>
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