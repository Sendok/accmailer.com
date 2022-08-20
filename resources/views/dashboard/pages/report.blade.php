@extends('dashboard.layouts.default')

@section('title', 'Report Single Email Verification')
@section('breadcumb')
<div class="rui-page-title">
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="report_single">Home</a></li>
      </ol>
    </nav>
    <h1>Report Single Email Verification</h1>
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
    <table class="rui-datatable table">
        <thead>
            <tr>
                <th scope="col">
                    #
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    First
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    Last
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
                <th scope="col">
                    Handle
                    <span data-feather="chevron-down" class="rui-icon rui-icon-stroke-1_5"></span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
    </div>
    @endif
  </div>
</div>
@endsection