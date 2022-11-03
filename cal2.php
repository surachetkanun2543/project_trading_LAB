<?php 

$earlier = new DateTime("2010-07-06");
$later = new DateTime("2010-07-09");

echo $pos_diff = $earlier->diff($later)->format("%r%a"); //3
echo $neg_diff = $later->diff($earlier)->format("%r%a"); //
