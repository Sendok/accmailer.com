@extends('dashboard.layouts.default')

@section('title', 'Report Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('single') }}">Home</a></li>
      </ol>
    </nav>
    <h1>Report Verification</h1>
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
              You have payment process that yet completed, please complate to continue. <a href="{{ route('payment.cancel.id') }}"><button type="button" class="btn btn-brand btn-hover-outline btn-hover-primary">Click Here to Cancel Payment</button>&nbsp;</a>
            </div>
          </div>
        </div>
      </div>
    @else
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
    <table class="rui-datatable table">
        <thead>
            <tr>
                <th scope="col">
                    #
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    EMAIL
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    STATUS
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    VERIFICATION TYPE
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    SMTP HOST
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    DOMAIN
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <!-- <th scope="col">
                    MX RECORD
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th> -->
                <th scope="col">
                    IP TARGET
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
          $count = 1;
          // die(var_dump($resource[1]->id));
          ?>
        @foreach ($resource as $data)
         
            <tr>
                <th scope="row"><?=$count?></th>
                <td>{{ $data->email }}</td>
                <td>
                  @if($data->status == 'valid')
                  <span class="badge badge-success">{{ $data->status }}</span>
                  @elseif($data->status == 'invalid')
                  <span class="badge badge-danger">{{ $data->status }}</span>
                  @else
                  <span class="badge badge-warning">{{ $data->status }}</span>
                  @endif
                </td>
                <td>{{ $data->validate_type }}</td>
                <td>{{ $data->smtp_host }}</td>
                <td>{{ $data->domain }}</td>
                <!-- <td>{{ $data->mx_record }}</td> -->
                <td>{{ $data->ip_target }}</td>
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