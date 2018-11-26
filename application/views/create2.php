<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>WhatsApp Parsing</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

</head>
<body class="bg-light">

	<section class="jumbotron text-center text-white bg-success py-5">
		<img class="d-block mx-auto mb-4" src="https://www-cdn.whatsapp.net/img/v4/whatsapp-logo.svg" alt="" width="" height="75">
		<h2>WhatsApp Chat Parsing</h2>
		<p class="lead">Version 2.0 BETA</p>

		<a href="<?php echo site_url('parsing/v1'); ?>" class="text-white">Try v1.0 BETA</a>

		<hr class="mb-4">
	</section>
	<div class="container">

		<div class="row">
			<div class="col-md-4 order-md-1">
				<h4 class="mb-3">WhatsApp Chat</h4>
				<?php echo form_open('parsing/store2'); ?>
				<div class="row">
					<div class="col-md-12 mb-3">
						<label>WhatsApp Chat</label>
						<textarea type="text" class="form-control" placeholder="<?php $chat;?>" name="chat" value="" rows="10"></textarea>
					</div>
				</div>
				<hr class="mb-4">
				<input type="submit" name="submit" value="Parsing" class="btn btn-success btn-lg btn-block"/>
				
				<a href="<?php echo site_url('parsing/v2'); ?>" class="btn btn-info btn-lg btn-block">Reset</a>

				<?php echo form_close(); ?>
			</div>

			<div class="col-md-8 order-md-1">
				<hr class="mb-4">
				<h4 class="mb-3">Parsing Result</h4>
				<div class="row">
					<div class="col-md-12 mb-3">
						<input type="button" value="Copy" class="btn btn-sm btn-info"  onclick="selectElementContents(document.getElementById('tablecopy'));"/>
						<label>Parsing Result from WhatsApp Chat</label>
						<br>
						<br>	
						<div class="table-responsive-sm">
							<table id="tablecopy" class="table table-striped table-bordered rounded display">
								<thead>
									<tr>
										<th scope="col">Tanggal</th>
										<th scope="col">Name User</th>
										<th scope="col">Chat</th>
									</tr>
								</thead>

								<?php if(isset($chat))
								{
									$text	= $chat;
									$rows	= explode("\n", $text);
									array_shift($rows);

									echo "<tbody>";
									foreach($rows as $row => $data)
									{
										//get row data
										$row_data = explode(' - ', $data);
										if (!isset($row_data[1])) 
										{
											$row_data[1] = NULL;
										}

										$info[$row]['datetime']     = $row_data[0];
										$info[$row]['name_chat']    = $row_data[1];


										echo "<tr>";

										echo "<td>" . $info[$row]['datetime'] . "</td>";

										$row_chats = explode(': ', $info[$row]['name_chat']);
										foreach($row_chats as $row_chat)
										{
											echo "<td>" . $row_chat . "</td>";
										}
										echo "</tr>";
									}
									echo "</tbody>";
								}?>
							</table>
						</div>
					</div>
				</div>
				<hr class="mb-4">
			</div>

		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" type="text/javascript" charset="utf8"></script>

		<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" type="text/javascript" charset="utf8"></script>
		<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js" type="text/javascript" charset="utf8"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
		<script src="<?php echo base_url("js/script.js"); ?>"></script>

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#tableparsing').DataTable( {
					dom: 'Bfrtip',
					buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5',
					'print'
					]
				} );
			} );

			function selectElementContents(el) {
				var body = document.body, range, sel;
				if (document.createRange && window.getSelection)
				{
					range = document.createRange();
					sel = window.getSelection();
					sel.removeAllRanges();
					try {
						range.selectNodeContents(el);
						sel.addRange(range);
					} catch (e) {
						range.selectNode(el);
						sel.addRange(range);
					}
				} else if (body.createTextRange) {
					range = body.createTextRange();
					range.moveToElementText(el);
					range.select();
				}
			}
		</script>
	</body>
	</html>