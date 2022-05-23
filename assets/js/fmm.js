
function dk_hitung_bruto()
{   
    var $debitx=$('.dk-stagging-debit');
	var $creditx= $('.dk-stagging-credit');
    var $amountx = $('.dk-stagging-amount');
    var $idx=$('.dk-stagging-id');
    var total=0;
    
    $.each ($idx, function(i, o) {
        var debit = parseInt($($debitx[i]).val());
        var credit = parseInt($($creditx[i]).val());
        var amount = parseInt($($amountx[i]).val());
        
        if (isNaN(debit)) {
			debit = 0;
		}
		
		if (isNaN(credit)) {
			credit = 0;
		}

       
       
        $($amountx[i]).val(amount);

        total = total + amount;

    });
	$('.dk-stagging-total').val(total);
	
}
function getDataType(data){
    var hasil="";
    var isi="";
    var akhir;
    $.post (
        site_url+'/dasboard/ajax_type',
        function(response) {
            
            $.each(response, function(name, value) {
                var type=value.TypeProduct;

                if(type==data){
                    isi='<option value="'+type+'" selected>'+type+'</option>';
                }else{
                    isi='<option value="'+type+'">'+type+'</option>';
                }
                hasil=hasil.concat(isi.toString());
            });
            
            return hasil;
        }
    );
    
}
function filterData(){
    // alert('a');
    $('#puteran').show();
    var cust=$('#cust').val() != '' ? $('#cust').val() : 'kosong';
    var refnbr=$('#refnbr').val() != '' ? $('#refnbr').val() : 'kosong';
    var branchid=$('#branchid').val() != '' ? $('#branchid').val() : 'kosong';
    var year=$('#year').val() != '' ? $('#year').val() : 'kosong';
    var grupcd=$('#grupcd').val() != '' ? $('#grupcd').val() : 'kosong';
    var vendor=$('#vendor').val() != '' ? $('#vendor').val() : 'kosong';
    // if(cust=="kosong"){
    //     alert('Customer Tidak Boleh Kosong');
    //     return false;
    // }
    if(branchid=="kosong"){
        alert('Branch Tidak Boleh Kosong');
        return false;
    }
    if(year=="kosong"){
        alert('Tahun Tidak Boleh Kosong');
        return false;
    }
    // if(grupcd=="kosong"){
    //     alert('Grup CD Tidak Boleh Kosong');
    //     return false;
    // }
    if(vendor=="kosong"){
        alert('Principal Tidak Boleh Kosong');
        return false;
    }
    var $table = $('.dk-stagging-table');
    var input={'cust':cust,'branchid':branchid,
			'year':year,'grupcd':grupcd};
    var me = this;
    $.post (
        site_url+'/dasboard/ajax_stagging'
        , { 'cust':cust,'branchid':branchid,
        'year':year,'grupcd':grupcd,'vendor':vendor,'refnbr':refnbr}
        , function(response) {
            
            $table.find('tbody tr').remove();
            // parse = $.parseJSON(response);
            console.log(response);
            // console.log(parse);
            var markup="";
            var tanda="1";
            
            var isi="";
            let nomor=0;
            $.each(response.data, function(name, value) {
                  nomor   += 1;
                // console.log(response);
                var id=value.id;
                var CompanyID=value.CompanyID;
                var branchID=value.branchID;

                var TranDate=value.TranDate;
                var FinPeriodID=value.FinPeriodID;
                var Year=value.Year;

                var Month=value.Month;
                var SubID=value.SubID;
                var BatchNbr=value.BatchNbr;

                var RefNbr=value.RefNbr;
                var CustomerName=value.CustomerName;
                var SectorBusiness=value.SectorBusiness;

                var SalesPerson=value.SalesPerson;
                var TranDesc=value.TranDesc;
                var BranchCD=value.BranchCD;

                var GroupCD=value.GroupCD;
                var Sub=value.Sub;
                var InventoryID=value.InventoryID;
                
                var InventoryCD=value.InventoryCD;
                var InventoryName=value.InventoryName;
                var VendorClass=value.VendorClass;

                var TypeItem=value.TypeItem;
                var TypeProduct=value.TypeProduct;
                var PrincipalCode=value.PrincipalCode;
                var Vendor=value.Vendor;
                var debit=value.debit;
                var strTypeProduct ="";
                if(TypeProduct !=null){
                    strTypeProduct=TypeProduct.replace(/\s/g, '');
                }
                
                var credit=value.credit;
                var amount=value.amount;
                var hasil="";
                $.each(response.type, function(name2, value2) {
                    var type=value2.TypeProduct;
                    var strType = type.replace(/\s/g, '');
                    let result = type.replace(/^\s+|\s+$/gm,'');
                    if(strType==strTypeProduct){
                        isi='<option value="'+result+'" selected >'+result+'</option>';
                    }else{
                        isi='<option value="'+result+'" >'+result+'</option>';
                    }
                    hasil=hasil.concat(isi.toString());
                });
                // console.log(hasil);
                tanda='2';
                var isi="";
                isi=
                    '<tr>'+
                        '<td>'+nomor+'</td>'+
                        '<td>'+
                            '<input type="hidden" name="stagging[id][]" class="form-control dk-stagging-id" value="'+id+'"  style="width:10px" readonly >'+
                            '<input type="text" name="stagging[CompanyID][]" class="form-control" value="'+CompanyID+'"  style="width:50px"  >'+
                        '</td>'+
                        '<td>'+
                        '<input type="text" name="stagging[branchID][]" class="form-control" value="'+branchID+'"  style="width:50px"  >'+
                        '</td>'+

                        '<td><input type="text" name="stagging[TranDate][]" class="form-control" style="width:100px" value="'+TranDate+'" ></td>'+
                        '<td><input type="text" name="stagging[FinPeriodID][]" class="form-control" style="width:70px" value="'+FinPeriodID+'" ></td>'+
                        '<td><input type="text" name="stagging[Year][]" class="form-control" style="width:50px" value="'+Year+'" ></td>'+

                        '<td><input type="text" name="stagging[Month][]" class="form-control" style="width:50px" value="'+Month+'" ></td>'+
                        '<td><input type="text" name="stagging[SubID][]" class="form-control" style="width:50px" value="'+SubID+'" ></td>'+
                        '<td><input type="text" name="stagging[BatchNbr][]" class="form-control" style="width:120px" value="'+BatchNbr+'" ></td>'+

                        '<td><input type="text" name="stagging[RefNbr][]" class="form-control" style="width:120px" value="'+RefNbr+'" ></td>'+
                        '<td><input type="text" name="stagging[CustomerName][]" class="form-control" style="width:200px" value="'+CustomerName+'" ></td>'+
                        '<td><input type="text" name="stagging[SectorBusiness][]" class="form-control" style="width:200px" value="'+SectorBusiness+'" ></td>'+

                        '<td><input type="text" name="stagging[SalesPerson][]" class="form-control" style="width:150px" value="'+SalesPerson+'" ></td>'+
                        '<td><input type="text" name="stagging[TranDesc][]" class="form-control" style="width:700px" value="'+TranDesc+'" ></td>'+
                        '<td><input type="text" name="stagging[BranchCD][]" class="form-control" style="width:70px" value="'+BranchCD+'" ></td>'+
                        
                        '<td><input type="text" name="stagging[GroupCD][]" class="form-control" style="width:70px" value="'+GroupCD+'" ></td>'+
                        '<td><input type="text" name="stagging[Sub][]" class="form-control" style="width:250px" value="'+Sub+'" ></td>'+
                        '<td><input type="text" name="stagging[InventoryID][]" class="form-control" style="width:70px" value="'+InventoryID+'" ></td>'+
                        
                        '<td><input type="text" name="stagging[InventoryCD][]" class="form-control" style="width:100px" value="'+InventoryCD+'" ></td>'+
                        '<td><input type="text" name="stagging[InventoryName][]" class="form-control" style="width:300px" value="'+InventoryName+'" ></td>'+
                        '<td><input type="text" name="stagging[VendorClass][]" class="form-control" style="width:150px" value="'+VendorClass+'" ></td>'+
                        '<td><input type="text" name="stagging[PrincipalCode][]" class="form-control" style="width:70px" value="'+PrincipalCode+'" ></td>'+
                        '<td><input type="text" name="stagging[Vendor][]" class="form-control" style="width:200px" value="'+Vendor+'" ></td>'+
                        '<td><input type="text" name="stagging[TypeItem][]" class="form-control" style="width:80px" value="'+TypeItem+'" ></td>'+
                        
                        '<td>'+
                            '<select class="form-control select2" name="stagging[TypeProduct][]" data-placeholder="Pilih TypeProduct" style="width:200px">'+
                                '<option value=""></option>'+
                                hasil+
							'</select>'+
                            
                        '</td>'+
                        
                        '<td>'+
                            '<input type="text" name="stagging[debit][]"  class="control-number-digit dk-stagging-debit" style="width:150px" value="'+debit+'">'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="stagging[credit][]"  class="control-number-digit dk-stagging-credit" style="width:150px" value="'+credit+'">'+
                        '</td>'+
                        '<td>'+
                            '<input type="text" name="stagging[amount][]"  class="control-number-digit dk-stagging-amount" style="width:200px" value="'+amount+'">'+
                        '</td>'+
                    '</tr>';
                markup=markup.concat(isi.toString());
                  
            });
            var isibawah="";
            if(tanda=='2'){
                isibawah='<td colspan="27"> TOTAL </td>'+
                    '<td>'+
                        '<input type="text" name="stagging[total][]"  class="control-number-digit dk-stagging-total" style="width:200px" value="">'+
                    '</td>';
                markup=markup.concat(isibawah.toString());
            }
            
            // console.log(markup);
            tableBody = $(".dk-stagging-table tbody");
            tableBody.append(markup);
            dk_hitung_bruto();
            $('.select2').select2({ allowClear: true });
            $('input.control-number-no').number(true, 0);
            $('input.control-number-digit').number(true, 2);
            $('input').attr('autocomplete', 'off');
            $('#puteran').hide();
        }
    );
}


$().ready(function() {
    $('.dk-stagging-table').on('keyup', '.dk-stagging-debit', dk_hitung_bruto);
    $('.dk-stagging-table').on('keyup', '.dk-stagging-credit', dk_hitung_bruto);
    
});