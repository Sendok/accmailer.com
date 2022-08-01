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
     <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5>This Day You Have Free Single Email Validation <span class="badge badge-pill badge-success">1000 Validation</span></h5>
            <p><em>Generate API KEY to use API Verification.</em></p>
            <blockquote class="blockquote">
                <p class="mb-0">eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c</p>
            </blockquote>
            <button type="button" class="btn btn-brand btn-sm">GENERATE</button>
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
    </div>
  </div>
</div>
@endsection