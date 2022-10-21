<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Invoice</title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #C995F7;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #C995F7;
			}

			body h3 {
				font-weight: 300;
				margin-top: 10px;
				margin-bottom: 20px;
				font-style: italic;
				color: #C995F7;
			}

			body a {
				color: #C995F7;
			}

			.invoice-box {
				max-width: 1000px;
				margin: auto;
				padding: 30px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 30px;
				line-height: 60px;
				color: #900AEC;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #C995F7;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #C995F7;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #C995F7;
				font-weight: bold;
			}
            hr.head {
                border-top: 1px dotted #C995F7;
            }
			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
        <hr class="head"/>
			<table>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td style="font-size: 30px;line-height: 60px; color: #900AEC;">
									<strong><span style="border: 3px solid #900AEC; background-color: #900AEC; color: #FCFEF8">ACC</span><span style="border: 3px solid #900AEC;">MAILER</span></strong>
								</td>
            
								<td>
                                   
									Invoice: #{{ $resource->invoice_number }}<br />
									Created: {{ $resource->created_at }}<br />
									Due    :
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
                    <hr class="head"/>
						<table>
							<tr>
								<td>
									AccMailer.com<br />
									Perum BMW Griya Asan Blok H-7<br />
									Kec. Sumbergempol,Kab. Tulungagung, POS 66235
								</td>

								<td>
                                {{ $resource->name }}<br />
                                {{ $resource->email }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>PAYMENT METHOD</td>

					<td>STATUS #</td>
				</tr>

				<tr class="details">
					<td>{{ $resource->method }}</td>

					<td>{{ $resource->status }}</td>
				</tr>

				<tr class="heading">
					<td>ITEM</td>

					<td>PRICE</td>
				</tr>

				<tr class="item">
					<td>{{ $resource->plan_name }} ( {{ $resource->plan_desc }} )</td>

					<td>{{ $resource->currency }} {{ $resource->price }}</td>
				</tr>

				<tr class="item last">
					<td>Tax (PPN 11%)</td>

					<td>Free</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>Total: {{ $resource->currency }} {{ $resource->price }}</td>
				</tr>
			</table>
		</div>
	</body>
</html>