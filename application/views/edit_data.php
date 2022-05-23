<style>
    #puteran { display:none; }
</style>
<div class="col-12 p-0 mb-4">
	<div class="card">
		<div class="card-header">
			Form Ubah Data
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
                <div class="col-md-2">
                    
                    <button onclick="filterData()" class="btn btn-primary" style="margin-top:23px;">Filter Data</button>
                </div>
                
            </div>
            <br>
            <div class="row" id="puteran">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <strong>Loading...</strong>
                        <div class="spinner-border" role="status">
                        
                        </div>
                    </div>
                </div>
                
            </div>
			<form method="post" action="<?php echo base_url() ?>dasboard/simpan_perbaikan" class="row dk-form dk-form-confirm">
				<div class="col-sm-12 col-md-12">
					<div class="mb-3">
						<button class="btn btn-sm btn-success float-right" type="submit">
							<i class="ti ti-save"></i> Simpan
						</button>
						<div class="clearfix"></div>
					</div>
                    <div class="table-responsive">
                        <table class="table-cell dk-stagging-table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company ID</th>
                                    <th>Branch ID</th>

                                    <th>Tran Date</th>
                                    <th>Fin Period ID</th>
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
                                    <th>Principal </th>
                                    <th>Type Item</th>
                                    <th>Type Product</th>
                                    <th>Debit</th>

                                    <th>Credit</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stagging_null = array(); ?>
                                <?php $stagging_null['id'][] = ''; ?>
                                <?php $stagging_null['CompanyID'][] = ''; ?>
                                <?php $stagging_null['branchID'][] = ''; ?>

                                <?php $stagging_null['TranDate'][] = ''; ?>
                                <?php $stagging_null['FinPeriodID'][] = ''; ?>
                                <?php $stagging_null['Year'][] = ''; ?>

                                <?php $stagging_null['Month'][] = ''; ?>
                                <?php $stagging_null['SubID'][] = ''; ?>
                                <?php $stagging_null['BatchNbr'][] = ''; ?>

                                <?php $stagging_null['RefNbr'][] = ''; ?>
                                <?php $stagging_null['CustomerName'][] = ''; ?>
                                <?php $stagging_null['SectorBusiness'][] = ''; ?>

                                <?php $stagging_null['SalesPerson'][] = ''; ?>
                                <?php $stagging_null['TranDesc'][] = ''; ?>
                                <?php $stagging_null['BranchCD'][] = ''; ?>

                                <?php $stagging_null['GroupCD'][] = ''; ?>
                                <?php $stagging_null['Sub'][] = ''; ?>
                                <?php $stagging_null['InventoryID'][] = ''; ?>

                                <?php $stagging_null['InventoryCD'][] = ''; ?>
                                <?php $stagging_null['InventoryName'][] = ''; ?>
                                <?php $stagging_null['VendorClass'][] = ''; ?>

                                <?php $stagging_null['TypeItem'][] = ''; ?>
                                <?php $stagging_null['TypeProduct'][] = ''; ?>
                                <?php $stagging_null['PrincipalCode'][] = ''; ?>
                                <?php $stagging_null['Vendor'][] = ''; ?>
                                <?php $stagging_null['debit'][] = ''; ?>

                                <?php $stagging_null['credit'][] = ''; ?>
                                <?php $stagging_null['amount'][] = ''; ?>
                            </tbody>
                            
                        </table>
                    </div>
					
				</div>
			</form>
		</div>
	</div>
</div>
