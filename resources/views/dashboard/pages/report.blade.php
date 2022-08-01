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
    <div class="rui-swiper" data-swiper-initialslide="2" data-swiper-loop="false" data-swiper-grabcursor="true" data-swiper-center="true" data-swiper-slides="auto" data-swiper-gap="30" data-swiper-speed="400">
            <div class="swiper-container">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="rui-widget rui-widget-chart">
                    <div class="rui-widget-chart-info">
                      <div class="rui-widget-title h2">25%</div><small class="rui-widget-subtitle">Bounce Rate</small>
                    </div>
                    <div class="rui-chartjs-container">
                      <div class="rui-chartist rui-chartist-donut" data-width="150" data-height="150" data-chartist-series="5,2" data-chartist-width="4" data-chartist-gradient="#8e9fff;#2bb7ef"></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="rui-widget rui-widget-chart">
                    <div class="rui-widget-chart-info">
                      <div class="rui-widget-title h2">-12%</div><small class="rui-widget-subtitle">Sales Today</small>
                    </div>
                    <div class="rui-chartjs-container">
                      <div class="rui-chartist rui-chartist-donut" data-width="150" data-height="150" data-chartist-series="2,8" data-chartist-width="4" data-chartist-gradient="#8e9fff;#2bb7ef"></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide rui-swiper-slide-total">
                  <div class="rui-widget rui-widget-chart rui-widget-total">
                    <div class="rui-widget-chart-info">
                      <div class="rui-widget-title h1">$1371.24</div><small class="rui-widget-subtitle">Total Income</small>
                    </div>
                    <div class="rui-widget-total-chart"><canvas class="rui-chartjs rui-chartjs-line rui-chartjs-total" data-height="50" data-chartjs-interval="3000" data-chartjs-line-color="#8e9fff"></canvas></div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="rui-widget rui-widget-chart">
                    <div class="rui-widget-chart-info">
                      <div class="rui-widget-title h2">+14%</div><small class="rui-widget-subtitle">Users Today</small>
                    </div>
                    <div class="rui-chartjs-container">
                      <div class="rui-chartist rui-chartist-donut" data-width="150" data-height="150" data-chartist-series="8,1" data-chartist-width="4" data-chartist-gradient="#8e9fff;#2bb7ef"></div>
                    </div>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="rui-widget rui-widget-chart">
                    <div class="rui-widget-chart-info">
                      <div class="rui-widget-title h2">+10%</div><small class="rui-widget-subtitle">Session</small>
                    </div>
                    <div class="rui-chartjs-container">
                      <div class="rui-chartist rui-chartist-donut" data-width="150" data-height="150" data-chartist-series="5,5" data-chartist-width="4" data-chartist-gradient="#8e9fff;#2bb7ef"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-button-next"><span data-feather="chevron-right" class="rui-icon rui-icon-stroke-1_5"></span></div>
            <div class="swiper-button-prev"><span data-feather="chevron-left" class="rui-icon rui-icon-stroke-1_5"></span></div>
          </div>
          <br/>
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
      </div>
</div>
@endsection