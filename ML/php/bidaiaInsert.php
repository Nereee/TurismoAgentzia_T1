<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$nombre = $_POST['izena'];
$bidaiamota = $_POST['bidaiamota'];
$hasieradata = $_POST['hasieradata'];
$amaieradata = $_POST['amaieradata'];
$herrialdea = $_POST['herrialdea'];
$deskribapena = $_POST['deskribapena'];
$kanpoZerbitzuak = $_POST['kanpZerb'];

$conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$consulta = "insert into bidaiak(izena, deskribapena, hasiera_data, amaiera_data, ez_barne_zerbitzuak, bidaia_mota_kodea, agentzia_kodea, herrialdeak_kodea) 
            values('$nombre', '$deskribapena', '$hasieradata', '$amaieradata', '$kanpoZerbitzuak', '$bidaiamota', '{$_SESSION['id_agentzia']}', '$herrialdea')";

$resultado = mysqli_query($conexion, $consulta);

if($resultado){
    echo "Datos agregados correctamente";
}else{
    echo "Error al ingresar los datos" . mysqli_error($conexion);
}

mysqli_close($conexion);
}

?>