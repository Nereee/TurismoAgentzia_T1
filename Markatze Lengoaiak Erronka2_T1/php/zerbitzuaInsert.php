<?php
session_start();
require 'conexioa.php';


$zeinzerbitzu = isset($_POST['zeinzerbitzu']) ? $_POST['zeinzerbitzu'] : '';
$bidaia = isset($_POST['bidaia']) ? $_POST['bidaia'] : '';
$hegaldimota = isset($_POST['hegaldimota']) ? $_POST['hegaldimota'] : '';


$JjatorrizkoAireportua = $_POST['joanekojatorriaireportua'];
$JhelmugakoAireportua = $_POST['joanekohelmugaaireportua'];
$Jkodea = $_POST['joanekokodea'];
$Jairelinea = $_POST['joanekoairelinea'];
$Jprezioa = $_POST['joanekoprezioa'];
$Jdata = $_POST['joanekodata'];
$Jordua = $_POST['joanekoordua'];
$Jiraupena = $_POST['joanekoiraupena'];

$_SESSION['joanekojatorriaireportua'] = $JjatorrizkoAireportua;
$_SESSION['joanekohelmugaaireportua'] = $JhelmugakoAireportua;
$_SESSION['joanekokodea'] = $Jkodea;
$_SESSION['joanekoairelinea'] = $Jairelinea;
$_SESSION['joanekoprezioa'] = $Jprezioa;
$_SESSION['joanekodata'] = $Jdata;
$_SESSION['joanekoordua'] = $Jordua;
$_SESSION['joanekoiraupena'] = $Jiraupena;


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
        $_SESSION['ekitaldiakDatuakBidalita'] = true;
        header("Location: zerbitzuakErregistratu.php");
    }else{
        $_SESSION['ekitaldiakDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
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
        $_SESSION['joanekoDatuakBidalita'] = true;
        header("Location: zerbitzuakErregistratu.php");
        exit();
    } else {
        $_SESSION['joanekoDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
    }

    mysqli_close($conexion);


  /*************************************************************************************************************************************************/  
} elseif ($hegaldimota == 'joanetorrikoa'){

    $JEkodea = $_POST['etorrikokodea'];
    $JEdata = $_POST['etorrikodata'];
    $JEordua = $_POST['etorrikoordua'];
    $JEiraupena = $_POST['etorrikoiraupena'];
    $JEairelinea = $_POST['etorrikoairelinea'];

    $_SESSION['etorrikokodea'] = $JEkodea;
    $_SESSION['etorrikodata'] = $JEdata;
    $_SESSION['etorrikoordua'] = $JEordua;
    $_SESSION['etorrikoiraupena'] = $JEiraupena;
    $_SESSION['etorrikoairelinea'] = $JEairelinea;


    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
                VALUES('$hegaldimota', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        $_SESSION['ekitaldiakDatuakBidalita'] = true;
        header("Location: zerbitzuakErregistratu.php");
    }else{
        $_SESSION['ekitaldiakDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
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
        $_SESSION['joanekoDatuakBidalita'] = true;
        header("Location: zerbitzuakErregistratu.php");
    
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
            $_SESSION['etorrikoDatuakBidalita'] = true;
            header("Location: zerbitzuakErregistratu.php");
        } else {
            $_SESSION['etorrikoDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
        }
    } else {
        $_SESSION['joanekoDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
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

    $_SESSION['ostatuizena'] = $Ostizena;
    $_SESSION['ostatuhiria'] = $hiria;
    $_SESSION['ostatuprezioa'] = $prezioa;
    $_SESSION['ostatusarreraeguna'] = $sarreraEguna;
    $_SESSION['ostatuirteeraeguna'] = $irteeraEguna;
    $_SESSION['logelamota'] = $logela;

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
                VALUES('$zeinzerbitzu', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        $_SESSION['ekitaldiakDatuakBidalita'] = true;
            header("Location: zerbitzuakErregistratu.php");
    }else{
        $_SESSION['ekitaldiakDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
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
        $_SESSION['ostatuaDatuakBidalita'] = true;
            header("Location: zerbitzuakErregistratu.php");
    }else{
        $_SESSION['ostatuaDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
    }
    
    mysqli_close($conexion);


    /*************************************************************************************************************************************************/
} elseif ($zeinzerbitzu == 'bestebatzuk') {

    $BBizena = $_POST['bestebatzukizena'];
    $BBdata = $_POST['bestebatzukdata'];
    $BBdeskribapena = $_POST['bestebatzukdeskribapena'];
    $BBprezioa = $_POST['bestebatzukprezioa'];

    $_SESSION['bestebatzukizena'] = $BBizena;
    $_SESSION['bestebatzukdata'] = $BBdata;
    $_SESSION['bestebatzukdeskribapena'] = $BBdeskribapena;
    $_SESSION['bestebatzukprezioa'] = $BBprezioa;

    $conexion = new mysqli("localhost:3307", "root", "", "db_bidaiaagentzia");

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $consulta = "INSERT INTO ekitaldiak(izena, id_bidaia) 
                VALUES('$zeinzerbitzu', '$bidaia')";
    $resultado = mysqli_query($conexion, $consulta); 
    if($resultado){
        $_SESSION['ekitaldiakDatuakBidalita'] = true;
        header("Location: zerbitzuakErregistratu.php");
    }else{
        $_SESSION['ekitaldiakDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
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
        $_SESSION['jarduerakDatuakBidalita'] = true;
        header("Location: zerbitzuakErregistratu.php");
    }else{
        $_SESSION['jarduerakDatuakBidalita'] = false;
        header("Location: zerbitzuakErregistratu.php");
    }
    
    mysqli_close($conexion);
}

$conn->close();
?>