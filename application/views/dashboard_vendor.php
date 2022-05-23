<style>
    .modal2 {
   position: absolute;
   top: 10px;
   right: 100px;
   bottom: 0;
   left: 0;
   z-index: 10040;
   overflow: auto;
   overflow-y: auto;
}
.modal3 {
   position: absolute;
   top: 40px;
   right: 3000px;
   bottom: 0;
   left: 0;
   z-index: 10040;
   overflow: auto;
   overflow-y: auto;
}
</style>
<div class="row">
    <div class="col-md-12">
    
        <div class="card">
            <div class="card-header">
                <h3><strong>TOP 10 Principal FMM</strong></h3>
               
            </div>
            <div class="card-body">
                
                <form action="<?=base_url()?>dasboard/vendor" method="get">
                    <div class="row col-md-6 ">
                        
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control select2" name="year" id="year" style="width:100%" >
                                    <option value="">--Pilih Tahun--</option>
                                    <?=$year?>
                                </select>    
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kategori Principal</label>
                                <select class="form-control select2" name="kategori" id="kategori" style="width:100%" >
                                    <option value="">--Pilih Kategori--</option>
                                    <?=$top?>
                                </select>    
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            
                            <button type="submit" class="btn btn-primary" style="margin-top:23px;">Filter Data</button>
                        </div>
                    </div>
                </form>
                
                <table class="responsive">
                    <table class="table table-striped table-bordered" id="dasboardtable">
                        <thead>	
                            <tr>
                                <th >No</th>
                                <th >Principal</th>
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
                                
                                <td width="10px"><?=$no++?></td>
                                <td width="200px">
                                    <a href="#" class="view_data2" id_2="<?=$val->Vendor?>" data-toggle="modal" data-target="#myModal2" >
                                        <?=$val->Vendor?>
                                    </a>
                                    
                                </td>
                                <?php
                                    $skr_1=date('Y');
                                    
                                    $akhir_1=$skr_1-4;
                                    for($y=$skr_1;$y>=$akhir_1;$y--){
                                        
                                        ?>
                                        <td class="text-right">
                                        <a href="#" class="view_data" jenis='1' id="<?=$val->Vendor?>" tahun="<?=$y?>" data-toggle="modal" data-target="#myModal" >
                                            <?=number_format($val->{'tahun_'.$y},0,',','.')?>
                                        </a>
                                            
                                        </td>
                                <?php
                                    }
                                ?>
                                <td class="text-right" width="100px">
                                    <a href="#" class="view_data" jenis='2' id="<?=$val->Vendor?>" grup="<?=$val->avg_year?>" data-toggle="modal" data-target="#myModal" >
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
                </table>
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
            <!-- <div class="modal-body-detail">
            </div> -->
            <div class="table-responsive">
                <table class="cell-border stripe order-column hover" id="datatabledetail">
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

<div class="modal modal2" id="myModal2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <!-- <a href="#" class="view_data3" id_2="<?=$val->Vendor?>" data-toggle="modal" data-target="#myModal3" >
                                        a
                                    </a> -->
            <h4 class="modal-title">Detail Principal</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- <div class="modal-body-detail">
            </div> -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="cell-border stripe order-column hover" id="datatabledetailtype">
                            <thead>
                                <tr>
                                    <th width="10px">No.</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <br><hr><br>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="cell-border stripe order-column hover" id="datatabledetailbc">
                            <thead>
                                <tr>
                                    <th width="10px">No.</th>
                                    <th>Bc</th>
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
  </div>
</div>

