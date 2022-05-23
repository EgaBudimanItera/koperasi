
<div class="row">
    <div class="col-md-12">
    
        <div class="card">
            <div class="card-header">
                <h3><strong>TOP 10 Customer FMM</strong></h3>
               
            </div>
            <div class="card-body">
                <!-- <button class="btn btn-success" id="download" style="margin-bottom:15px;" onclick="downloadExcell()" >EXPORT To XLS</button> -->
                <!-- <a href="<?=base_url()?>dasboard/edit_form" style="margin-bottom:15px;" class="btn btn-danger">Edit Data</a> -->
                <a href="<?=base_url()?>dasboard/import_edit_form" style="margin-bottom:15px;" class="btn btn-danger">Import Edit Data</a>
                <!-- <a href="<?=base_url()?>dasboard/view_data" style="margin-bottom:15px;" class="btn btn-info">View Data</a> -->
                <form action="<?=base_url()?>" method="get">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>BC</label>
                                <select class="form-control select2" name="branchid" id="branchid" style="width:100%" >
                                    <option value="">--Pilih BC--</option>
                                    <?=$bc?>
                                </select>    
                            </div>
                        </div>
                        <!-- <div class="col-md-2">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control select2" name="year" id="year" style="width:100%" >
                                    <option value="">--Pilih Tahun--</option>
                                    <?=$year?>
                                </select>    
                            </div>
                        </div> -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Kategori Customer</label>
                                <select class="form-control select2" name="kategori" id="kategori" style="width:100%" >
                                    <option value="">--Pilih Kategori--</option>
                                    <?=$top?>
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
                            
                            <button type="submit" class="btn btn-primary" style="margin-top:23px;">Filter Data</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dasboardtable">
                        <thead>	
                            <tr>
                               
                                <th >No</th>
                                <th >Customer</th>
                                <th >Bussiness Sector</th>
                                <?=$thtahunnya?>
                                <th >Avg/Tahun</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <?php
                           
                            if(!empty($hasil)){
                                $no=1;
                                foreach($hasil as $h =>$val){
                            ?>
                            <tr>
                               
                                <td><?=$no++?></td>
                                <td>
                                    <?=$val->CustomerName?>
                                </td>
                                <td>
                                    
                                    <?=$val->SectorBusiness?>
                                </td>
                                
                                <?php
                                    $skr_1=date('Y');
                                    
                                    $akhir_1=$skr_1-4;
                                    for($y=$skr_1;$y>=$akhir_1;$y--){
                                        
                                        ?>
                                        <td class="text-right">
                                        <a href="#" class="view_data" jenis='1' id="<?=$val->CustomerName?>" tahun="<?=$y?>" data-toggle="modal" data-target="#myModal" >
                                            <?=number_format($val->{'tahun_'.$y},0,',','.')?>
                                        </a>
                                            
                                        </td>
                                <?php
                                    }
                                ?>
                                <td class="text-right">
                                    <a href="#" class="view_data" jenis='2' id="<?=$val->CustomerName?>" grup="<?=$val->avg_year?>" data-toggle="modal" data-target="#myModal" >
                                        <?=number_format($val->avg_year,0,',','.')?>
                                    </a>
                                    
                                </td>
                            </tr>
                            <?php
                                }
                            }else{
                            ?>
                            <tr>
                                <td colspan='<?=$kolom+2?>'> Data Kosong</td>
                            </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>


<br>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Data Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="cell-border stripe order-column hover" id="datatabledetailcust">
                    <thead>
                        <tr>
                            <th width="10px">No.</th>
                            <th>Tran Date</th>
                            <th>Year</th>

                            <th>Month</th>
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

                            <th>VendorClass</th>
                            <th>Vendor</th>
                            <th>Type Item</th>
                            <th>Type Product</th>
                            <th>Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
<script>

    function downloadExcell(){
        var branchid = $('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
        var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
        var kategori = $('#kategori').val() != '' ? $('#kategori').val() : '10';
        var grupcd=$('#grupcd').val() != '' ? $('#grupcd').val() : 'kosong';
        var base='<?=base_url()?>';
        var input={'branchid':branchid,'year':year,
            'kategori':kategori,'grupcd':grupcd};

        console.log(input);
        
        window.location.href = base+ "dasboard/downloadExcell/"+branchid+"/"+year+"/"+kategori+
        "/"+grupcd;
    }
    $(document).ready(function(){
       
        $(document).on('click', '.view_data', function(e){  
            e.preventDefault();
            
            $('#myModal').modal('show');
            var nama = $(this).attr("id");  
            var jenis = $(this).attr("jenis"); 
            // var grupcd = $(this).attr("grup");
            var tahun = $(this).attr("tahun");
            var branchid = $('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
            // var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
            var base_url = '<?=base_url()?>';
            
            var nama2=nama.replace(" ", "_");
            var table = $('#datatabledetailcust').DataTable();

            table.destroy();
            datatable = $('#datatabledetailcust').DataTable ({
                'bInfo': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                "ajax":
                {
                    "url":  '<?php echo base_url()?>dasboard/getDataView4', 
                    "type": "POST",
                    // "data":{nama:nama,grupcd:grupcd,branchid:branchid,year:tahun,jenis:jenis}
                    "data":{nama:nama,year:tahun,jenis:jenis}
                },
                'order': [[ 2, 'asc' ]],
                'fixedHeader': true,
                'columns': [
                    
                    { data: 'no', orderable: false },
                    { data: 'TranDate' },
                    { data: 'Year'},

                    { data: 'Month'},
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
                    { data: 'TypeProduct'},
                    { data: 'amount'},
                ],
                dom: 'Bfrtip',
                buttons: [
                
                    { extend: 'excelHtml5', className: 'btn-primary' },
                    { extend: 'pdfHtml5', className: 'btn-warning' },
                ]
            });
        });  
        $('#dasboardtable').DataTable({
            searching: false, 
            paging: false, 
            info: false,
            dom: 'Bfrtip',
            buttons: [
               
                { extend: 'excelHtml5', className: 'btn-primary' },
                { extend: 'pdfHtml5', className: 'btn-warning' },
            ]
        });
        
    });
</script>


