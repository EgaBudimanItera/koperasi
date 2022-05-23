
<div class="col-12 p-0 mb-4">
	<div class="card">
		<div class="card-header">
			View Data
			<a href="<?=base_url()?>" class="btn btn-outline-primary btn-sm btn-header">
				<i class="ti ti-back-left"></i> Kembali
			</a>
		</div>
		<!-- <div class="card-body">
			<?php if ($this->session->flashdata('status_simpan') == 'ok'): ?>
			<div class="alert alert-success">Data berhasil disimpan.</div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('status_simpan') == 'tidak_lengkap'): ?>
			<div class="alert alert-danger"><?php echo $this->session->flashdata('validation_errors'); ?></div>
			<?php endif; ?>
			<div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-control select2" name="cust" id="custview" style="width:100%" >
                            <option value="">--Pilih Customer--</option>
                            <?=$cust?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>BC</label>
                        <select class="form-control select2" name="branchid" id="branchidview" style="width:100%" >
                            <option value="">--Pilih BC--</option>
                            <?=$bc?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tahun</label>
                        <select class="form-control select2" name="year" id="yearview" style="width:100%" >
                            <option value="">--Pilih Tahun--</option>
                            <?=$year?>
                        </select>    
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Grup Produk</label>
                        <select class="form-control select2" name="grupcd" id="grupcdview" style="width:100%" >
                            <option value="">--Pilih Group--</option>
                            <?=$grupcd?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Vendor</label>
                        <select class="form-control select2" name="vendor" id="vendorview" style="width:100%" >
                            <option value="">--Pilih Vendor--</option>
                            <?=$vendor?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <button onclick="filterDataView()" class="btn btn-primary" style="margin-top:23px;">Filter Data</button>
                </div>
            </div>
			
		</div> -->
        <div class="card-body">
            <div class="table-responsive">
                <!-- <div class="modal-body-detail">
                </div> -->
                <table class="cell-border stripe order-column hover" id="datatableview">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th width="10px">No.</th>
                            <th>Company ID</th>
                            <th>Branch ID</th>
                            <th>Tran Date</th>
                            <th>FIN Period ID</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Sub ID</th>
                            <th>Batch NBR</th>
                            <th>Ref NBR</th>
                            <th>Customer Name</th>
                            <th>Sector Business</th>
                            <th>Sales Person</th>
                            <th>Tran Desc</th>
                            <th>Branch CD</th>
                            <th>Group CD</th>
                            <th>Sub</th>
                            <th>Inventory ID</th>
                            <th>Inventory CD</th>
                            <th>Inventory Name</th>
                            <th>VendorClass</th>
                            <th>Vendor</th>
                            <th>Type Item</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
	</div>
</div>


<script type="text/javascript">

function init_datatable()
{
    var cust=$('#custview').val() != '' ? $('#custview').val() : 'kosong';
    var branchid=$('#branchidview').val() != '' ? $('#branchidview').val() : 'kosong';
    var year=$('#yearview').val() != '' ? $('#yearview').val() : 'kosong';
    var grupcd=$('#grupcdview').val() != '' ? $('#grupcdview').val() : 'kosong';
    var vendor=$('#vendorview').val() != '' ? $('#vendorview').val() : 'kosong';

	datatable = $('#datatableview').DataTable ({
		'bInfo': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': '<?php echo site_url('/dasboard/getDataView2'); ?>',
        
		'order': [[ 2, 'asc' ]],
		'fixedHeader': true,
        'columns': [
			{
				data: function (row, type, val, meta) {
                    return '' +
                        '<a class="btn btn-action btn-primary" href="#">'+
                            '<i class="ti ti-pencil-alt"></i>'+
                        '</a>&nbsp;'
						;
                },
				orderable: false,
				className: 'dt-body-center'
			},
            { data: 'no', orderable: false },
			{ data: 'CompanyID'},
			{ data: 'branchID'},
			{ data: 'TranDate' },
			{ data: 'FinPeriodID' },
			{ data: 'Year'},
            { data: 'Month'},
            { data: 'SubID'},
            { data: 'BatchNbr'},
            { data: 'RefNbr'},
            { data: 'CustomerName'},
            { data: 'SectorBusiness'},
            { data: 'SalesPerson'},
            { data: 'TranDesc'},
            { data: 'BranchCD'},
            { data: 'GroupCD'},
            { data: 'Sub'},
            { data: 'InventoryID'},
            { data: 'InventoryCD'},
            { data: 'InventoryName'},
            { data: 'VendorClass'},
            { data: 'Vendor'},
            { data: 'TypeItem'},
            { data: 'debit',className: 'dt-body-right'},
            { data: 'credit',className: 'dt-body-right'},
            { data: 'amount',className: 'dt-body-right'},
		]
	});
}


function filterDataView(){
    init_datatable();
}
$().ready(function() {
	
	init_datatable();
	
});
</script>