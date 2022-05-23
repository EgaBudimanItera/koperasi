<!DOCTYPE HTML>
<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="googlebot" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- <link rel="shortcut icon" href=" https://fmm-eps.com/img/title_logo.png"> -->
	<title>Prospect System | PT. Fajar Mas Murni</title>
	<link rel="icon" href="https://fmm-eps.com/img/title_logo.png" type="image/png">
	
	<!-- GOOGLE FONTS -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap">
	
	<!-- THEMIFY ICONS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
	
	<!-- BOOTSTRAP & SITE CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/site.css">
	
	<!-- JQUERY & BOOTSTRAP JS -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
	
	<!-- DATATABLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/DataTables/datatables.custom.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/DataTables/datatables.min.js"></script>
	<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
	
	<!-- JQUERY NUMBER -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery.number.min.js"></script>
	
	<!-- ZEBRA DATEPICKER -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/zebra_datepicker/css/bootstrap/zebra_datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plugins/zebra_datepicker/css/zebra_datepicker.custom.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/zebra_datepicker/zebra_datepicker.min.js"></script>
	
	<!-- SELECT2 -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.custom.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	
	<!-- js custom -->
	<script type="text/javascript" src="<?=base_url()?>assets/js/fmm.js"></script>
	
	
	<script type="text/javascript">
	var site_url = '<?php echo site_url(); ?>';
	
	$().ready(function() {
		$('input').attr('autocomplete', 'off');
		$('input.control-number').number(true, 2, ',', '.');
		$('input.control-number-no').number(true, 0);
		$('input.control-number-digit').number(true, 2);
		$('.angka').number( true, 0 );
		
		$('.select2').select2({ allowClear: true });
		$('.select2-new').select2();
		
		$('.select2-no-clear').select2({ allowClear: false });
		$('.select2-tags').select2({ tags: true });
		$('.select2-modal').select2({ allowClear: true, dropdownParent: $('.modal') });
    	$('.select2-modal-noclear').select2({ allowClear: false, dropdownParent: $('.modal') });
		$('.tanggalan1').Zebra_DatePicker({
			format: 'd M Y'
		});
		$('.tanggalan').Zebra_DatePicker({
			default_position: 'below'
			
		});

		function formatDesign(item) {
			
			var selectionText = item.text.split("-");
			var $returnString = $('<span><b>'+selectionText[0] + '</b></br>' + selectionText[1] + '<br>'+selectionText[2]+'<br>'+selectionText[3]+'<br>'+'</span>');
			return $returnString;
		};
	});
	</script>
	<style>
		td.highlight {
			/* font-weight: bold; */
			color: red;
		}
		td.highlightijo {
			/* font-weight: bold; */
			color: green;
		}
		/* as */
		.warnanyamerah{
			
			color: red;
		}
		.warnanyabiru{
			
			color: blue;
		}
		.tebel{
			font-weight: bold;
			font-size:30px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
			<img src="https://fmm-eps.com/img/site_logo.png" alt="PT FAJAR MAS MURNI"  style="float:left;width:6%;margin-right:0">
			<a class="navbar-brand" href="https://fmm-eps.com/">ProspectSys</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item ">
						<a class="nav-link <?php if ($link == 'customer') echo 'active'; ?>" href="<?php echo site_url('/dasboard'); ?>">
							<i class="ti ti-people"></i> Top Customer
						</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link <?php if ($link == 'vendor') echo 'active'; ?>" href="<?php echo site_url('/dasboard/vendor'); ?>">
							<i class="ti ti-people"></i> Top Principal
						</a>
					</li>
				</ul>
			</div>
			
			
			
		</nav>
	</div>
		
	<div id="main-container" class="container-fluid" style="padding-top:100px">
	<?php if (isset($content)) $this->load->view($content); ?>
	</div>
	<!-- <main class="container-fluid" style="margin-top:10px;">
		
	</main> -->
</body>
</html>