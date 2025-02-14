<?php
session_start();
require 'conexioa.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zerbitzuak Erregistratu</title>
    <link rel="stylesheet" href="../css/maketazioa.css">
    <link rel="stylesheet" href="../php/kolorea.php">
    <link rel="stylesheet" href="../css/zerbitzuakErregistratu.css">
    <link rel="stylesheet" href="../css/saioaItxi.css">
</head>

<body>
    <header>
        <input type="submit" class="atzera" id="atzerazerb" value=''>
        <img id="sessionLogoa" src="<?php if(isset($_SESSION['agentziaLogoa'])){
            echo htmlspecialchars($_SESSION['agentziaLogoa']); }?>" alt="Logoa">
        <div id="sessionIzena"><?php if(isset($_SESSION['agentziaIzena'])){
            echo htmlspecialchars($_SESSION['agentziaIzena']); }?></div>
        <input type="submit" id="saioaitxi" value="Itxi saioa">
    </header>
    <section>
      <form action="zerbitzuaInsert.php" method="POST" id="zerbitzuErregistroa">  
        <label for="bidaia">Aukeratu bidaia</label><br>
        <div>
          <select id="bidaia" name="bidaia" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              require 'conexioa.php';
              
              $getBidaia = "SELECT id_bidaia, izena, deskribapena, agentzia_kodea FROM bidaiak WHERE agentzia_kodea = '" . $_SESSION['id_agentzia'] . "'";
              $result = $conn->query($getBidaia);
                    
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                  $id = $row['id_bidaia'];
                  $izena = $row['izena'];
                  $deskribapena = $row['deskribapena'];
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
                  
              $getAireportua = "SELECT aireportua, hiria FROM iata";
              $result = $conn->query($getAireportua);
                  
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['aireportua'];
                  $hiria = $row['hiria'];
                  
                  $selected = (isset($_SESSION['joanekojatorriaireportua']) && $_SESSION['joanekojatorriaireportua'] == $kodea) ? "selected" : "";
                  echo "<option value='$kodea' $selected>$hiria</option>";
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
                  
              $getAireportua = "SELECT aireportua, hiria FROM iata";
              $result = $conn->query($getAireportua);
                  
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['aireportua'];
                  $hiria = $row['hiria'];
                  
                  $selected = (isset($_SESSION['joanekohelmugaaireportua']) && $_SESSION['joanekohelmugaaireportua'] == $kodea) ? "selected" : "";
                  echo "<option value='$kodea' $selected>$hiria</option>";
                }
              } else {
                  echo "<option value=''>Ez dago aireporturik</option>";
              }
              ?>
            </select>
          </div>
          <br><br>
          <label>Hegaldi Kodea</label>
          <input type="text" id="joanekokodea" name="joanekokodea" value="<?php echo isset($_SESSION['joanekokodea']) ? $_SESSION['joanekokodea'] : ''; ?>">
          <br><br>
          <label>Airelinea</label>
          <div>
            <select id="joanekoairelinea" name="joanekoairelinea" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
              require 'conexioa.php';
                  
              $getAirelinea = "SELECT kodea, izena FROM airelineak";
              $result = $conn->query($getAirelinea);
                  
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kodea'];
                  $airelinea = $row['izena'];
                  
                  $selected = (isset($_SESSION['joanekoairelinea']) && $_SESSION['joanekoairelinea'] == $kodea) ? "selected" : "";
                  echo "<option value='$kodea' $selected>$airelinea</option>";
                }
              } else {
                  echo "<option value=''>Ez dago airelinearik</option>";
              }
              ?>
            </select>
          </div>
          <br><br>
          <label id="preziolabel">Prezioa (€)</label>
          <input type="text" id="joanekoprezioa" name="joanekoprezioa"  value="<?php echo isset($_SESSION['joanekoprezioa']) ? $_SESSION['joanekoprezioa'] : ''; ?>">
          <br><br>
          <label>Irteera Data</label>
          <input type="date" id="joanekodata" name="joanekodata" value="<?php echo isset($_SESSION['joanekodata']) ? $_SESSION['joanekodata'] : ''; ?>">
          <br><br>
          <label>Irteera Ordua</label>
          <input type="time" id="joanekoordua" name="joanekoordua" value="<?php echo isset($_SESSION['joanekoordua']) ? $_SESSION['joanekoordua'] : ''; ?>">
          <br><br>
          <label>Bidaiaren Iraupena (orduetan)</label>
          <input type="time" id="joanekoiraupena" name="joanekoiraupena" value="<?php echo isset($_SESSION['joanekoiraupena']) ? $_SESSION['joanekoiraupena'] : ''; ?>">


          <div id="etorrikoErregistroa" style='display:none'>
            <br><br>
            <label class="hegmotatitulua">Etorriko hegaldia</label>
            <br><br>
            <label>Bueltako Hegaldi Kodea</label>
            <input type="text" id="etorrikokodea" name="etorrikokodea" value="<?php echo isset($_SESSION['etorrikokodea']) ? $_SESSION['etorrikokodea'] : ''; ?>">
            <br><br>
            <label>Bueltako Airelinea</label>
            <div>
              <select id="etorrikoairelinea" name="etorrikoairelinea" class="select-css">
                <option value="">--Aukeratu--</option>
                <?php
                require 'conexioa.php';
                    
                $getAirelinea = "SELECT kodea, izena FROM airelineak";
                $result = $conn->query($getAirelinea);
                    
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $kodea = $row['kodea'];
                    $airelinea = $row['izena'];
                    
                    $selected = (isset($_SESSION['etorrikoairelinea']) && $_SESSION['etorrikoairelinea'] == $kodea) ? "selected" : "";
                    echo "<option value='$kodea' $selected>$airelinea</option>";
                  }
                } else {
                    echo "<option value=''>Ez dago airelinearik</option>";
                }
                ?>
              </select>
            </div>
            <br><br>
            <label>Itzulera Data</label>
            <input type="date" id="etorrikodata" name="etorrikodata" value="<?php echo isset($_SESSION['etorrikodata']) ? $_SESSION['etorrikodata'] : ''; ?>">
            <br><br>
            <label>Itzulera Ordua</label>
            <input type="time" id="etorrikoordua" name="etorrikoordua" value="<?php echo isset($_SESSION['etorrikoordua']) ? $_SESSION['etorrikoordua'] : ''; ?>">
            <br><br>
            <label>Bueltako Bidaiaren Iraupena (orduetan)</label>
            <input type="time" id="etorrikoiraupena" name="etorrikoiraupena" value="<?php echo isset($_SESSION['etorrikoiraupena']) ? $_SESSION['etorrikoiraupena'] : ''; ?>">
            <br><br>
          </div>
        </div>

        <div id="ostatuErregistroa" style='display:none'>
          <br><br>
          <label class="zerbitzutitulua">Ostatua</label>
          <br><br>
          <label>Hotelaren izena</label>
          <input type="text" id="ostatuizena" name="ostatuizena" value="<?php echo isset($_SESSION['ostatuizena']) ? $_SESSION['ostatuizena'] : ''; ?>">
          <br><br>
          <label>Hiria</label>
          <input type="text" id="ostatuhiria" name="ostatuhiria" value="<?php echo isset($_SESSION['ostatuhiria']) ? $_SESSION['ostatuhiria'] : ''; ?>">
          <br><br>
          <label>Prezioa (€)</label>
          <input type="text" id="ostatuprezioa" name="ostatuprezioa" value="<?php echo isset($_SESSION['ostatuprezioa']) ? $_SESSION['ostatuprezioa'] : ''; ?>">
          <br><br>
          <label>Sarrera eguna</label>
          <input type="date" id="ostatusarreraeguna" name="ostatusarreraeguna" value="<?php echo isset($_SESSION['ostatusarreraeguna']) ? $_SESSION['ostatusarreraeguna'] : ''; ?>">
          <br><br>
          <label>Irteera eguna</label>
          <input type="date" id="ostatuirteeraeguna" name="ostatuirteeraeguna" value="<?php echo isset($_SESSION['ostatuirteeraeguna']) ? $_SESSION['ostatuirteeraeguna'] : ''; ?>">
          <br><br>
          <label>Logela mota</label>
          <div>
            <select id="logelamota" name="logelamota" class="select-css">
              <option value="">--Aukeratu--</option>
              <?php
              require 'conexioa.php';
                  
              $getLogela = "SELECT kodea, deskribapena FROM logela_motak";
              $result = $conn->query($getLogela);
                  
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kodea'];
                  $logela = $row['deskribapena'];
                  $selected = (isset($_SESSION['logelamota']) && $_SESSION['logelamota'] == $kodea) ? "selected" : "";
                  echo "<option value='$kodea' $selected>$logela</option>";
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
          <input type="text" id="bestebatzukizena" name="bestebatzukizena" value="<?php echo isset($_SESSION['bestebatzukizena']) ? $_SESSION['bestebatzukizena'] : ''; ?>">
          <br><br>
          <label>Data</label>
          <input type="date" id="bestebatzukdata" name="bestebatzukdata" value="<?php echo isset($_SESSION['bestebatzukdata']) ? $_SESSION['bestebatzukdata'] : ''; ?>">
          <br><br>
          <label>Deskribapena</label>
          <textarea name="bestebatzukdeskribapena" id="bestebatzukdeskribapena"><?php echo isset($_SESSION['bestebatzukdeskribapena']) ? $_SESSION['bestebatzukdeskribapena'] : ''; ?></textarea>
          <br><br>
          <label>Prezioa (€)</label>
          <input type="text" id="bestebatzukprezioa" name="bestebatzukprezioa" value="<?php echo isset($_SESSION['bestebatzukprezioa']) ? $_SESSION['bestebatzukprezioa'] : ''; ?>">
        </div>

        <br><br>
        <input type="submit" id="zerbitzuagorde" value="GORDE" style='display:none'>
      </form>
      <br><br>
      <div id="mezua" style='display:none'><p><b>Datuak ondo gorde dira datu basean</b></p></div>

      <script>
        window.onload = function() {
          function gehitu_Joaneko_Taula() {
            let joanekojatorriaireportua = document.getElementById('joanekojatorriaireportua');
            let joanekohelmugaaireportua = document.getElementById('joanekohelmugaaireportua');
            let joanekokodea = document.getElementById('joanekokodea').value;
            let joanekoairelinea = document.getElementById('joanekoairelinea');
            let joanekoprezioa = document.getElementById('joanekoprezioa').value;
            let joanekodata = document.getElementById('joanekodata').value;
            let joanekoordua = document.getElementById('joanekoordua').value;
            let joanekoiraupena = document.getElementById('joanekoiraupena').value;

            let J_taula = document.getElementById('joanekoTaula');
            let J_body = J_taula.tBodies[0]; 
            
            let J_lerroa = J_body.insertRow();
            
            let jatorrizkoAireportuaTextua = joanekojatorriaireportua.options[joanekojatorriaireportua.selectedIndex].text;
            let jatorrizkoAireportua = J_lerroa.insertCell();
            jatorrizkoAireportua.innerText = jatorrizkoAireportuaTextua;
            
            let helmugakoAireportuaTextua = joanekohelmugaaireportua.options[joanekohelmugaaireportua.selectedIndex].text;
            let helmugakoAireportua = J_lerroa.insertCell();
            helmugakoAireportua.innerText = helmugakoAireportuaTextua;
            
            let kodea = J_lerroa.insertCell();
            kodea.innerText = joanekokodea;
            
            let airelineaTextua = joanekoairelinea.options[joanekoairelinea.selectedIndex].text;
            let airelinea = J_lerroa.insertCell();
            airelinea.innerText = airelineaTextua;
            
            let prezioa = J_lerroa.insertCell();
            prezioa.innerText = joanekoprezioa;
            
            let irteeraData = J_lerroa.insertCell();
            irteeraData.innerText = joanekodata;
            
            let irteeraOrdua = J_lerroa.insertCell();
            irteeraOrdua.innerText = joanekoordua;
        
            let iraupena = J_lerroa.insertCell();
            iraupena.innerText = joanekoiraupena;
        
            let J_lerroKant = J_taula.rows.length;
            if(J_lerroKant > 0){
                J_taula.style.display = 'block';
                document.getElementById('etorrikoTaula').style.display = 'none';
                document.getElementById('ostatuarenTaula').style.display = 'none';
                document.getElementById('besteBatzukTaula').style.display = 'none';

                joanekojatorriaireportua.value = "";
                joanekohelmugaaireportua.value = "";
                document.getElementById('joanekokodea').value = "";
                joanekoairelinea.value = "";
                document.getElementById('joanekoprezioa').value = "";
                document.getElementById('joanekodata').value = "";
                document.getElementById('joanekoordua').value = "";
                document.getElementById('joanekoiraupena').value = "";
            }
          }

          function gehitu_Etorriko_Taula() {
            let etorrikokodea = document.getElementById('etorrikokodea').value;
            let etorrikoairelinea = document.getElementById('etorrikoairelinea');
            let etorrikodata = document.getElementById('etorrikodata').value;
            let etorrikoordua = document.getElementById('etorrikoordua').value;
            let etorrikoiraupena = document.getElementById('etorrikoiraupena').value;

            let E_taula = document.getElementById('etorrikoTaula');
            let E_body = E_taula.tBodies[0]; 
            
            let E_lerroa = E_body.insertRow();
            
            let kodea = E_lerroa.insertCell();
            kodea.innerText = etorrikokodea;
            
            let airelineaTextua = etorrikoairelinea.options[etorrikoairelinea.selectedIndex].text;
            let airelinea = E_lerroa.insertCell();
            airelinea.innerText = airelineaTextua;
            
            let data = E_lerroa.insertCell();
            data.innerText = etorrikodata;
            
            let ordua = E_lerroa.insertCell();
            ordua.innerText = etorrikoordua;
            
            let iraupena = E_lerroa.insertCell();
            iraupena.innerText = etorrikoiraupena;
        
            let E_lerroKant = E_taula.rows.length;
            if(E_lerroKant > 0){
                E_taula.style.display = 'block';
                document.getElementById('ostatuarenTaula').style.display = 'none';
                document.getElementById('besteBatzukTaula').style.display = 'none';

                document.getElementById('etorrikokodea').value = "";
                etorrikoairelinea.value = "";
                document.getElementById('etorrikodata').value = "";
                document.getElementById('etorrikoordua').value = "";
                document.getElementById('etorrikoiraupena').value = ""; 
            }
        }

        function gehitu_Ostatua_Taula() {
          let ostatuizena = document.getElementById('ostatuizena').value;
          let ostatuhiria = document.getElementById('ostatuhiria').value;
          let ostatuprezioa = document.getElementById('ostatuprezioa').value;
          let ostatusarreraeguna = document.getElementById('ostatusarreraeguna').value;
          let ostatuirteeraeguna = document.getElementById('ostatuirteeraeguna').value;
          let logelamota = document.getElementById('logelamota');

            let O_taula = document.getElementById('ostatuarenTaula');
            let O_body = O_taula.tBodies[0]; 
            
            let O_lerroa = O_body.insertRow();
            
            let hotelarenIzena = O_lerroa.insertCell();
            hotelarenIzena.innerText = ostatuizena;
            
            let hiria = O_lerroa.insertCell();
            hiria.innerText = ostatuhiria;
            
            let prezioa = O_lerroa.insertCell();
            prezioa.innerText = ostatuprezioa;
            
            let sarreraEguna = O_lerroa.insertCell();
            sarreraEguna.innerText = ostatusarreraeguna;
            
            let irteeraEguna = O_lerroa.insertCell();
            irteeraEguna.innerText = ostatuirteeraeguna;
            
            let logelaMotaTextua = logelamota.options[logelamota.selectedIndex].text;
            let logelaMota = O_lerroa.insertCell();
            logelaMota.innerText = logelaMotaTextua;

            let O_lerroKant = O_taula.rows.length;
            if(O_lerroKant > 0){
                O_taula.style.display = 'block';
                document.getElementById('joanekoTaula').style.display = 'none';
                document.getElementById('etorrikoTaula').style.display = 'none';
                document.getElementById('besteBatzukTaula').style.display = 'none';

                document.getElementById('ostatuizena').value = "";
                document.getElementById('ostatuhiria').value = "";
                document.getElementById('ostatuprezioa').value = "";
                document.getElementById('ostatusarreraeguna').value = "";
                document.getElementById('ostatuirteeraeguna').value = "";
                logelamota.value = "";
            }
        }

        function gehitu_BesteBatzuk_Taula() {
          let bestebatzukizena = document.getElementById('bestebatzukizena').value;
          let bestebatzukdata = document.getElementById('bestebatzukdata').value;
          let bestebatzukdeskribapena = document.getElementById('bestebatzukdeskribapena').value;
          let bestebatzukprezioa = document.getElementById('bestebatzukprezioa').value;

            let BB_taula = document.getElementById('besteBatzukTaula');
            let BB_body = BB_taula.tBodies[0]; 
            
            let BB_lerroa = BB_body.insertRow();
            
            let izena = BB_lerroa.insertCell();
            izena.innerText = bestebatzukizena;
            
            let data = BB_lerroa.insertCell();
            data.innerText = bestebatzukdata;
            
            let deskribapena = BB_lerroa.insertCell();
            deskribapena.innerText = bestebatzukdeskribapena;
            
            let prezioa = BB_lerroa.insertCell();
            prezioa.innerText = bestebatzukprezioa;
            
            let BB_lerroKant = BB_taula.rows.length;
            if(BB_lerroKant > 0){
                BB_taula.style.display = 'block';
                document.getElementById('joanekoTaula').style.display = 'none';
                document.getElementById('etorrikoTaula').style.display = 'none';
                document.getElementById('ostatuarenTaula').style.display = 'none';

                document.getElementById('bestebatzukizena').value = "";
                document.getElementById('bestebatzukdata').value = "";
                document.getElementById('bestebatzukdeskribapena').value = "";
                document.getElementById('bestebatzukprezioa').value = "";
            }
        }
          function mezuaIkusi() {
            document.getElementById('mezua').style.display = 'block';

            setTimeout(function() {
              document.getElementById('mezua').style.display = 'none';
            }, 5000);
          }
          <?php
          if(isset($_SESSION['joanekoDatuakBidalita'])){
            unset($_SESSION['joanekoDatuakBidalita']);
            echo 'mezuaIkusi();';

            echo 'gehitu_Joaneko_Taula();';
            unset($_SESSION['joanekojatorriaireportua']);
            unset($_SESSION['joanekohelmugaaireportua']);
            unset($_SESSION['joanekokodea']);
            unset($_SESSION['joanekoairelinea']);
            unset($_SESSION['joanekoprezioa']);
            unset($_SESSION['joanekodata']);
            unset($_SESSION['joanekoordua']);
            unset($_SESSION['joanekoiraupena']);

          }
          if(isset($_SESSION['etorrikoDatuakBidalita'])){
            unset($_SESSION['etorrikoDatuakBidalita']);
            echo 'mezuaIkusi();';
            
            echo 'gehitu_Etorriko_Taula();';
            unset($_SESSION['joanekojatorriaireportua']);
            unset($_SESSION['joanekohelmugaaireportua']);
            unset($_SESSION['joanekokodea']);
            unset($_SESSION['joanekoairelinea']);
            unset($_SESSION['joanekoprezioa']);
            unset($_SESSION['joanekodata']);
            unset($_SESSION['joanekoordua']);
            unset($_SESSION['joanekoiraupena']);

            unset($_SESSION['etorrikokodea']);
            unset($_SESSION['etorrikodata']);
            unset($_SESSION['etorrikoordua']);
            unset($_SESSION['etorrikoiraupena']);
            unset($_SESSION['etorrikoairelinea']);
          }
          if(isset($_SESSION['ostatuaDatuakBidalita'])){
            unset($_SESSION['ostatuaDatuakBidalita']);
            echo 'mezuaIkusi();';

            echo 'gehitu_Ostatua_Taula();';
            unset($_SESSION['ostatuizena']);
            unset($_SESSION['ostatuhiria']);
            unset($_SESSION['ostatuprezioa']);
            unset($_SESSION['ostatusarreraeguna']);
            unset($_SESSION['ostatuirteeraeguna']);
            unset($_SESSION['logelamota']);
          }
          if(isset($_SESSION['jarduerakDatuakBidalita'])){
            unset($_SESSION['jarduerakDatuakBidalita']);
            echo 'mezuaIkusi();';

            echo 'gehitu_BesteBatzuk_Taula();';
            unset($_SESSION['bestebatzukizena']);
            unset($_SESSION['bestebatzukdata']);
            unset($_SESSION['bestebatzukdeskribapena']);
            unset($_SESSION['bestebatzukprezioa']);
          }
          ?>
        };
      </script>

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
    <script src="../js/zerbitzuakErregistratu.js"></script>
    <script src="../js/saioaitxi.js"></script>
</body>
</html>