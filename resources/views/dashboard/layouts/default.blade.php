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
        $("#result-bulk").hide();
        $("#bulk-download").hide();
        
        $("#btn-bulk").click(readExcel);
        function changeLoader(text, percent){
          $("#loader-text").html(text);
          $("#loader-progress").html(percent);
          $("#loader-bar").css("width", percent+"%");
          if(percent == 0){
            $("#loader-bulk").show();
          }else if(percent == 100){
            $("#loader-bar").css("width", "100%");
            $("#loader-bulk").hide();
            
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
          
          var token = document.getElementById('csrf').value;
          $.ajaxSetup({
              beforeSend: function(xhr) {
                  xhr.setRequestHeader('X-CSRF-Token', token);
              }
          });
          
          if (input.files && input.files[0]) {
            var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types
            
            if (!isSuccess){
              return alert( 'File tidak tidak digunakan, silahkan menggunakan template yang telah disediakan.' );
            }else{
              
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
                changeLoader("Input "+count+" Email For Verification ", 10);
                sendDataCount(count,resource);
              };
              if(rABS) reader.readAsBinaryString(file); else reader.readAsArrayBuffer(file);
            }
          } else {
            $("#bulkModalErrorBrowser").modal();
          }
        }
        var rABS = true;
        var fileTypes = ['xls', 'xlsx'];
    
        function sendDataCount(vCount,resource){
          
          $.ajax({
              url: "/bulk/check",
              data:{
                count : vCount
              },
              type: "POST",
              success: function(result){
                console.log(result.message);
                if(result.message === 'next'){
                    $('#bulkModal').modal('show');
                    $("#id-text").html(result.re_code);
                    sendDataJson(vCount,resource,result.code,result.re_code);

                } else {
                  $("#bulkModalReachLimit").modal();
                }
              }
              
            });
        }
        function sendDataJson(vCount,resource,code, re_code){
          var valid = 0;
          var invalid = 0;
          var disposable = 0;
          var checkall = 0;
          resource.forEach(sendData);
          function sendData (item, index, arr) {
            $.ajax({
              url: "/bulk/verification",
              data: {
                email : item.email,
                code : code
              },
              type: "POST",
              success: function(result){
                var count = index + 1;
                if(result.status === 'valid'){
                  valid = valid +1;
                } else
                if(result.status === 'invalid'){
                  invalid = invalid +1;
                } else
                if(result.status === 'disposable'){
                  disposable = disposable +1;
                } else {
                  checkall = checkall +1;
                }
                percent = Math.ceil((count/vCount) * 90) + 10;
                if(count >= vCount){
                  changeLoader("Email Verification "+count+"/"+vCount+" ", percent);
                  $('#result-bulk').show();
                  $("#bulk-download").show();
                  $("#valid-text").html(valid);
                  $("#invalid-text").html(invalid);
                  $("#disposable-text").html(disposable);
                  $("#checkall-text").html(checkall);
                  var link = "bulk/export/" + re_code;
                  document.getElementById("link-export").setAttribute("href",link);
                }else{
                  changeLoader("Email Verification "+count+"/"+vCount+" ", percent);
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