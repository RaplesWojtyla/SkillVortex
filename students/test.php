<?php
// $date1 = new DateTime(date('Y-m-d H:i:s', strtotime('2023-12-05 00:30:00')));
date_default_timezone_set('Asia/Jakarta');

$date1 = date('Y-m-d');
$date2 = date('H:i:s');

$date3 = new DateTime(date('Y-m-d H:i:s', strtotime('2023-12-06 15:49:12'))); // submit

$date_collected = new DateTime(date('Y-m-d H:i:s', strtotime($date1 . $date2))); // tenggat
$formatted_date_collected = $date_collected -> format('Y-m-d H:i:s');

if ($date3 > $date_collected)
    echo "YA";
else
    echo "Tidak";

$diff = $date3 ->diff($date_collected);

$formattedDiff = $diff->format('Terlambat %d days %h hours %i minutes %s seconds');

echo $formattedDiff . "\n";
echo $formatted_date_collected . "\n";
// echo $date1->format('Y-m-d') . " " . $date1->format('H:i:s') . "\n";
// echo $date2->format('Y-m-d H:i:s') . "\n";
?>
