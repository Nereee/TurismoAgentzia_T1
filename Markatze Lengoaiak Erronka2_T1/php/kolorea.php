<?php
session_start();
require 'conexioa.php';

header("Content-Type: text/css");

function hexToRgb($hex) {
    $hex = ltrim($hex, '#');
    
    if (strlen($hex) == 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    return [$r, $g, $b];
}

$getKolorea = "SELECT markaren_kolorea FROM agentzia WHERE id_agentzia = '".$_SESSION['id_agentzia']."'";
$result = $conn->query($getKolorea);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $kolorea = $row['markaren_kolorea'];
} else {
    $kolorea = '#6495ED';
}

list($r, $g, $b) = hexToRgb($kolorea);
?>

header {
    display: flex;
    justify-content: start;
    align-items: center;
    flex-wrap: wrap;
    min-height: 15vh;
    padding: 20px;
    background-color: <?php echo $kolorea; ?>;
    min-width: 100vh;
}

input[type="button"]{
    margin: auto;
    padding: 10px;
    border-radius: 20px;
    border-color: <?php echo $kolorea; ?>;
    background-color: <?php echo $kolorea; ?>;
    color: yellow;
    font-size: 30px;
    font-weight: bold;
    height: 40vh;
    width: 45%;
    /* Aquí usamos rgba para dar un valor alpha a la sombra */
    box-shadow: 30px 50px 40px 10px rgba(<?php echo $r; ?>, <?php echo $g; ?>, <?php echo $b; ?>, 0.5);
}