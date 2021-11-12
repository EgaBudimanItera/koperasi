
   	</section>
		</div>
      <footer class="main-footer">
        
        <div class="footer-right">
        © UPT TIK 2020
        </div>
      </footer>
    </div>


  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?=base_url()?>assets/js/stisla.js"></script>
  <!-- <script src="<?=base_url()?>assets/js/page/forms-advanced-forms.js"></script> -->


  <!-- Template JS File -->
  <script src="<?=base_url()?>assets/js/scripts.js"></script>
  <script src="<?=base_url()?>assets/js/custom.js"></script>
  <script src="<?=base_url()?>assets/datetimepicker/jquery.datetimepicker.full.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  
  <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/datetime-moment.js"></script>
  <script src="<?=base_url()?>assets/js/select2.full.min.js"></script>
  <script>
  $(document).ready(function () {
  $.datetimepicker.setLocale('id');
  
  $('.datetimepicker').datetimepicker({
    format:'Y/m/d H:i:s',
  lang:'id'
  });

  $('.datepicker').datetimepicker({
    format:'d-m-Y',
    timepicker:false,
    lang:'id'
  });
   $('.dataTableExport').DataTable({
        // 'ordering' : false,
        // responsive: true,
        
         dom: 'Blfrtip',
        "aLengthMenu": [50, 75, 100, 150, 200],

        buttons: [
            'copy', 'csv','excel', 'pdf', 'print'
        ],
    });

    $('.dataTableExport_x').DataTable({
        'ordering' : false,
         responsive: true,
        
         dom: 'Blfrtip',
        "aLengthMenu": [200, 500, 1000],

        buttons: [
           'excel', 'pdf', 'print'
        ],
    });

    // $('.select2modal').select2({
    //     // width: '100%'                        
    // })
  });
  
  
  </script>
  
</body>
</html>
<?php
if (!empty($script))$this->load->view($script);
?>