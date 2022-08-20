@extends('dashboard.layouts.default')

@section('title', 'Bulk Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="bulk">Home</a></li>
      </ol>
    </nav>
    <h1>Bulk Email Verification</h1>
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
    <div class="rui-profile row vertical-gap">
     <div class="col-lg-6 col-xl-5">
        <div class="card">
          <div class="card-body">
            <h5>This Day You Have Free Single Email Validation <span class="badge badge-pill badge-success">1000 Validation</span></h5>

            <form class="rui-dropzone dropzone" action="#" data-dz-max-mb="0.5" data-dz-max-files="2" data-dz-remove-link="true">
                <input type="file" name="file" class="rui-dropzone-input">
                <!-- Your File-image -->
                <div class="rui-dropzone-images">
                    <img src="./assets/images/icon-rar.svg" alt="" data-dz-type="rar">
                    <img src="./assets/images/icon-zip.svg" alt="" data-dz-type="zip">
                    <img src="./assets/images/icon-html.svg" alt="" data-dz-type="html">
                    <img src="./assets/images/icon-php.svg" alt="" data-dz-type="php">
                    <img src="./assets/images/icon-css.svg" alt="" data-dz-type="css">
                    <img src="./assets/images/icon-js.svg" alt="" data-dz-type="js">
                    <img src="./assets/images/icon-doc.svg" alt="" data-dz-type="doc">
                    <img src="./assets/images/icon-txt.svg" alt="" data-dz-type="txt">
                    <img src="./assets/images/icon-pdf.svg" alt="" data-dz-type="pdf">
                    <img src="./assets/images/icon-xls.svg" alt="" data-dz-type="xls">
                    <img src="./assets/images/icon-empty.svg" alt="" data-dz-type="empty">
                </div>
                <!-- Your Remove-icon -->
                <span data-feather="x" class="rui-icon rui-icon-stroke-1_5 rui-dropzone-remove-icon"></span>

                <div class="dz-message">
                    <span class="rui-dropzone-icon">
                        <span data-feather="upload-cloud" class="rui-icon rui-icon-stroke-0_5"></span>
                    </span>
                    <span class="rui-dropzone-text">
                        Drop files here or click to upload.
                    </span>
                </div>
                <div class="col-12">
                    <button class="btn btn-brand" type="submit">Validate</button>
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
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS VALID</a><small class="rui-task-subtitle">30 EMAIL</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS INVALID</a><small class="rui-task-subtitle">10 EMAIL</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS DISPOSABLE</a><small class="rui-task-subtitle">20 EMAIL</small></div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="rui-task rui-task-success">
                  <div class="rui-task-icon"><span data-feather="check-circle" class="rui-icon rui-icon-stroke-1_5"></span></div>
                  <div class="rui-task-content"><a class="rui-task-title" href="task.html">STATUS CHECK</a><small class="rui-task-subtitle">1 EMAIL</small></div>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>
      </div>
      @endif
    </div>
</div>
@endsection