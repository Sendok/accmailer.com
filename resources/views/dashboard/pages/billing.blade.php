@extends('dashboard.layouts.default')

@section('title', 'Report Single Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('single') }}">Home</a></li>
      </ol>
    </nav>
    <h1>Billing</h1>
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
    <div class="table-responsive-md">
    <div class="alert alert-brand" role="alert">
        This Billing report Show your Billing history
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
                    INVOICE
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    STATUS
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    PLAN
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    PAYMENT METHOD
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    PRICE
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    INVOICE
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
            </tr>
        </thead>
        <tbody>
        <?php
          $count = 1;
          ?>
         @foreach ($resource as $data)
         
         <tr>
             <th scope="row"><?=$count?></th>
             <td>#{{ $data->invoice_number }}</td>
             <td>
               @if($data->status == 'success')
               <span class="badge badge-success">{{ $data->status }}</span>
               @elseif($data->status == 'invalid')
               <span class="badge badge-danger">{{ $data->status }}</span>
               @else
               <span class="badge badge-warning">{{ $data->status }}</span>
               @endif
             </td>
             <td>{{ $data->name }}</td>
             <td>{{ $data->method }}</td>
             <td>{{ $data->currency }} {{ $data->price }}</td>
             <td></td>
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