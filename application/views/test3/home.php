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
          <th>PATH</th>
          <th>OPSI</th>
        </tr>
      </thead>
      <tbody id="data-nama">

      </tbody>
    </table>
  </div>

</div>

<div class="box">
  <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
      Parent Name
    </span>
    <input type="text" class="form-control" id="parent"></input>
    <div id="tag2"></div>
  </div>

  <div class="input-group form-group">
    <span class="input-group-addon" id="sizing-addon2">
      Child Name
    </span>
    <input class="form-control" id="children">
  </div>

  <div class="form-group">
    <button type="button" class="btn btn-primary" onclick="submit();">Simpan</button>
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
    $.get('<?php echo base_url('Test3/tampil'); ?>', function(data) {
      MyTable.fnDestroy();
      $('#data-nama').html(data);
      refresh();
    });
  }

  

  // memindahkan dari list table ke field input parent
  $(document).ready(function() {
    $(document).on('click', '#pilih', function() {
      var path = $(this).data('path');
      $('#parent').val(path);
    });

  });

  //hapus
  $(document).ready(function() {
    $(document).on('click', '#hapus', function() {
      var id = $(this).data('id');
      var data = ({
        'id': id
      });
      if (confirm('Yakin Hapus')) {
        console.log(id);
        $.ajax({
          data: data,
          type: 'post',
          url: '<?php echo base_url('Test3/hapus'); ?>',
          crossOrigin: false,
          success: function(result) {
            tampilNama();
          }
        });

      }

    });

  });

  //simpan
  function submit() {
    var parent = $('#parent').val();
    var children = $('#children').val();

    var data = ({
      'parent': parent,
      'children': children
    });
    console.log(data)
    $.ajax({
      data: data,
      type: 'post',
      url: '<?php echo base_url('Test3/simpan'); ?>',
      crossOrigin: false,
      success: function(result) {
        tampilNama();
        $('#children').val("");
        $('#parent').val("");
      }
    });
  }

function tampilkan() {
    

    $.ajax({
      type: 'GET',
      dataType: 'JSON',
      url: '<?php echo base_url('Test3/tampil_tree'); ?>',
      success: function(result) {
          data.push(result.elements)
      }
    });
    
    let data = [];
    console.log(data)
    let task = [
    {
        id: '1', task: 'Task A', parent_id: null
    },
    {
        id: '7', task: 'Task B', parent_id: null
    },
    {
        id: '8', task: 'Task C', parent_id: null
    },
    {
        id: '9', task: 'Sub Task C - 1', parent_id: '8'
    },
    {
        id: '2', task: 'Sub 1 Task A - 1', parent_id: '1'
    },
    {
        id: '3', task: 'Sub 1 Task A - 2', parent_id: '1'
    },
    {
        id: '4', task: 'Sub 2 Task A - 1', parent_id: '2'
    },
    {
        id: '5', task: 'Sub 3 Task A - 1', parent_id: '4'
    },
    {
        id: '6', task: 'End', parent_id: '5'
    },
]

    let root=[];
    const idMapping = task.reduce((acc, el, i) => {
    acc[el.id] = i;
    return acc;
    }, {});
  
    function createData2(){
  
      task.forEach(el => {
      // Handle the root element
      if (el.parent_id === null) {
        root.push(el);
        return;
        }
        // Use our mapping to locate the parent element in our data array
        const parentEl = task[idMapping[el.parent_id]];
        // Add our current el to its parent's `children` array
        parentEl.children = [...(parentEl.children || []), el];
      });
    }

    createData2();
    console.log(task);
    console.log(root);


  }

  
</script>