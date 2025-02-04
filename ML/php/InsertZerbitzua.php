<?php
session_start();
require 'conexioa.php';


$bidaia = $_POST['bidaia'];
$zeinzerbitzu = $_POST['zeinzerbitzu'];
$hegaldimota = $_POST['hegaldimota'];

$conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
     
$consulta = "insert into ekitaldiak(izena, id_bidaia) 
             values('$hegaldimota', '$bidaia')";
$resultado = mysqli_query($conexion, $consulta); 
if($resultado){
    echo "Datos agregados correctamente";
}else{
    echo "Error al ingresar los datos" . mysqli_error($conexion);
}

$getEkitaldia = "SELECT id_ekitaldia, izena, id_bidaia FROM ekitaldiak";
$result = $conn->query($getEkitaldia);               
// Verificar si hay resultados
if ($result->num_rows > 0) {
    $_SESSION['id_ekitaldia'] = $getEkitaldia['id_ekitaldia'];
}


$JjatorrizkoAireportua = $_POST['joanekojatorriaireportua'];
$JhelmugakoAireportua = $_POST['joanekohelmugaaireportua'];
$Jkodea = $_POST['joanekokodea'];
$Jairelinea = $_POST['joanekoairelinea'];
$Jprezioa = $_POST['joanekoprezioa'];
$Jdata = $_POST['joanekodata'];
$Jordua = $_POST['joanekoordua'];
$Jiraupena = $_POST['joanekoiraupena'];

$Jprezioa = str_replace(',', '.', $Jprezioa);
$Jprezioa = floatval($Jprezioa);

$Jdata = date('Y-m-d', strtotime($Jdata));
$Jordua = date('H:i:s', strtotime($Jordua));
$Jiraupena = date('H:i:s', strtotime($Jiraupena));

$Jdata = $_POST['joanekodata']; // Fecha
$Jordua = $_POST['joanekoordua']; // Hora
$Jprezioa = floatval($_POST['joanekoprezioa']); // Precio

if ($hegaldimota == 'joanekoa') {

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "insert into joaneko_hegaldia(id_hegaldia, kodea, irteera_data, irteera_ordua, iraupena, prezioa, jatorrizko_aireportua, helmugako_aireportua, airelinea_kodea) 
                values('{$_SESSION['id_ekitaldia']}', '$Jkodea', '$Jdata', '$Jordua', '$Jiraupena', $Jprezioa, '$JjatorrizkoAireportua', '$JhelmugakoAireportua', '$Jairelinea')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }

    mysqli_close($conexion);


} elseif ($hegaldimota == 'joanetorrikoa'){

    $JEkodea = $_POST['etorrikokodea'];
    $JEdata = $_POST['etorrikodata'];
    $JEordua = $_POST['etorrikoordua'];
    $JEiraupena = $_POST['etorrikoiraupena'];
    $JEairelinea = $_POST['etorrikoairelinea'];
    
    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    // Insertar en la tabla joaneko_hegaldia
    $consulta = "insert into joaneko_hegaldia(kodea, irteera_data, irteera_ordua, iraupena, prezioa, jatorrizko_aireportua, helmugako_aireportua, airelinea_kodea) 
                values('$Jkodea', '$Jdata', '$Jordua', '$Jiraupena', $Jprezioa, '$JjatorrizkoAireportua', '$JhelmugakoAireportua', '$Jairelinea')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado) {
        // Obtener el id_hegaldia de la última inserción
        $id_hegaldia = mysqli_insert_id($conexion);
        $_SESSION['id_hegaldia'] = $id_hegaldia;  // Almacenar en la sesión, si es necesario
    
        echo "Datos de la tabla joaneko_hegaldia agregados correctamente.";
    
        // Insertar en la tabla joan_etorriko_hegaldia utilizando el id_hegaldia obtenido
        $consulta_etorriko = "insert into joan_etorriko_hegaldia(id_hegaldia, kodea, itzulera_data, itzulera_ordua, bueltako_iraupena, bueltako_airelinea_kodea) 
                            values('$id_hegaldia', '$JEkodea', '$JEdata', '$JEordua', '$JEiraupena', '$JEairelinea')";
    
        $resultado_etorriko = mysqli_query($conexion, $consulta_etorriko);
        
        if ($resultado_etorriko) {
            echo "Datos de la tabla joan_etorriko_hegaldia agregados correctamente.";
        } else {
            echo "Error al ingresar los datos en joan_etorriko_hegaldia: " . mysqli_error($conexion);
        }
    
    } else {
        echo "Error al ingresar los datos en joaneko_hegaldia: " . mysqli_error($conexion);
    }
    
    mysqli_close($conexion);    


} elseif ($zeinzerbitzu == 'ostatua') {

    $Ostizena = $_POST['ostatuizena'];
    $hiria = $_POST['ostatuhiria'];
    $prezioa = $_POST['ostatuprezioa'];
    $sarreraEguna = $_POST['ostatusarreraeguna'];
    $irteeraEguna = $_POST['ostatuirteeraeguna'];
    $logela = $_POST['logelamota'];

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    $consulta = "insert into ostatua(id_ostatua, hotelaren_izena, hiria, prezioa, sarrera_eguna, irteera_eguna, logela_mota_kodea) 
                values('{$_SESSION['id_ekitaldia']}', '$Ostizena', '$hiria', '$prezioa', '$sarreraEguna', '$irteeraEguna', '$logela')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }
    
    mysqli_close($conexion);


} elseif ($zeinzerbitzu == 'bestebatzuk') {
    
    $BBizena = $_POST['bestebatzukizena'];
    $BBdata = $_POST['bestebatzukdata'];
    $BBdeskribapena = $_POST['bestebatzukdeskribapena'];
    $BBprezioa = $_POST['bestebatzukprezioa'];

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    $consulta = "insert into jarduerak(id_jarduera, izena, deskribapena, data, prezioa) 
                values('{$_SESSION['id_ekitaldia']}', '$BBizena', '$BBdeskribapena', '$BBdata', '$BBprezioa')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }
    
    mysqli_close($conexion);
}

$conn->close();
?>
