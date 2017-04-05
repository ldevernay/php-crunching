<?php
// La somme des prix des dix premiers
$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"]; # liste de films


$top10 = array_slice($top, 1, 10);

$total_price = 0;
foreach ($top10 as $key => $film) {
  $total_price += $film["im:price"]["attributes"]["amount"];
}

// echo $total_price;
$top;
$top_cle = [];
// Les dix moins chers du top 100
foreach ($top as $key => $value) {
$value["cle"] = $key;
  array_push($top_cle, $value);
}


function compare($a,$b){
  if ($a["im:price"]["attributes"]["amount"] == $b["im:price"]["attributes"]["amount"]){
    if ($a['cle'] > $b['cle']){
      return 1;
    } else if ($a['cle'] < $b['cle']){
      return -1;
    } return 0;
  }

  return ($a["im:price"]["attributes"]["amount"] < $b["im:price"]["attributes"]["amount"])?-1:1;
}
usort($top_cle, 'compare');

// foreach ($top as $key => $film) {
//   echo $film["im:name"]["label"]." : ".$film["im:price"]["attributes"]["amount"]."<br/>";
// }

foreach ($top_cle as $key => $film) {
  echo $film["cle"].". ".$film["im:name"]["label"]." : ".$film["im:price"]["attributes"]["amount"]."<br/>";
}

echo "<hr/>";

$top10cheapest = array_slice($top_cle, 0, 9);

foreach ($top10cheapest as $key => $film) {
  echo $film["cle"].". ".$film["im:name"]["label"]." : ".$film["im:price"]["attributes"]["amount"]."<br/>";
}

?>
