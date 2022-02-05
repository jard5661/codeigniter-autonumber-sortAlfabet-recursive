<?php
$no = 1;
$ref = array();
$list = array();
foreach ($elements as $row) {
  $ref = & $refs[$row['id']];

  $ref['parent_id'] = $row['parent_id'];
  $ref['name']      = $row['name'];

  if ($row['parent_id'] == 0)
  {
      echo $list[$row['id']] = & $ref;
  }
  else
  {
     echo $refs[$row['parent_id']]['children'][$row['id']] = & $ref;
  }
}
