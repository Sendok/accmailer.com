@extends('dashboard.layouts.default')

@section('title', 'Single Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="single">Home</a></li>
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
      <div class="col-lg-6 col-xl-5">
        <div class="card">
          <div class="card-body">
            <h5>This Day You Have Free Single Email Validation <span class="badge badge-pill badge-success">1000 Validation</span></h5>

            <form class="needs-validation" novalidate>
                  <div class="row vertical-gap sm-gap">
                      
                      <div class="col-12">
                          <label for="validationEmail">Validating Your email</label>
                          <input type="email" class="form-control" id="validationEmail" placeholder="Email" required>
                          <div class="invalid-feedback">
                              This value is required.
                          </div>
                      </div>
                    
                      <div class="col-12">
                          <button class="btn btn-brand" type="submit">Validate</button>
                      </div>
                  </div>
                 
              </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-xl-7">
        <div class="card">
          <div class="card-body">

            <div class="d-flex align-items-center">
              <h2 class="card-title mnb-6 mr-auto">Result</h2><button class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" type="button"><span  data-feather="download" class="rui-icon rui-icon-stroke-1_5"></span></button>
            </div>
            <ul class="list-group list-group-flush rui-profile-task-list">
              <li class="list-group-item">
                <div class="rui-task rui-task-danger">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS</a><small class="rui-task-subtitle">INVALID</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">SMTP HOST</a><small class="rui-task-subtitle">SMTP.GMAIL.COM</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">DOMAIN</a><small class="rui-task-subtitle">GMAIL.COM</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">MX RECORD</a><small class="rui-task-subtitle">VALID</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">IP TARGET</a><small class="rui-task-subtitle">17.123.424.12</small></div>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>
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
