<?php
session_start();
require 'conexioa.php';



$bidaia_id = $_POST['bidaia'];

$JjatorrizkoAireportua = $_POST['joanekojatorriaireportua'];
$JhelmugakoAireportua = $_POST['joanekohelmugaaireportua'];
$Jkodea = $_POST['joanekokodea'];
$Jairelinea = $_POST['joanekoairelinea'];
$Jprezioa = $_POST['joanekoprezioa'];
$Jdata = $_POST['joanekodata'];
$Jordua = $_POST['joanekoordua'];
$Jiraupena = $_POST['joanekoiraupena'];

if (!empty($bidaia) && !empty($JjatorrizkoAireportua) && !empty($JhelmugakoAireportua) && !empty($Jkodea) && !empty($Jairelinea) && !empty($Jprezioa) && !empty($Jdata) && !empty($Jordua) && !empty($Jiraupena)) {
    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
         
     $consultaEkitaldia = "insert into ekitaldiak(izena, id_bidaia) 
                 values('Joaneko Hegaldia', 'bidaia_id')";
     $resultadoEkitaldia = mysqli_query($conexion, $consultaEkitaldia); 
     if($resultadoEkitaldia){
         echo "Datos agregados correctamente";
     }else{
         echo "Error al ingresar los datos" . mysqli_error($conexion);
     }

    $getEkitaldia = "SELECT id_ekitaldia, izena, id_bidaia FROM ekitaldiak";
    $result = $conn->query($getEkitaldia);               
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        $_SESSION['id_ekitaldia'] = $user['id_ekitaldia'];
    }

    $consulta = "insert into joaneko_hegaldia(id_hegaldia, kodea, irteera_data, irteera_ordua, iraupena, prezioa, jatorrizko_aireportua, helmugako_aireportua, airelinea_kodea) 
                values('{$_SESSION['id_ekitaldia']}', '$Jkodea', '$Jdata', '$Jordua', '$Jiraupena', '$Jprezioa', '$JjatorrizkoAireportua', '$JhelmugakoAireportua', '$Jairelinea')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }
    
    mysqli_close($conexion);
}



$JEjatorrizkoAireportua = $_POST['etorrikojatorriaireportua'];
$JEhelmugakoAireportua = $_POST['etorrikohelmugaaireportua'];
$JEkodea = $_POST['etorrikokodea'];
$JEairelinea = $_POST['etorrikoairelinea'];
$JEprezioa = $_POST['etorrikoprezioa'];
$JEdata = $_POST['etorrikodata'];
$JEordua = $_POST['etorrikoordua'];
$JEiraupena = $_POST['etorrikoiraupena'];

if (!empty($bidaia) && !empty($JEjatorrizkoAireportua) && !empty($JEhelmugakoAireportua) && !empty($JEkodea) && !empty($JEairelinea) && !empty($JEprezioa) && !empty($JEdata) && !empty($JEordua) && !empty($JEiraupena)) {
    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }
    
    $consulta = "insert into joan_etorriko_hegaldia(id_hegaldia, kodea, itzulera_data, itzulera_ordua, bueltako_iraupena, jatorrizko_aireportua, helmugako_aireportua, bueltako_airelinea_kodea) 
                values('{$_SESSION['id_ekitaldia']}', '$JEkodea', '$JEdata', '$JEordua', '$JEiraupena', '$JEjatorrizkoAireportua', '$JEhelmugakoAireportua', '$JEairelinea')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }
    
    mysqli_close($conexion);
}



$Ostizena = $_POST['ostatuizena'];
$hiria = $_POST['ostatuhiria'];
$prezioa = $_POST['ostatuprezioa'];
$sarreraEguna = $_POST['ostatusarreraeguna'];
$irteeraEguna = $_POST['ostatuirteeraeguna'];
$logela = $_POST['logelamota'];

if (!empty($bidaia) && !empty($Ostizena) && !empty($hiria) && !empty($prezioa) && !empty($sarreraEguna) && !empty($irteeraEguna) && !empty($logela)) {
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
}



$BBizena = $_POST['bestebatzukizena'];
$BBdata = $_POST['bestebatzukdata'];
$BBdeskribapena = $_POST['bestebatzukdeskribapena'];
$BBprezioa = $_POST['bestebatzukprezioa'];

if (!empty($bidaia) && !empty($BBizena) && !empty($BBdata) && !empty($BBdeskribapena) && !empty($BBprezioa)) {
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
?>