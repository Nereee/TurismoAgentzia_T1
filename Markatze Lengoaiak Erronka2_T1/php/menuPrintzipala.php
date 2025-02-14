<?php
session_start();
require 'conexioa.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Printzipala</title>
    <link rel="stylesheet" href="../css/maketazioa.css">
    <link rel="stylesheet" href="../css/menuPrintzipala.css">
    <link rel="stylesheet" href="../php/kolorea.php">
    <link rel="stylesheet" href="../css/saioaItxi.css">
</head>
<body>
    <header>
        <img id="sessionLogoa" src="<?php if(isset($_SESSION['agentziaLogoa'])){
            echo htmlspecialchars($_SESSION['agentziaLogoa']); }?>" alt="Logoa">
        <div id="sessionIzena"><?php if(isset($_SESSION['agentziaIzena'])){
            echo htmlspecialchars($_SESSION['agentziaIzena']); }?></div>
        <input type="submit" id="saioaitxi" value="Itxi saioa">
    </header>
    <section>
        <input type="button" id="bidaiaErregistratu" value="BIDAIAK ERREGISTRATU" onclick="location.href= 'bidaiakErregistratu.php'">
        <input type="button" id="zerbitzuaErregistratu" value="ZERBITZUAK ERREGISTRATU" onclick="location.href= 'zerbitzuakErregistratu.php'">

        <div class="overlay" id="overlay" style='display:none'>
            <div class="popup" id="popup">
                <br><br>
                <label id="itxi"><b>Saioa itxi nahi duzu?</b></label>
                <br>
                <input type="submit" id="saioaitxipopup" value="Saioa Itxi">
                <input type="submit" id="ezitxi" value="Oraindik ez">
            </div>
        </div>
    </section>
    <script src="../js/saioaitxi.js"></script>
</body>
</html>