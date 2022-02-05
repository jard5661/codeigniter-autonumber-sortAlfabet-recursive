<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>


<div class="box">
  <div class="box-header">
     <input type="date" id="tanggal">
     <button type="button" class="btn btn-primary" onclick="submit();">SUBMIT</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Kode</th>
        </tr>
      </thead>
      <tbody id="data-nama">

      </tbody>
    </table>
  </div>
  
</div>

<script>

var MyTable = $('#list-data').dataTable({
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
	
	});

  tampilNama();

	function refresh() {
		MyTable = $('#list-data').dataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true,
		
		});
	}

	function tampilNama() {
		$.get('<?php echo base_url('Test2/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-nama').html(data);
			refresh();
		});
	}

	//simpan ke database
  function submit(){
	  var data = ({
			'tanggal' : $('#tanggal').val()
	  });
      console.log(data)
      $.ajax({
				data: data,
				type: 'post',
				url: '<?php echo base_url('Test2/simpan'); ?>',
				crossOrigin: false,
				success: function(result) {
					tampilNama();
				}
			});
  }
  
</script>