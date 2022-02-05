<?php
  $no = 1;
  foreach ($dataTest2 as $test) {
    ?>
    <tr>
      <td><?php echo $test->tanggal; ?></td>
      <td><?php echo $test->kode; ?></td>
    </tr>
    <?php

  }
?>