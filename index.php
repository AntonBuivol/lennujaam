<?php
$xml = simplexml_load_file('lennujaamad.xml');

$searchValjuCity = isset($_GET['searchValjuCity']) ? $_GET['searchValjuCity'] : '';
$searchSaabuCity = isset($_GET['searchSaabuCity']) ? $_GET['searchSaabuCity'] : '';

$searchDateValja = isset($_GET['searchDateValja']) ? $_GET['searchDateValja'] : '';
$searchDateSaabu = isset($_GET['searchDateSaabu']) ? $_GET['searchDateSaabu'] : '';

$searchDateValjaDateTime = $searchDateValja ? new DateTime($searchDateValja) : null;
$searchDateSaabuDateTime = $searchDateSaabu ? new DateTime($searchDateSaabu) : null;

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Lennujaamad</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<h1>Lennujaama Haldussüsteem</h1>
<a href="xmlToJson.php">JSON</a>
<form action="index.php">
    <input type="text" name="searchValjuCity" placeholder="Otsi Valjumiskoht" id="search">
    <input type="text" name="searchSaabuCity" placeholder="Otsi Saabumiskoht" id="search">
    <input type="date" name="searchDateValja">
    <input type="date" name="searchDateSaabu">
    <button type="submit">Otsi</button>
</form>
<br>
<table>
    <tr>
        <th>Valjumiskoht</th>
        <th>Saabumiskoht</th>
        <th>Valjumisaeg</th>
        <th>Saabumisaeg</th>
    </tr>
<?php
foreach ($xml->lennujaam as $lennujaam):

    $valjumiskoht = $lennujaam->marsruut->valjumiskoht;
    $saabumiskoht = $lennujaam->marsruut->saabumiskoht;
    $valjumisaeg = $lennujaam->valjumisaeg;
    $saabumisaeg = $lennujaam->saabumisaeg;
    $valjumisaegDateTime = new DateTime($valjumisaeg);
    $saabumisaegDateTime = new DateTime($saabumisaeg);

if (($searchValjuCity === "" || strpos($valjumiskoht, $searchValjuCity)  !== false) &&
    ($searchSaabuCity === "" || strpos($saabumiskoht, $searchSaabuCity)  !== false) &&
    ($searchDateValja === "" || $valjumisaegDateTime >= $searchDateValjaDateTime) &&
    ($searchDateSaabu === "" || $saabumisaegDateTime <= $searchDateSaabuDateTime)):
?>
    <tr>
        <td><?php echo $lennujaam->marsruut->valjumiskoht;?></td>
        <td><?php echo $lennujaam->marsruut->saabumiskoht;?></td>
        <td><?php echo $lennujaam->valjumisaeg;?></td>
        <td><?php echo $lennujaam->saabumisaeg;?></td>
    </tr>
<?php endif;
endforeach; ?>
</table>