<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION['izena'] = $_POST['izena'];
    $_SESSION['bidaiamota'] = $_POST['bidaiamota'];
    $_SESSION['hasieradata'] = $_POST['hasieradata'];
    $_SESSION['amaieradata'] = $_POST['amaieradata'];
    $_SESSION['herrialdea'] = $_POST['herrialdea'];
    $_SESSION['deskribapena'] = $_POST['deskribapena'];
    $_SESSION['kanpZerb'] = $_POST['kanpZerb'];

    $nombre = $_SESSION['izena'];
    $bidaiamota = $_SESSION['bidaiamota'];
    $hasieradata = $_SESSION['hasieradata'];
    $amaieradata = $_SESSION['amaieradata'];
    $herrialdea = $_SESSION['herrialdea'];
    $deskribapena = $_SESSION['deskribapena'];
    $kanpoZerbitzuak = $_SESSION['kanpZerb'];

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO bidaiak (izena, deskribapena, hasiera_data, amaiera_data, ez_barne_zerbitzuak, bidaia_mota_kodea, agentzia_kodea, herrialdeak_kodea) 
                VALUES ('$nombre', '$deskribapena', '$hasieradata', '$amaieradata', '$kanpoZerbitzuak', '$bidaiamota', '{$_SESSION['id_agentzia']}', '$herrialdea')";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $_SESSION['datuakBidalita'] = true;
        header("Location: bidaiakErregistratu.php");
    } else {
        $_SESSION['datuakBidalita'] = false;
        header("Location: bidaiakErregistratu.php");
    }

    mysqli_close($conexion);
}
?>
