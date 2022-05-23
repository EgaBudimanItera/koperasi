<style>
    #puteran2 { display:none; }
</style>
<div class="col-12 p-0 mb-4">
	<div class="card">
		<div class="card-header">
			Form Import Ubah Data
			<a href="<?=base_url()?>" class="btn btn-outline-primary btn-sm btn-header">
				<i class="ti ti-back-left"></i> Kembali
			</a>
		</div>
		<div class="card-body">
			
			<div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>No Invoice</label>
                        <input type="text" class="form-control" name="refnbr" id="refnbr">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-control select2" name="cust" id="cust" style="width:100%" >
                            <option value="">--Pilih Customer--</option>
                            <?=$cust?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>BC</label>
                        <select class="form-control select2" name="branchid" id="branchid" style="width:100%" >
                            <option value="">--Pilih BC--</option>
                            <?=$bc?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Tahun</label>
                        <select class="form-control select2" name="year" id="year" style="width:100%" >
                            <option value="">--Pilih Tahun--</option>
                            <?=$year?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Grup Produk</label>
                        <select class="form-control select2" name="grupcd" id="grupcd" style="width:100%" >
                            <option value="">--Pilih Group--</option>
                            <?=$grupcd?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Principal</label>
                        <select class="form-control select2" name="vendor" id="vendor" style="width:100%" >
                            <option value="">--Pilih Principal--</option>
                            <?=$vendor?>
                        </select>    
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary view_data" >Filter Data</button>
                    <a href="javascript:void(0)" class="btn btn-success" id="downloadExcel" onclick="downloadExcellajax()">
                        <i class="fas fa-download"></i> Download Excel
                    </a>
                    <a href="<?=base_url()?>download/donlodtemplate" target="_blank" class="btn btn-danger" id="downloadExcelType">
                        <i class="fas fa-download"></i> Download Type Product
                    </a>
                </div>
                
            </div>
            <div class="row" id="puteran2">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <strong>Loading...</strong>
                        <div class="spinner-border" role="status">
                        
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row" style="margin-top:20px;margin-bottom:20px;">
                <div class="col-md-12">
                    <strong>Form Upload Edit Data</strong>
                    <br>
                    <br>
                    <form action="<?=base_url()?>dasboard/edit_proses" method="POST" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-1">
                                File Excell
                            </div>
                            <div class="col-md-4">
                            <input type="file"  required name="fileExcel" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
                            </div>
                            <div class="col-md-4">
                            <input type="submit" value="Edit" class="btn btn-warning">
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
            <div style="margin-top:10px;" class="table-responsive">
            
                <table class="cell-border stripe order-column hover" id="datastagging">
                    <thead>
                        <tr>
                            <th width="10px">No.</th>
                            <th>ID</th>
                            <th>Tran Date</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Sub Id</th>
                            <th>Batch NBR</th>
                            <th>Ref NBR</th>
                            <th>Customer Name</th>
                            <th>Sector Business</th>
                            <th>Sales Person</th>
                            <th>Tran Desc</th>
                            <th>Branch CD</th>
                            <th>Group CD</th>
                            <th>SUB</th>
                            <th>Inventory ID</th>
                            <th>Inventory CD</th>
                            <th>Inventory Name</th>
                            <th>Principal Class</th>
                            <th>Principal Code</th>
                            <th>Principal</th>
                            <th>Type Item</th>
                            <th>Type Product</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    
                </table>
            </div>
		</div>
	</div>
</div>

