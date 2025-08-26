<?php
$HARI = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
function options_hari($selected='') {
  global $HARI;
  foreach ($HARI as $h) {
    $sel = ($selected===$h) ? 'selected' : '';
    echo "<option value=\"$h\" $sel>$h</option>";
  }
}
?>