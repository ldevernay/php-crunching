<?php

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"]; # liste de films


$top10 = array_slice($top, 1, 10);

$total_price = 0;
foreach ($top10 as $key => $film) {
  $total_price += $film["im:price"]["attributes"]["amount"];
}

echo $total_price;

 ?>
