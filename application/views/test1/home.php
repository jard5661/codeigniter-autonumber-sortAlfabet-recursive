<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>


<div class="box">
  <div class="box-header">
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>NAMA</th>
        </tr>
      </thead>
      <tbody id="data-nama">

      </tbody>
    </table>
  </div>
  
</div>

<div class="box">
<button type="button" class="btn btn-primary" onclick="showname();">TAMPILKAN</button>
  
</div>
<div class="box" id="result"></div>
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
		$.get('<?php echo base_url('Test1/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-nama').html(data);
			refresh();
		});
	}

  function showname() {

    // menampung nama ke dalam array
    
    var data_table = [];
    $.ajax({
      type: "GET",
      dataType: "JSON",
      url: '<?php echo base_url('Test1/nama'); ?>',
      success: function(nama) {
          nama.map(nm =>{
            data_table.push(nm.nama)

          })
          console.log(data_table);
      }
    });
    
    // get data alphabet dari db dan memasukan ke dalam array
    var data = [];
    $.ajax({
      type: "GET",
      dataType: "JSON",
      url: '<?php echo base_url('Test1/alphabet'); ?>',
      success: function(alphabets) {
    
        // convert elment array secara berurutan dengan method map()
        alphabets.karakter.map(alpha => {
          data.push(alpha.alpha)
        })

        console.log(data)

        // sortir nama sesuai dengan huruf depan alphabet
        function alphabetRender() {
            //filter nama sesuai dengan alphabet
          data.map((alpha) => {
            var isi = (data_table.filter(nama => nama.charAt(0).toLowerCase() == alpha.toLowerCase()))
            var Header = document.createElement("H1");
            var headernode = document.createTextNode(alpha);
            console.log(headernode)
            Header.appendChild(headernode)
            Header.style.cssText = 'text-indent: 20px;';

            //menampilkan sortir ke bentuk html
            document.getElementById("result").appendChild(Header)
            isi.map(x => {
              console.log(x)
              var node = document.createElement("div");

              var isinode = document.createTextNode(x);
              node.appendChild(isinode)
              node.style.cssText = 'text-indent: 50px;';
              document.getElementById("result").appendChild(node)
            })

          })
        }
        alphabetRender()

      }
    });

  }
</script>