<?php
session_start();
require 'conexioa.php';


$zeinzerbitzu = $_POST['zeinzerbitzu'];
$bidaia = $_POST['bidaia'];
$hegaldimota = $_POST['hegaldimota'];


$JjatorrizkoAireportua = $_POST['joanekojatorriaireportua'];
$JhelmugakoAireportua = $_POST['joanekohelmugaaireportua'];
$Jkodea = $_POST['joanekokodea'];
$Jairelinea = $_POST['joanekoairelinea'];
$Jprezioa = $_POST['joanekoprezioa'];
$Jdata = $_POST['joanekodata'];
$Jordua = $_POST['joanekoordua'];
$Jiraupena = $_POST['joanekoiraupena'];

$Jprezioa = str_replace(',', '.', $Jprezioa);


if ($hegaldimota == 'joanekoa') {

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
             VALUES('$hegaldimota', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }

    $getEkitaldia = "SELECT id_ekitaldia, izena, id_bidaia FROM ekitaldiak";
    $result = $conn->query($getEkitaldia);     

    if ($result->num_rows > 0) {
        $id_ekitaldia = mysqli_insert_id($conexion);
        $row = $result->fetch_assoc();
    }


    $consulta = "INSERT INTO joaneko_hegaldia(id_hegaldia, kodea, irteera_data, irteera_ordua, iraupena, prezioa, jatorrizko_aireportua, helmugako_aireportua, airelinea_kodea) 
                VALUES ('$id_ekitaldia', '$Jkodea', '$Jdata', '$Jordua', '$Jiraupena', $Jprezioa, '$JjatorrizkoAireportua', '$JhelmugakoAireportua', '$Jairelinea')";

    
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado) {
        echo "Datos de la tabla joaneko_hegaldia agregados correctamente.";
    } else {
        echo "Error al ingresar los datos en joaneko_hegaldia: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);


  /*************************************************************************************************************************************************/  
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

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
                VALUES('$hegaldimota', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }

    $getEkitaldia = "SELECT id_ekitaldia, izena, id_bidaia FROM ekitaldiak";
    $result = $conn->query($getEkitaldia);     

    if ($result->num_rows > 0) {
        $id_ekitaldia = mysqli_insert_id($conexion);
        $row = $result->fetch_assoc();
    }

    /*************************************************************/
    
    $consulta = "INSERT INTO joaneko_hegaldia(id_hegaldia, kodea, irteera_data, irteera_ordua, iraupena, prezioa, jatorrizko_aireportua, helmugako_aireportua, airelinea_kodea) 
                VALUES ('$id_ekitaldia', '$Jkodea', '$Jdata', '$Jordua', '$Jiraupena', $Jprezioa, '$JjatorrizkoAireportua', '$JhelmugakoAireportua', '$Jairelinea')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    
    if ($resultado) {
        echo "Datos de la tabla joaneko_hegaldia agregados correctamente.";
    
        $getHegaldia = "SELECT id_hegaldia FROM joaneko_hegaldia WHERE id_hegaldia = '$id_ekitaldia'";
        $result = $conexion->query($getHegaldia);               

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_hegaldia = $row['id_hegaldia'];
        } else {
            die("Error: No se pudo obtener el id_hegaldia insertado.");
        }

        $consulta_etorriko = "INSERT INTO joan_etorriko_hegaldia(id_hegaldia, kodea, itzulera_data, itzulera_ordua, bueltako_iraupena, bueltako_airelinea_kodea) 
                             VALUES('$id_hegaldia', '$JEkodea', '$JEdata', '$JEordua', '$JEiraupena', '$JEairelinea')";
    
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


    /*************************************************************************************************************************************************/
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

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
                VALUES('$zeinzerbitzu', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }

    $getEkitaldia = "SELECT id_ekitaldia, izena, id_bidaia FROM ekitaldiak";
    $result = $conn->query($getEkitaldia);     

    if ($result->num_rows > 0) {
        $id_ekitaldia = mysqli_insert_id($conexion);
        $row = $result->fetch_assoc();
    }

    
    $consulta = "INSERT INTO ostatua(id_ostatua, hotelaren_izena, hiria, prezioa, sarrera_eguna, irteera_eguna, logela_mota_kodea) 
                VALUES('$id_ekitaldia', '$Ostizena', '$hiria', $prezioa, '$sarreraEguna', '$irteeraEguna', '$logela')";
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }
    
    mysqli_close($conexion);


    /*************************************************************************************************************************************************/
} elseif ($zeinzerbitzu == 'bestebatzuk') {

    $BBizena = $_POST['bestebatzukizena'];
    $BBdata = $_POST['bestebatzukdata'];
    $BBdeskribapena = $_POST['bestebatzukdeskribapena'];
    $BBprezioa = $_POST['bestebatzukprezioa'];

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
                VALUES('$zeinzerbitzu', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        echo "Datos agregados correctamente";
    }else{
        echo "Error al ingresar los datos" . mysqli_error($conexion);
    }

    $getEkitaldia = "SELECT id_ekitaldia, izena, id_bidaia FROM ekitaldiak";
    $result = $conn->query($getEkitaldia);     

    if ($result->num_rows > 0) {
        $id_ekitaldia = mysqli_insert_id($conexion);
        $row = $result->fetch_assoc();
    }

    
    $consulta = "INSERT INTO jarduerak(id_jarduera, izena, deskribapena, data, prezioa) 
                VALUES('$id_ekitaldia', '$BBizena', '$BBdeskribapena', '$BBdata', $BBprezioa)";
    
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