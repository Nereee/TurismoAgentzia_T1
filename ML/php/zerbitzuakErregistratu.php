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
    <link rel="stylesheet" href="../php/kolorea.php">
    <link rel="stylesheet" href="../css/zerbitzuakErregistratu.css">
    <link rel="stylesheet" href="../css/saioaItxi.css">
</head>

<body>
    <header>
        <!--<img src="../img/logoadib.jpg" alt="logoadib" id="logoadib">-->
        <input type="submit" class="atzera" id="atzerazerb" value=''>
        <img id="sessionLogoa" src="<?php if(isset($_SESSION['agentziaLogoa'])){
            echo htmlspecialchars($_SESSION['agentziaLogoa']); }?>" alt="Logoa">
        <div id="sessionIzena"><?php if(isset($_SESSION['agentziaIzena'])){
            echo htmlspecialchars($_SESSION['agentziaIzena']); }?></div>
        <input type="submit" id="saioaitxi" value="Itxi saioa">
    </header>
    <section>
      <!--action="php/bidaiakErregistratu.php"-->
      <form action="zerbitzuaInsert.php" method="POST" id="zerbitzuErregistroa">  
        <label for="bidaia">Aukeratu bidaia</label><br> <!-- Datu basetik atera -->
        <div>
          <select id="bidaia" name="bidaia" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
              
              //$id_agentzia = $_SESSION['id_agentzia'];
              
              // Consulta para obtener todos los usuarios
              $getBidaia = "SELECT id_bidaia, izena, deskribapena, agentzia_kodea FROM bidaiak WHERE agentzia_kodea = '" . $_SESSION['id_agentzia'] . "'";
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

        <div id="hegaldimota" style='display:none'>
          <br><br>
          <label class="zerbitzutitulua">Hegaldia</label>
          <br><br>
          <label>Zein hegaldia mota da?</label>
          <br>
          <label><input type="radio" name="hegaldimota" id="joanekoa" value="joanekoa"> Joaneko hegaldia</label>
          <br>
          <label><input type="radio" name="hegaldimota" id="joanetorrikoa" value="joanetorrikoa"> Joan etorriko hegaldia</label>
        </div>
        
        
        <div id="joanekoErregistroa" style='display:none'>
          <br><br>
          <label class="hegmotatitulua">Joaneko hegaldia</label>
          <br><br>
          <label>Jatorrizko Aireportua</label>
          <div>
            <select id="joanekojatorriaireportua" name="joanekojatorriaireportua" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
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
            <select id="joanekohelmugaaireportua" name="joanekohelmugaaireportua" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
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
          <input type="text" id="joanekokodea" name="joanekokodea">
          <br><br>
          <label>Airelinea</label>
          <div>
            <select id="joanekoairelinea" name="joanekoairelinea" class="select-css">
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
          <label id="preziolabel">Prezioa (€)</label>
          <input type="text" id="joanekoprezioa" name="joanekoprezioa">
          <br><br>
          <label>Irteera Data</label>
          <input type="date" id="joanekodata" name="joanekodata">
          <br><br>
          <label>Irteera Ordua</label>
          <input type="time" id="joanekoordua" name="joanekoordua">
          <br><br>
          <label>Bidaiaren Iraupena (orduetan)</label>
          <input type="time" id="joanekoiraupena" name="joanekoiraupena">


          <div id="etorrikoErregistroa" style='display:none'>
            <br><br>
            <label class="hegmotatitulua">Etorriko hegaldia</label>
            <br><br>
            <label>Bueltako Hegaldi Kodea</label>
            <input type="text" id="etorrikokodea" name="etorrikokodea">
            <br><br>
            <label>Bueltako Airelinea</label>
            <div>
              <select id="etorrikoairelinea" name="etorrikoairelinea" class="select-css">
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
            <label>Itzulera Data</label>
            <input type="date" id="etorrikodata" name="etorrikodata">
            <br><br>
            <label>Itzulera Ordua</label>
            <input type="time" id="etorrikoordua" name="etorrikoordua">
            <br><br>
            <label>Bueltako Bidaiaren Iraupena (orduetan)</label>
            <input type="time" id="etorrikoiraupena" name="etorrikoiraupena">
            <br><br>
          </div>
        </div>

        <div id="ostatuErregistroa" style='display:none'>
          <br><br>
          <label class="zerbitzutitulua">Ostatua</label>
          <br><br>
          <label>Hotelaren izena</label>
          <input type="text" id="ostatuizena" name="ostatuizena">
          <br><br>
          <label>Hiria</label>
          <input type="text" id="ostatuhiria" name="ostatuhiria">
          <br><br>
          <label>Prezioa (€)</label>
          <input type="text" id="ostatuprezioa" name="ostatuprezioa">
          <br><br>
          <label>Sarrera eguna</label>
          <input type="date" id="ostatusarreraeguna" name="ostatusarreraeguna">
          <br><br>
          <label>Irteera eguna</label>
          <input type="date" id="ostatuirteeraeguna" name="ostatuirteeraeguna">
          <br><br>
          <label>Logela mota</label>
          <div>
            <select id="logelamota" name="logelamota" class="select-css">
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
          <input type="text" id="bestebatzukizena" name="bestebatzukizena">
          <br><br>
          <label>Data</label>
          <input type="date" id="bestebatzukdata" name="bestebatzukdata">
          <br><br>
          <label>Deskribapena</label>
          <textarea name="bestebatzukdeskribapena" id="bestebatzukdeskribapena"></textarea>
          <br><br>
          <label>Prezioa (€)</label>
          <input type="text" id="bestebatzukprezioa" name="bestebatzukprezioa">
        </div>

        <br><br>
        <input type="submit" id="zerbitzuagorde" value="GORDE" style='display:none'>
      </form>
      <br><br>

      <!--JOANEKO HEGALDIAREN LABURPEN TAULA-->
      <table id="joanekoTaula" style='display:none'>
        <thead>
          <tr>
            <th>JATORRIZKO AIREPORTUA</th>
            <th>HELMUGAKO AIREPORTUA</th>
            <th>HEGALDI KODEA</th>
            <th>AIRELINEA</th>
            <th id="prezioataulan">PREZIOA (€)</th>
            <th>IRTEERA DATA</th>
            <th>IRTEERA ORDUA</th>
            <th>BIDAIAREN IRAUPENA</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    <!--ETORRIKO HEGALDIAREN LABURPEN TAULA-->
    <table id="etorrikoTaula" style='display:none'>
      <thead>
        <tr>
          <th>BUELTAKO HEGALDI KODEA</th>
          <th>BUELTAKO AIRELINEA</th>
          <th>ITZULERA DATA</th>
          <th>ITZULERA ORDUA</th>
          <th>BUELTAKO BIDAIAREN IRAUPENA</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    <!--OSTATUAREN LABURPEN TAULA-->
    <table id="ostatuarenTaula" style='display:none'>
      <thead>
        <tr>
          <th>HOTELAEN IZENA</th>
          <th>HIRIA</th>
          <th>PREZIOA (€)</th>
          <th>SARRERA EGUNA</th>
          <th>IRTEERA EGUNA</th>
          <th>LOGELA MOTA</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    <!--BESTE ZERBITZU BATZUEN LABURPEN TAULA-->
    <table id="besteBatzukTaula" style='display:none'>
      <thead>
        <tr>
          <th>IZENA</th>
          <th>DATA</th>
          <th>DESKRIBAPENA</th>
          <th>PREZIOA (€)</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

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
</body>
<script src="../js/zerbitzuakErregistratu.js"></script>
<script src="../js/saioaitxi.js"></script>
</html>