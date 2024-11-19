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
<form method="post">
    <label for="valjumiskoht">Valjumiskoht: </label>
    <input type="text" name="valjumiskoht" placeholder="Kirjuta Valjumiskoht" id="valjumiskoht">

    <label for="saabumiskoht">Saabumiskoht: </label>
    <input type="text" name="saabumiskoht" placeholder="kirjuta Saabumiskoht" id="saabumiskoht">

    <label for="valjumisaeg">Valjumisaeg: </label>
    <input type="date" name="valjumisaeg" id="valjumisaeg">

    <label for="saabumisaeg">Saabumisaeg: </label>
    <input type="date" name="saabumisaeg" id="saabumisaeg">

    <input type="submit" value="Lisa">
</form>
</body>
</html>
