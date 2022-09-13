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
    @elseif(isset($resource["plan_free"]))
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
        
          <div class="alert alert-warning" role="alert">
          Free Plan cannot Access this Bulk Verification, Please upgrade your Plan.
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="rui-profile row vertical-gap">
     @if(isset($resource["bulk.next"]) || isset($resource["bulk.max"]))
     <div class="col-lg-6 col-xl-5">
     @else
     <div class="col-lg-12">
     @endif
        <div class="card">
        
          <div class="card-body">
          <h5>This Day You Have {{ $resource["type"] }} Email Verification <span class="badge badge-pill badge-success">{{ $resource["quota"] }} Validation</span></h5>
          
            <div class="form-group required" enctype="multipart/form-data">
                <input id="csrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                <input id="import_file" type="file" class="form-control" name="import_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
              </div>
              <div class="col-12">
                  <button id="btn-bulk" class="btn btn-brand" type="submit">Validate</button>
              </div>
          </div>
        </div>
      </div>
    </div>
    <br/>
    <div class="table-responsive-md">
    <div class="alert alert-brand" role="alert">
        This Report only Show this month Verification, for more report please contact Support. Thanks
    </div>
    <br/>
    <span class="far fa-file-excel"></span>
    <div class="d-flex align-items-center">
            @if(isset($resource[0]->user_id))
            <h2 class="card-title mnb-6 mr-auto"></h2><a href="{{ route('reportExport.get', ['slug' => $resource[0]->user_id ]) }}" class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" target="_blank"><span  data-feather="download" class="rui-icon rui-icon-stroke-1_5"></span>DOWNLOAD REPORT</a>
            @endif
    </div>
  
    <br/>
    <table class="rui-datatable table" id="report-bulk-list">
        <thead>
            <tr>
                <th scope="col">
                    #
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    FILE
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    VERIFICATION AT
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    ACTION
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
          $count = 1;
          // die(var_dump($resource[1]->id));
          ?>
        @foreach ($report as $data)
         
            <tr>
                <th scope="row"><?=$count?></th>
                <td>{{ $data->bulk_file }}</td>
                <td>{{ $data->created_at }}</td>
                <td><a href="{{ route('bulkFileExport.get', ['slug' => $data->code ]) }}" class="btn btn-brand btn-uniform btn-round btn-sm mnt-8 mnb-8" target="_blank">DOWNLOAD</a>
										</td>
            </tr>
          <?php
          $count++;
          ?>
        @endforeach
        </tbody>
    </table>
    </div>
    @endif
  </div>
</div>
@endsection

