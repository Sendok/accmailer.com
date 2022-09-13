<?php 
$ip = 'no';
$lat = 'no';
$lon = 'no';
$query = @unserialize (file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
if ($query && $query['status'] == 'success') {
    $ip = $query["query"];
    $lat = $query["lat"];
    $lon = $query["lon"];
}
?>
@extends('dashboard.layouts.default')

@section('title', 'Single Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('single') }}">Home</a></li>
      </ol>
    </nav>
    <h1>Single Email Verification</h1>
  </div>
</div>
@endsection

@section('content')     
<div class="rui-page-content">
  <div class="container-fluid">
    
    <div class="rui-profile row vertical-gap">
      @if(session("validate.next") || session("validate.max"))
      <div class="col-lg-6 col-xl-5">
      @else
      <div class="col-lg-12">
      @endif
        <div class="card">
          <div class="card-body">
            @if(isset($resource["payment_status"]))
            <div class="alert alert-brand" role="alert">
              You have payment process that yet completed, please complate to continue.
            </div>
            @elseif(isset($resource["bulk_inuse"]))
            <div class="alert alert-warning" role="alert">
              You can't Use Single Verification when Bulk Verification is in process, please wait until its done.
            </div>
            @else
            <h5>This Day You Have {{ $resource["type"] }} Email Verification <span class="badge badge-pill badge-success">{{ $resource["quota"] }} Validation</span></h5>

            <form class="needs-validation" method="POST" action="{{ route('validateSingle.post') }}" novalidate>
                  <div class="row vertical-gap sm-gap">
                      
                      <div class="col-12">
                          <label for="validationEmail">Validating Your email</label>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>">
                          <input type="hidden" name="lat" value="<?=$lat?>">
                          <input type="hidden" name="lon" value="<?=$lon?>">
                          <input type="email" name="email" class="form-control" id="validationEmail" placeholder="email@example.com" required>
                          <div class="invalid-feedback">
                              This value is required.
                          </div>
                      </div>
                    
                      <div class="col-12">
                          <button class="btn btn-brand" type="submit">Validate</button>
                      </div>
                  </div>
                 
            </form>
            @endif
          </div>
        </div>
      </div>
      @include('dashboard.partials.message')
    </div>
  </div>
</div>
<script >
window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
    });
}, false);
</script>
@endsection
