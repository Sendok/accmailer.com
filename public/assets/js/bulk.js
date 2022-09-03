(function($) {
	'use strict';

	var settings = {
		"sDom": "<t><'row'<p i>>",
		"destroy": true,
		"scrollCollapse": true,
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sInfo": "Menampilkan <b>_START_ - _END_</b> dari _TOTAL_ penjualan"
		},
		"iDisplayLength": 5
	};
	var table = $('#modal-excel-list-result');
	table.dataTable(settings);

	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	});

	$('#search-table').keyup(function() {
		table.fnFilter($(this).val());
	});
	
	var previewImage = function(input, block){
		var fileTypes = ['jpg', 'jpeg', 'png'];
		var extension = input.files[0].name.split('.').pop().toLowerCase(); 
		var isSuccess = fileTypes.indexOf(extension) > -1;

		if(isSuccess){
			var reader = new FileReader();

			reader.onload = function (e) {
				block.attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}else{
			alert('ERROR!');
		}

	};

	$("#submit-sn").submit(function(e) {

		// var today = new Date();
		// var submit = new Date($("input[name='tanggal_penjualan']").val());
		// var timeDiff = Math.abs(submit.getTime() - today.getTime());
		// var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		// if(diffDays > 7){
		// 	alert("Mohon maaf!. Penjualan tidak bisa ditambahkan. Penjualan yang bisa ditambahkan adalah penjualan yang terjual maksimal 7 hari sebelumnya.");
		// 	return false;
		// }

		var sn = $("input[name='serial_number']").val();
		if(!(sn.length >= 8 && sn.length <= 10)){
			alert("Serial number yang dimasukkan harus berisikan 8 - 10 karakter.");
			return false;
		}

		if($(this).attr('form-sn') == "check"){
			$.ajax({
				url: "/api/smb_serial_number",
				data:{
					serial_number : sn
				},
				type: "GET", 
				success: function(result){
					if(result == "0"){
						//munculkan
						$("#modal-notdetected").modal('show');
					}else{
						$("#submit-sn").attr('form-sn', 'success');
						$("#submit-sn").submit();
					}
				}
			});
			return false;
		}else{
			if($(this).attr('form-data') == "true"){
				return true;
			}
			$("#modal-sn-txt").html($("input[name='serial_number']").val());
			$("#modal-confirmation-sn").modal('show');
			return false;
		}
	});

	$("input[name='serial_number']").on("change paste keyup", function() {
		$("#submit-sn").attr('form-sn', 'check');
	});

	$("#btn-keep").click(function(e){
		$("#submit-sn").attr('form-sn', 'success');
		$("#submit-sn").submit();
	});
	
	$("#modal-confirmation-btn-ok").click(function(e){
		$("#submit-sn").attr('form-data', 'true');
		$('#submit-sn').submit();
	});

	$("input[name='import_file']").change(function () {
		var filename = $(this).val().split('\\').pop();
		$("input[name='import_text']").val(filename);
	});

	// $("input[name='image_upload']").change(function () {
	// 	previewImage(this, $("#img-preview"));
	// 	previewImage(this, $("#modal-img-preview"));
	// });

	$('#datepicker-sales').datepicker({ format: "dd-mm-yyyy" }).datepicker('setDate', 'today');

	$("#btn-excel").click(readExcel);

	function changeLoader(text, percent){
		if(percent == 0){
			$("#loader-lenovo").show();
		}else if(percent >= 100){
			$("#loader-lenovo").hide();
		}
		$("#loader-text").html(text);
		$("#loader-progress").html(percent);
		$("#loader-bar").css("width", percent+"%");
	}

	var rABS = true;
	var fileTypes = ['xls', 'xlsx'];

	function readExcel() {
		if ( document.querySelector('input[name=f_st]').value == 1 ) {
			return alert( 'Kami mendeteksi adanya aktivitas mencurigakan pada akun toko anda pada pukul '+document.querySelector('input[name=f_time]').value+' WIB. Untuk mengamankan akun Anda, kami membekukan akun toko Anda selama 12 Jam kedepan. Silahkan hubungi kami di support@lenovoid-ra.com untuk permohonan pembukaan akun.' );
		}
		if ( ! window.FileReader ) {
			return alert( 'FileReader API is not supported by your browser.' );
		}
		
		var $i = $("#import_file"),
		input = $i[0];

		// console.log($i);
		console.log("Coba upload saja dengan bijak tidak usah coba - coba ya!");
		if (input.files && input.files[0]) {
			var extension = input.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
			isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

			if (!isSuccess){
				return alert( 'File tidak tidak digunakan, silahkan menggunakan template yang telah disediakan.' );
			}else{
				$("#modal-add-excel").modal('show');
				changeLoader("Membaca File", 0);
				var file = input.files[0]; // The file
				var reader = new FileReader(); // FileReader instance
				reader.onload = function () {
					var data = reader.result;
					if(!rABS) data = new Uint8Array(data);
					var wb = XLSX.read(data, {type: rABS ? 'binary' : 'array'});
					var resource = XLSX.utils.sheet_to_json(wb.Sheets.Sheet1, {header:["no","sn"]});
					var string = '{ "resource" : [';
					var del = '';
					var count = resource.length;
					var count_penjualan = 0;
					var store_string = "";
					if($("#excel-store-id").val() != undefined){
						store_string = ', "user_id" : '+$("#excel-store-id").val();
					}
					for (var i = 1; i <= count - 1; i++) {
						var item = resource[i];
						if(item.sn != "" && item.sn != undefined){
							var sn = item.sn.toUpperCase().replace(/[^0-9a-z]/gi, '');
					 		sn = sn.replace("'", "");
							sn = sn.replace('"', "");
							sn = sn.replace(" ", "");
							if(sn.length > 8){
								if( sn.charAt( 0 ) === 'S' ){
									sn = sn.slice(1);
								}
							} 
							string += del+'{ "serial_number" : "'+sn+'"'+store_string+' }';
							del = ',';
							count_penjualan++;
						}
					}
					string += '] }';
					changeLoader("Memasukkan "+count_penjualan+" penjualan", 25);
					sendSerialNumbers(string);
				};
				if(rABS) reader.readAsBinaryString(file); else reader.readAsArrayBuffer(file);
			}
		} else {
			alert("File not selected or browser incompatible.")
		}

		function sendSerialNumbers(body){
			console.log(body);
			$.ajax({
				url: "/api/smb_sales/add",
				data:{
					body : body
				},
				type: "POST", 
				success: function(result){
					console.log(result);
					changeLoader("Membaca hasil penambahan", 50);
					var data = $.parseJSON(result);
					
					if(data.resource != undefined){
						var x = data.resource.length;

						table.fnClearTable();
						for (var i = 0; i <= x - 1; i++) {
							// console.log(data.resource);
							if(data.resource[i].status == "success"){
								var status = '<span class="label label-success">DITERIMA (SMB)</span>';
							}else if(data.resource[i].status == "not-found"){
								var status = '<span class="label label-invalid">INVALID (SMB)</span>';
							}else if(data.resource[i].status == "pending"){
								var status = '<span class="label label-warning">PROSES VERIFIKASI (SMB)</span>';
							}else if(data.resource[i].status == "consume"){
								var status = '<span class="label label-danger">DITOLAK - CONSUMER (SMB)</span>';
							}else if(data.resource[i].status == "duplicated"){
								var status = '<span class="label label-danger">DITOLAK - DUPLIKAT (SMB)</span>';
							}else if(data.resource[i].status == "success-con"){
								var status = '<span class="label label-success">DITERIMA (CONSUMER)</span>';
							}else if(data.resource[i].status == "duplicated-con"){
								var status = '<span class="label label-danger">DITOLAK - DUPLIKAT (CONSUMER)</span>';
							}else{
								var status = '<span class="label">UNKNOWN</span>';
							}

							if(data.resource[i].status == "success"){
								var insentif = data.resource[i].data.incentive_amount;
							}else{
								var insentif = "-";
							}
							if(data.resource[i].status == "pending"){
								var ket = "Produk masih diidentifikasi";
							}else if(data.resource[i].status == "success"){
								var ket = '<table class="table-excel-result"><tr><td width="45%">KATEGORI</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.category_name+' - '+data.resource[i].data.family_name+'</cite></td></tr><tr><td width="45%">KODE PRODUK</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.product_name+'</cite></td></tr><tr><td width="45%">SERIAL NUMBER</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].serial_number+'</cite></td></tr><tr><td width="45%">INSENTIF</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>Rp. '+data.resource[i].sum_incentive+' </cite></td></tr></table>';
							}else if(data.resource[i].status == "duplicated"){
								var ket = '<table class="table-excel-result"><tr><td width="45%">SERIAL NUMBER</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].serial_number+'</cite></td></tr><tr><td width="45%">DARI</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.store_name+'</cite></td></tr><tr><td width="45%">TANGGAL</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.created_at+'</cite></td></tr></table>';
							}else if(data.resource[i].status == "success-con"){
								var ket = '<table class="table-excel-result"><tr><td width="45%">KATEGORI</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.category_name+' - '+data.resource[i].data.family_name+'</cite></td></tr><tr><td width="45%">KODE PRODUK</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.product_name+'</cite></td></tr><tr><td width="45%">SERIAL NUMBER</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].serial_number+'</cite></td></tr><tr><td width="45%">INSENTIF</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>Rp. '+data.resource[i].sum_incentive+' </cite></td></tr></table>';
							}else if(data.resource[i].status == "duplicated-con"){
								var ket = '<table class="table-excel-result"><tr><td width="45%">SERIAL NUMBER</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].serial_number+'</cite></td></tr><tr><td width="45%">DARI</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.store_name+'</cite></td></tr><tr><td width="45%">TANGGAL</td><td class="text-center" width="10%"> : </td><td width="45%"><cite>'+data.resource[i].data.created_at+'</cite></td></tr></table>';
							}else{
								var ket = "";
							}

							table.dataTable().fnAddData([
								data.resource[i].serial_number,
								status,
								ket
							]);

							changeLoader("Membaca hasil penambahan", 50 + (((i+1)/x)/25));
						}
					}
					changeLoader("Membaca hasil laporan", 75);
					var string1 = "";
					var y = data.report.length;
					for (var i = 0; i <= y - 1; i++) {
						string1 +='<tr><td class="font-montserrat all-caps fs-12">'+data.report[i].text+'</td><td class="text-right b-r b-dashed b-grey"><span class="hint-text small">Qty '+data.report[i].unit+'</span></td><td><span class="font-montserrat fs-18">Rp. '+data.report[i].incentive+'</span></td></tr>';
						changeLoader("Membaca hasil penambahan", 75 + (((i+1)/y)/25));
					}
					var pending = data.report[1].unit;
					var valid = data.report[4].unit + data.report[5].unit + data.report[6].unit;
					var input = data.resource.length;
					var st_id = document.querySelector('input[name=f_id]').value;
					changeView(string1, data.summary.incentive);
				},
				error: function(result){
					// console.log(result.responseText);
				}
			});
		}

		function changeView(string1, string3){
			$("#total-insentif").html(string3);
			$("#table-excel").html(string1);
			changeLoader("Finishing...", 100);
		}
	}

})(window.jQuery);