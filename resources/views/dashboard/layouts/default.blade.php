<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AccMailer.com | Welcome to AccMailer.com</title>
    <meta name="description" content="">
    <meta name="keywords" content="admin, dashboard, template, react, reactjs, html, jquery, clean">
    <meta name="author" content="nK">
    <link rel="icon" type="image/png" href="./assets/images/favicon-32x32.png">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400%7cOpen+Sans:300,400,600%7cPT+Serif:400i">
    <link rel="stylesheet" href="./assets/css/bootstrap-custom.css">
    <link rel="stylesheet" href="./assets/vendor/overlayscrollbars/css/OverlayScrollbars.css">
    <link rel="stylesheet" href="./assets/css/yaybar.css">
    <link rel="stylesheet" href="./assets/vendor/fancybox/dist/jquery.fancybox.css">
    <link rel="stylesheet" href="./assets/vendor/emojionearea/dist/emojionearea.css">
    <link rel="stylesheet" href="./assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="./assets/vendor/chartist/dist/chartist.css">
    <link rel="stylesheet" href="./assets/vendor/jqvmap/dist/jqvmap.css">
    <link rel="stylesheet" href="./assets/vendor/highlightjs/styles/default.css">
    <link rel="stylesheet" href="./assets/vendor/dropzone/dist/dropzone.css">
    <link rel="stylesheet" href="./assets/css/rootui.css">
    <link rel="stylesheet" href="./assets/css/rootui-night.css" media="(night)" class="rui-nightmode-link">
    <link rel="stylesheet" href="./assets/css/custom.css">
  </head>
  <body data-spy="scroll" data-target=".rui-page-sidebar" data-offset="140" class="rui-no-transition rui-navbar-autohide rui-section-lines">
    <div class="rui-page-preloader" role="status">
      <div class="rui-page-preloader-inner">
        <!-- Spinner -->
        <div class="spinner"></div>
          <!-- Loader -->
          <div class="loader">
              <span data-text-preloader="A" class="animated-letters">A</span>
              <span data-text-preloader="C" class="animated-letters">C</span>
              <span data-text-preloader="C" class="animated-letters">C</span>
              <span data-text-preloader="M" class="animated-letters">M</span>
              <span data-text-preloader="A" class="animated-letters">A</span>
              <span data-text-preloader="I" class="animated-letters">I</span>
              <span data-text-preloader="L" class="animated-letters">L</span>
              <span data-text-preloader="E" class="animated-letters">E</span>
              <span data-text-preloader="R" class="animated-letters">R</span>
          </div>
          <p class="fw-5 text-center text-uppercase">Loading</p>
      </div>
    </div>
    <div class="yaybar yay-hide-to-small yay-shrink yay-gestures rui-yaybar">
      @include('dashboard.partials.sidebar')
    </div>
      @include('dashboard.partials.header')
     <div class="rui-page content-wrap">
        @yield('breadcumb')
        @yield('content')
        @include('dashboard.partials.footer')
      </div>
     

    @include('dashboard.partials.modals')

    <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="./assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="./assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/vendor/feather-icons/dist/feather.min.js"></script>
    <script src="./assets/vendor/overlayscrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="./assets/js/yaybar.js"></script>
    <script src="./assets/vendor/object-fit-images/dist/ofi.min.js"></script>
    <script src="./assets/vendor/fancybox/dist/jquery.fancybox.min.js"></script>
    <script src="./assets/vendor/emojione/lib/js/emojione.min.js"></script>
    <script src="./assets/vendor/emojionearea/dist/emojionearea.min.js"></script>
    <script src="./assets/vendor/moment/min/moment.min.js"></script>
    <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="./assets/vendor/chartist/dist/chartist.min.js"></script>
    <script src="./assets/vendor/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="./assets/vendor/highlightjs/highlight.pack.min.js"></script>
    <script src="./assets/vendor/dropzone/dist/min/dropzone.min.js"></script>
    <script src="./assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="./assets/vendor/jqvmap/dist/maps/jquery.vmap.usa.js"></script>
    <script class="rui-page-additional-js">
      (function() {
        // Vector Map
        const data = {
          va: 6278, // Virginia
          pa: 2110, // Pennsylvania
          tn: 2917, // Tennessee
          wv: 1721, // West Virginia
          nv: 900, // Nevada
          tx: 13263, // Texas
          nh: 2917, // New Hampshire
          ny: 19220, // New York
          hi: 2726, // Hawaii
          vt: 1927, // Vermont
          nm: 8650, // New Mexico
          nc: 1720, // North Carolina
          nd: 6780, // North Dakota
          ne: 2980, // Nebraska
          la: 9271, // Louisiana
          sd: 2712, // South Dakota
          dc: 8360, // District of Columbia
          de: 2900, // Delaware
          fl: 9162, // Florida
          ct: 6281, // Connecticut
          wa: 8261, // Washington
          ks: 1611, // Kansas
          wi: 2751, // Wisconsin
          or: 2860, // Oregon
          ky: 9960, // Kentucky
          me: 2710, // Maine
          oh: 8361, // Ohio
          ok: 3816, // Oklahoma
          id: 13251, // Idaho
          wy: 2871, // Wyoming
          ut: 3812, // Utah
          in : 10721, // Indiana
          il: 3816, // Illinois
          ak: 3810, // Alaska
          nj: 8920, // New Jersey
          co: 7350, // Colorado
          md: 1923, // Maryland
          ma: 4816, // Massachusetts
          al: 2710, // Alabama
          mo: 3150, // Missouri
          mn: 1863, // Minnesota
          ca: 9372, // California
          ia: 3726, // Iowa
          mi: 790, // Michigan
          ga: 2860, // Georgia
          az: 8610, // Arizona
          mt: 8785, // Montana
          ms: 3710, // Mississippi
          sc: 7739, // South Carolina
          ri: 1753, // Rhode Island
          ar: 7720, // Arkansas
        };
        $('.rui-jqvmap').vectorMap({
          map: 'usa_en',
          backgroundColor: '#f8f9fa',
          borderColor: '#a4a6a8',
          borderOpacity: 1,
          borderWidth: 0.1,
          color: '#b6b8b9',
          hoverColor: '#4b515b',
          selectedColor: '#393f49',
          showTooltip: true,
          scaleColors: ['#d3d6da', '#8a8f9c'],
          normalizeFunction: 'polynomial',
          values: data,
          onLabelShow: function(event, label, code) {
            if (data[code] === undefined) {
              label.html(`${label.html()} - $0`);
            } else {
              label.html(`${label.html()} - $${data[code]}`);
            }
          },
        });
        // Chart
        $('.rui-chartjs').each(function() {
          const $this = $(this);
          const ctx = $this[0].getContext('2d');
          $this.attr('height', parseInt($this.attr('data-height'), 10));
          // Line Realtime
          if ($this.hasClass('rui-chartjs-line')) {
            const dataInterval = parseInt($this.attr('data-chartjs-interval'), 10);
            const dataBorderColor = $this.attr('data-chartjs-line-color');
            const conf = {};
            const gradient = ctx.createLinearGradient(0, 0, 0, 90);
            gradient.addColorStop(0, Chart.helpers.color(dataBorderColor).alpha(0.1).rgbString());
            gradient.addColorStop(1, Chart.helpers.color(dataBorderColor).alpha(0).rgbString());
            const rand = () => Array.from({
              length: 40
            }, () => Math.floor(Math.random() * (100 - 40) + 40));

            function addData(chart, data) {
              chart.data.datasets.forEach((dataset) => {
                let data = dataset.data;
                const first = data.shift();
                data.push(first);
                dataset.data = data;
              });
              chart.update();
            }
            conf.type = 'line';
            conf.data = {
              labels: rand(),
              datasets: [{
                backgroundColor: gradient,
                borderColor: dataBorderColor,
                borderWidth: 2,
                pointHitRadius: 5,
                pointBorderWidth: 0,
                pointBackgroundColor: 'transparent',
                pointBorderColor: 'transparent',
                pointHoverBorderWidth: 0,
                pointHoverBackgroundColor: dataBorderColor,
                data: rand(),
              }],
            };
            conf.options = {
              tooltips: {
                mode: 'index',
                intersect: false,
                backgroundColor: '#393f49',
                bodyFontSize: 11,
                bodyFontColor: '#d7d9e0',
                bodyFontFamily: '"Open Sans", sans-serif',
                xPadding: 10,
                yPadding: 10,
                displayColors: false,
                caretPadding: 5,
                cornerRadius: 4,
                callbacks: {
                  title: () => {
                    return;
                  },
                  label: (t) => {
                    if ($this.hasClass('rui-chartjs-memory')) {
                      return [`In use ${t.value}%`, `${t.value * 100} MB`];
                    }
                    if ($this.hasClass('rui-chartjs-disc')) {
                      return [`Read ${Math.round((t.value / 80) * 100) / 100} MB/s`, `Write ${Math.round((t.value / 90) * 100) / 100} MB/s`];
                    }
                    if ($this.hasClass('rui-chartjs-cpu')) {
                      return [`Utilization ${t.value}%`, `Processes ${parseInt((t.value / 10), 10)}`];
                    }
                    if ($this.hasClass('rui-chartjs-total')) {
                      return `$${t.value}`;
                    }
                  }
                },
              },
              legend: {
                display: false,
              },
              maintainAspectRatio: true,
              spanGaps: false,
              plugins: {
                filler: {
                  propagate: false,
                },
              },
              scales: {
                xAxes: [{
                  display: false
                }],
                yAxes: [{
                  display: false,
                  ticks: {
                    beginAtZero: true,
                  },
                }],
              },
            };
            const myChart = new Chart(ctx, conf);
            setInterval(() => addData(myChart), dataInterval);
          }
        });
        // Doughnut
        $('.rui-chartist').each(function() {
          const $this = $(this);
          let dataSeries = $this.attr('data-chartist-series');
          const dataWidth = $this.attr('data-width');
          const dataHeight = $this.attr('data-height');
          const dataGradient = $this.attr('data-chartist-gradient');
          const dataBorderWidth = parseInt($this.attr('data-chartist-width'), 10);
          const data = {};
          const conf = {};
          // Data
          if (dataSeries) {
            dataSeries = dataSeries.split(',');
            let dataSeriesNum = [];
            for (i = 0; i < dataSeries.length; i++) {
              dataSeriesNum.push(parseInt(dataSeries[i], 10));
            }
            data.series = dataSeriesNum;
          }
          // Conf
          conf.donut = true;
          conf.showLabel = false;
          if (dataBorderWidth) {
            conf.donutWidth = dataBorderWidth;
          }
          if (dataWidth) {
            conf.width = dataWidth;
          }
          if (dataHeight) {
            conf.height = dataHeight;
          }
          const chart = new Chartist.Pie($this[0], data, conf);
          // Create gradient
          chart.on('created', function(ctx) {
            const defs = ctx.svg.elem('defs');
            defs.elem('linearGradient', {
              id: 'gradient',
              x1: 0,
              y1: 1,
              x2: 0,
              y2: 0
            }).elem('stop', {
              offset: 0,
              'stop-color': dataGradient.split(';')[0]
            }).parent().elem('stop', {
              offset: 1,
              'stop-color': dataGradient.split(';')[1]
            });
          });
        });
      }());
    </script>
    <script src="./assets/js/rootui.js"></script>
    <script src="./assets/js/rootui-init.js"></script>
    <script src="./assets/vendor/selectize/dist/js/standalone/selectize.min.js"></script>
  </body>
</html>