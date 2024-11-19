<?php
$jsonFile = 'lennujaamad.json';

$maxId = 0;
if (!empty($data['lennujaam'])) {
    foreach ($data['lennujaam'] as $lennujaam) {
        if (isset($lennujaam['id']) && $lennujaam['id'] > $maxId) {
            $maxId = $lennujaam['id'];
        }
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newLennujaam = [
        'id' => $maxId + 1,
        'marsruut' => [
            'valjumiskoht' => $_POST['valjumiskoht'],
            'saabumiskoht' => $_POST['saabumiskoht'],
            ],
        'valjumisaeg' => $_POST['valjumisaeg'],
        'saabumisaeg' => $_POST['saabumisaeg']
    ];
    $data['lennujaam'][] = $newLennujaam;
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Add to JSON</title>
</head>
<body>
<h1>Lennujaama lisamine</h1>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="xmlToJson.php">Convert XML to JSON</a></li>
        <li><a href="addToJson.php">Lisage lennujaam JSON-i</a></li>
    </ul>
</nav>
<form method="post" id="LenujaamLisamine">
    <label for="valjumiskoht">Valjumiskoht: </label>
    <input type="text" name="valjumiskoht" placeholder="Kirjuta Valjumiskoht" id="valjumiskoht">
    <br>
    <label for="saabumiskoht">Saabumiskoht: </label>
    <input type="text" name="saabumiskoht" placeholder="kirjuta Saabumiskoht" id="saabumiskoht">
    <br>
    <label for="valjumisaeg">Valjumisaeg: </label>
    <input type="date" name="valjumisaeg" id="valjumisaeg">
    <br>
    <label for="saabumisaeg">Saabumisaeg: </label>
    <input type="date" name="saabumisaeg" id="saabumisaeg">
    <br>
    <button type="submit">Lisa</button>
</form>
</body>
</html>