<script>
    $(document).ready(function(){
       
       $(document).on('click', '.view_data', function(e){  
           e.preventDefault();
           var cust = $('#cust').val() != '' ? $('#cust').val() : 'kosong';  
           var vendor = $('#vendor').val() != '' ? $('#vendor').val() : 'kosong';
           var grupcd = $('#grupcd').val() != '' ? $('#grupcd').val() : 'kosong';
           var branchid = $('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
           var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
           var refnbr=$('#refnbr').val() != '' ? $('#refnbr').val() : 'kosong';
           var base_url = '<?=base_url()?>';
           var table = $('#datastagging').DataTable();

           table.destroy();
           datatable = $('#datastagging').DataTable ({
               'bInfo': true,
               'serverSide': true,
               'serverMethod': 'post',
               
               "ajax":
               {
                   "url":  '<?php echo base_url()?>dasboard/getDataView5', 
                   "type": "POST",
                   "data":{cust:cust,vendor:vendor,grupcd:grupcd,branchid:branchid,year:year,refnbr:refnbr}
               },
               'order': [[ 2, 'asc' ]],
               'fixedHeader': true,
               'columns': [
                //    1
                   { data: 'no', orderable: false },
                   { data: 'id' },
                   { data: 'TranDate' },
                // 2
                  
                   { data: 'Year'},
                // 3
                   { data: 'Month'},
                   { data: 'SubID'},
                   { data: 'BatchNbr'},
                // 4
                   { data: 'RefNbr'},
                   { data: 'CustomerName'},
                   { data: 'SectorBusiness'},
                // 5
                   { data: 'SalesPerson'},
                   { data: 'TranDesc'},
                   { data: 'BranchCD'},
                // 6
                   { data: 'GroupCD'},
                   { data: 'Sub'},
                   { data: 'InventoryID'},
                // 7
                   { data: 'InventoryCD'},
                   { data: 'InventoryName'},
                   { data: 'VendorClass'},
                   { data: 'PrincipalCode'},
                // 8
                   { data: 'Vendor'},
                   { data: 'TypeItem'},
                   { data: 'TypeProduct'},
                   { data: 'debit'},
                // 9
                   { data: 'credit'},
                   { data: 'amount'},
               ],
                dom: 'Blfrtip',
                buttons: [
                    'excel', 
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    }
                ],
                lengthMenu: [
                [ 50,100,200,300,400,500,600,1000,2000,3000,-1], [ 50,100,200,300,400,500,600,1000,2000,3000,'Show All']
                ]
                //    dom: 'Bfrtip',
                //    buttons: [
                
                //        { extend: 'excelHtml5', className: 'btn-primary' },
                //        { extend: 'pdfHtml5', className: 'btn-warning' },
                //    ],
            //    lengthMenu: [
            //         [ 50,100,200,300,400,500,600,1000,2000,3000], [ 50,100,200,300,400,500,600,1000,2000,3000]
            //    ]
           });
       });  
        
    });
    function downloadExcell(){
        alert("export into excel");
        $('#puteran2').show();
        var site_url = '<?php echo site_url(); ?>';
        var cust = $('#cust').val() != '' ? $('#cust').val() : 'kosong';  
        var vendor = $('#vendor').val() != '' ? $('#vendor').val() : 'kosong';
        var grupcd = $('#grupcd').val() != '' ? $('#grupcd').val() : 'kosong';
        var branchid = $('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
        var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
        var refnbr=$('#refnbr').val() != '' ? $('#refnbr').val() : 'kosong';
        var input={'cust':cust,'vendor':vendor,
            'grupcd':grupcd,'branchid':branchid,'year':year};

        
        window.location.href =site_url+"download/donlodexcel/"+cust+"/"+vendor+"/"+grupcd+"/"+branchid+"/"+year+'/'+refnbr;
        $('#puteran2').hide();
    }

    function downloadExcellajax(){
        $('#puteran2').show();
        var site_url = '<?php echo site_url(); ?>';
        var cust = $('#cust').val() != '' ? $('#cust').val() : 'kosong';  
        var vendor = $('#vendor').val() != '' ? $('#vendor').val() : 'kosong';
        var grupcd = $('#grupcd').val() != '' ? $('#grupcd').val() : 'kosong';
        var branchid = $('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
        var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
        var refnbr=$('#refnbr').val() != '' ? $('#refnbr').val() : 'kosong';
        var input={'cust':cust,'vendor':vendor,
            'grupcd':grupcd,'branchid':branchid,'year':year};
            $.ajax({
                type:'POST',
                url:'<?=base_url()?>download/donlodexcelajax',
                data: {'cust':cust,'vendor':vendor,'grupcd':grupcd,'branchid':branchid,'year':year,'refnbr':refnbr},
                dataType:'json',
                success: function(data){
                    console.log(data);
                }
            });
        
        $('#puteran2').hide();
    }
    
</script>
