<?php
$no = 1;
foreach ($elements as $element) {
?>
  <tr>
    <td><?php echo $element->path; ?></td>
    <td class="text-center">
      <button class="btn btn-xs btn-info" id="pilih" data-path="<?php echo $element->path; ?>" >
        <i class="fa fa-check"></i>Pilih</button>
        <button class="btn btn-xs btn-danger" id="hapus" data-id="<?php echo $element->id; ?>" >
        <i class="fa fa-trash"></i>Hapus</button>
    </td>
   
  </tr>
<?php

}
?>