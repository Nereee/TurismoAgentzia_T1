<?php
session_start();
require 'conexioa.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidaiak Erregistratu</title>
    <link rel="stylesheet" href="../css/maketazioa.css">
    <link rel="stylesheet" href="../css/zerbitzuakErregistratu.css">
</head>

<body>
    <header>
        <!--<img src="../img/logoadib.jpg" alt="logoadib" id="logoadib">-->
        <input type="submit" id="saioaitxi" value="Itxi saioa">
        <?php
        echo $_SESSION['agentzia'];
        ?>
    </header>
    <section>
      <!--action="php/bidaiakErregistratu.php"-->
      <form action="#" method="get" id="bidaiErregistroa">  
        <label for="bidaia">Aukeratu bidaia</label><br> <!-- Datu basetik atera -->

        <div>
          <select name="bidaia" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                    
              // Consulta para obtener todos los usuarios
              $getBidaia = "SELECT id_bidaia, izena, deskribapena FROM bidaiak";
              $result = $conn->query($getBidaia);
                    
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                  while ($row = $result->fetch_assoc()) {
                  $id = $row['id_bidaia'];
                  $izena = $row['izena'];
                  $deskribapena = $row['deskribapena'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$id'>$izena, $deskribapena</option>";
                }
              } else {
                  echo "<option value=''>Ez dago bidairik</option>";
              }
            ?>
          </select>
        </div>
        <br><br>
        
        <label>Zein zerbitzu erregistratu behar duzu?</label>
        <br>
        <label><input type="radio" name="zeinzerbitzu" id="hegaldia" value="hegaldia"> Hegaldia</label>
        <br>
        <label><input type="radio" name="zeinzerbitzu" id="ostatua" value="ostatua"> Ostatua</label>
        <br>
        <label><input type="radio" name="zeinzerbitzu" id="bestebatzuk" value="bestebatzuk"> Beste batzuk</label>
        <br><br>

        <hr>

        <div id="joanekoErregistroa" style='display:none'>
          <br><br>
          <label class="zerbitzutitulua">Hegaldia</label>
          <br><br>
          <label>Zein hegaldia mota da?</label>
          <br>
          <label><input type="radio" name="hegaldimota" id="joanekoa" value="joanekoa"> Joaneko hegaldia</label>
          <br>
          <label><input type="radio" name="hegaldimota" id="joanetorrikoa" value="joanetorrikoa"> Joan etorriko hegaldia</label>
          <br><br>

          <label class="hegmotatitulua">Joaneko hegaldia</label>

          <br><br>
          <label>Jatorrizko Aireportua</label>
          <div>
            <select name="bidaiamota" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                  
              // Consulta para obtener todos los usuarios
              $getAireportua = "SELECT aireportua, hiria FROM iata";
              $result = $conn->query($getAireportua);
                  
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['aireportua'];
                  $hiria = $row['hiria'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$kodea'>$hiria</option>";
                }
              } else {
                  echo "<option value=''>Ez dago aireporturik</option>";
              }
              ?>
            </select>
          </div>
            
          <br><br>
          <label>Helmugako Aireportua</label>
          <div>
            <select name="bidaiamota" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                  
              // Consulta para obtener todos los usuarios
              $getAireportua = "SELECT aireportua, hiria FROM iata";
              $result = $conn->query($getAireportua);
                  
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['aireportua'];
                  $hiria = $row['hiria'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$kodea'>$hiria</option>";
                }
              } else {
                  echo "<option value=''>Ez dago aireporturik</option>";
              }
              ?>
            </select>
          </div>
          <br><br>
          <label>Hegaldi Kodea</label>
          <input type="text" id="joanekokodea">
          <br><br>
          <label>Airelinea</label>
          <div>
            <select name="bidaiamota" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                  
              // Consulta para obtener todos los usuarios
              $getAirelinea = "SELECT kodea, izena FROM airelineak";
              $result = $conn->query($getAirelinea);
                  
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kodea'];
                  $airelinea = $row['izena'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$kodea'>$airelinea</option>";
                }
              } else {
                  echo "<option value=''>Ez dago airelinearik</option>";
              }
              ?>
            </select>
          </div>
          <br><br>
          <label>Prezioa (€)</label>
          <input type="number" id="joanekoprezioa">
          <br><br>
          <label>Irteera Data</label>
          <input type="date" id="joanekodata">
          <br><br>
          <label>Irteera Ordua</label>
          <input type="time" id="joanekoordua">
          <br><br>
          <label>Bidaiaren Iraupena (orduetan)</label>
          <input type="number" id="joanekoiraupena">
          <br><br>
          

          <div id="joanetorrikoErregistroa" style='display:none'>
            <label class="hegmotatitulua">Joan Etorriko hegaldia</label>
            <br><br>
            <label>Itzulera Data</label>
            <input type="date" id="etorrikodata">
            <br><br>
            <label>Itzulera Ordua</label>
            <input type="time" id="etorrikoordua">
            <br><br>
            <label>Bueltako Bidaiaren Iraupena (orduetan)</label>
            <input type="number" id="etorrikoiraupena">
            <br><br>
            <label>Bueltako Hegaldi Kodea</label>
            <input type="text" id="etorrikokodea">
            <br><br>
            <label>Bueltako Airelinea</label>
            <div>
              <select name="bidaiamota" class="select-css">
                <option value="">--Aukeratu--</option>
                <?php
                // Incluir el archivo de conexión
                require 'conexioa.php';
                    
                // Consulta para obtener todos los usuarios
                $getAirelinea = "SELECT kodea, izena FROM airelineak";
                $result = $conn->query($getAirelinea);
                    
                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                  // Recorrer los resultados y generar las opciones del select
                  while ($row = $result->fetch_assoc()) {
                    $kodea = $row['kodea'];
                    $airelinea = $row['izena'];
                    // Mostrar el nombre en el valor del option y la contraseña como texto visible
                    echo "<option value='$kodea'>$airelinea</option>";
                  }
                } else {
                    echo "<option value=''>Ez dago airelinearik</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>

        <div id="ostatuErregistroa" style='display:none'>
          <br><br>
          <label class="zerbitzutitulua">Ostatua</label>
          <br><br>
          <label>Hotelaren izena</label>
          <input type="text" id="ostatuizena">
          <br><br>
          <label>Hiria</label>
          <input type="text" id="ostatuhiria">
          <br><br>
          <label>Prezioa (€)</label>
          <input type="number" id="ostatuprezioa">
          <br><br>
          <label>Sarrera eguna</label>
          <input type="date" id="ostatusarreraeguna">
          <br><br>
          <label>Irteera eguna</label>
          <input type="date" id="ostatuirteeraeguna">
          <br><br>
          <label>Logela mota</label>
          <div>
            <select name="bidaiamota" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                  
              // Consulta para obtener todos los usuarios
              $getLogela = "SELECT kodea, deskribapena FROM logela_motak";
              $result = $conn->query($getLogela);
                  
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kodea'];
                  $logela = $row['deskribapena'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$kodea'>$logela</option>";
                }
              } else {
                  echo "<option value=''>Ez dago logelarik</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div id="bestebatzukErregistroa" style='display:none'>
          <br><br>
          <label class="zerbitzutitulua">Beste Batzuk</label>
          <br><br>
          <label>Izena</label>
          <input type="text" id="bestebatzukizena">
          <br><br>
          <label>Data</label>
          <input type="date" id="bestebatzukdata">
          <br><br>
          <label>Deskribapena</label>
          <textarea name="bestebatzukdeskribapena" id="bestebatzukdeskribapena"></textarea>
          <br><br>
          <label>Prezioa (€)</label>
          <input type="number" id="beste batzukprezioa">
        </div>



        <br><br>
        <input type="submit" id="bidaiagorde" value="GORDE">
      </form>
    </section>
</body>
<script src="../js/zerbitzuakErregistratu.js"></script>
</html>