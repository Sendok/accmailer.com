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
    <style type="text/css">
      .bulk-loader{
        height: 100%;
        z-index: 0;
        width: 100%;
        position: absolute;
        background-color: rgba(255,255,255,0.8);
        top: 0;
        left: 0;
      }
      

    </style>
  </head>
  <body data-spy="scroll" data-target=".rui-page-sidebar" data-offset="140" class="rui-no-transition rui-navbar-autohide rui-section-lines">
 
  <div class="rui-page-preloader" role="status">
      <div class="rui-page-preloader-inner">
        <!-- Spinner -->
        <div class="spinner"></div>
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
    <script src="./assets/xlsx/xlsx.full.min.js"></script>
    <script class="rui-page-additional-js">
      (function() {
       

        $("#btn-bulk").click(readExcel);
        function changeLoader(text, percent){
          $("#loader-text").html(text);
          $("#loader-progress").html(percent);
          $("#loader-bar").css("width", percent+"%");
          if(percent == 0){
            $("#loader-bulk").show();
          }else if(percent == 100){
            $("#loader-bulk").hide();
            $("#loader-bar").css("width", "0%");
          }
        }

        var rABS = true;
        var fileTypes = ['xls', 'xlsx'];

        function readExcel() {
          if ( ! window.FileReader ) {
            return $("#bulkModalErrorFile").modal();
            return alert( 'FileReader API is not supported by your browser.' );
          }
          
          var $i = $("#import_file"),
          input = $i[0];
          

          
          if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
            
            if (!isSuccess){
              return alert( 'File tidak tidak digunakan, silahkan menggunakan template yang telah disediakan.' );
            }else{
              $("#bulkModal").modal();
              changeLoader("Starting Email", 99);
              var file = input.files[0]; // The file
              var reader = new FileReader(); // FileReader instance
              reader.onload = function () {
                var data = reader.result;
                
                if(!rABS) data = new Uint8Array(data);
                var wb = XLSX.read(data, {type: rABS ? 'binary' : 'array'});
                var resource = XLSX.utils.sheet_to_json(wb.Sheets.Sheet1, {header:["email"]});
                var count = resource.length-1;
                resource.splice(0,1);
                console.log(count)
                // changeLoader("Input "+count+" Email", 15);
                sendDataJson(resource);
              };
              if(rABS) reader.readAsBinaryString(file); else reader.readAsArrayBuffer(file);
            }
          } else {
            $("#bulkModalErrorBrowser").modal();
            alert("File not selected or browser incompatible.")
          }
        }
        var rABS = true;
        var fileTypes = ['xls', 'xlsx'];


        function sendDataJson(vData){
          var len = 100;
          var ar_len = Math.ceil(vData.length/len);
          var count = 0;
          for (var i = 0; i < ar_len ; i++) {
            var start = i * len;
            var end = (i + 1) * len;
            var newData = vData.slice(start, end);
            console.log(JSON.stringify(newData));
            $.ajax({
              url: "scripts/request.php",
              data:{
                vData : newData
              },
              type: "POST",
              success: function(result){
                console.log(result);
                count += 100;
                percent = Math.ceil((count/vData.length) * 90) + 10;
                if(count >= vData.length){
                  // finishing();
                }else{
                  changeLoader("Validasi serial number "+count+"/"+vData.length, percent);
                }
              }
            });
          }
        }

      }());
      function copyText(element) {
        var range, selection, worked;

        if (document.body.createTextRange) {
          range = document.body.createTextRange();
          range.moveToElementText(element);
          range.select();
        } else if (window.getSelection) {
          selection = window.getSelection();        
          range = document.createRange();
          range.selectNodeContents(element);
          selection.removeAllRanges();
          selection.addRange(range);
        }
        
        try {
          document.execCommand('copy');
          alert('API key copied');
        }
        catch (err) {
          alert('Unable to copy text');
        }
      }
    </script>
    <script src="./assets/js/rootui.js"></script>
    <script src="./assets/js/rootui-init.js"></script>
    <script src="./assets/vendor/selectize/dist/js/standalone/selectize.min.js"></script>
  </body>
</html>