<div class="modal modal3" id="myModal3">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Data Detail Type</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- <div class="modal-body-detail">
            </div> -->
            <div class="table-responsive">
                <table class="cell-border stripe order-column hover" id="datatabledetailbc3">
                    <thead>
                        <tr>
                            <th width="10px">No.</th>
                            <th>Bc</th>
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
            // console.log(jenis);
            var tahun = $(this).attr("tahun");
           
            var grupcd = $(this).attr("grup");
            var branchid = $('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
            // var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
            
            var table = $('#datatabledetail').DataTable();

            table.destroy();
            datatable = $('#datatabledetail').DataTable ({
                'bInfo': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                "ajax":
                {
                    "url": "<?php echo base_url()?>dasboard/getDataView3", 
                    "type": "POST",
                    "data":{nama:nama,grupcd:grupcd,branchid:branchid,year:tahun,jenis:jenis}
                },
                'order': [[ 2, 'desc' ]],
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
                    
                    { data: 'amount',className: 'dt-body-right'},
                ],
                dom: 'Bfrtip',
                buttons: [
                    
                    { extend: 'excelHtml5', className: 'btn-primary' },
                    { extend: 'pdfHtml5', className: 'btn-warning' },
                ]
            });
            
        });  
        $(document).on('click', '.view_data2', function(e){  
            e.preventDefault();
            
            $('#myModal2').modal('show');
            var nama = $(this).attr("id_2");  
            var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
            console.log('a');
            var tabletype = $('#datatabledetailtype').DataTable();
            var tablebc = $('#datatabledetailbc').DataTable();

            tabletype.destroy();
            tablebc.destroy();

            datatabletype = $('#datatabledetailtype').DataTable ({
                'bInfo': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                "ajax":
                {
                    "url": "<?php echo base_url()?>dasboard/getDataViewType", 
                    "type": "POST",
                    "data":{nama:nama}
                },
                'order': [[ 2, 'asc' ]],
                'fixedHeader': true,
                'columns': [
                   
                    { data: 'no', orderable: false },
                    { data: 'TypeProduct'},
                    {
                        data: function (row, type, val, meta) {
                            return '' +
                                '<a class="view_data3" id_3="'+row.Vendor+'" type="'+row.TypeProduct+'" data-toggle="modal" data-target="#myModal3">'+
                                row.amount+
                                '</a>&nbsp;'
                                ;
                        },
                        orderable: false,
                        className: 'dt-body-right'
                    },
                    
                ],
                dom: 'Bfrtip',
                buttons: [
                    
                    { extend: 'excelHtml5', className: 'btn-primary' },
                    { extend: 'pdfHtml5', className: 'btn-warning' },
                ]
            });
            datatablebc = $('#datatabledetailbc').DataTable ({
                'bInfo': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                "ajax":
                {
                    "url": "<?php echo base_url()?>dasboard/getDataViewBc", 
                    "type": "POST",
                    "data":{nama:nama,year:year}
                },
                'order': [[ 2, 'asc' ]],
                'fixedHeader': true,
                'columns': [
                    
                    { data: 'no', orderable: false },
                    { data: 'BranchCD'},
                    { data: 'amount',className: 'dt-body-right'},
                ],
                dom: 'Bfrtip',
                buttons: [
                    
                    { extend: 'excelHtml5', className: 'btn-primary' },
                    { extend: 'pdfHtml5', className: 'btn-warning' },
                ]
            });
        }); 
        $(document).on('click', '.view_data3', function(e){  
            e.preventDefault();
            
            $('#myModal3').modal('show');
            var nama = $(this).attr("id_3");  
            var type = $(this).attr("type"); 
            var year = $('#year').val() != '' ? $('#year').val() : 'kosong';
            console.log(nama);
            var tablebc3 = $('#datatabledetailbc3').DataTable();
        
            tablebc3.destroy();

            datatabletype = $('#datatabledetailbc3').DataTable ({
                'bInfo': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                "ajax":
                {
                    "url": "<?php echo base_url()?>dasboard/getDataViewBcDet", 
                    "type": "POST",
                    "data":{nama:nama,year:year,type:type}
                },
                'order': [[ 2, 'asc' ]],
                'fixedHeader': true,
                'columns': [
                   
                    { data: 'no', orderable: false },
                    { data: 'BranchCD'},
                    {
                        data:'amount',
                        className: 'dt-body-right'
                    },
                    
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


