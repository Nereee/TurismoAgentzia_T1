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
    <link rel="stylesheet" href="../css/bidaiakErregistratu.css">
    <link rel="stylesheet" href="../css/saioaItxi.css">
</head>

<body>
    <header>
        <input type="submit" class="atzera" id="atzerabid" value=''>
        <img id="sessionLogoa" src="<?php if(isset($_SESSION['agentziaLogoa'])){
            echo htmlspecialchars($_SESSION['agentziaLogoa']); }?>" alt="Logoa">
        <div id="sessionIzena"><?php if(isset($_SESSION['agentziaIzena'])){
            echo htmlspecialchars($_SESSION['agentziaIzena']); }?></div>
        <input type="submit" id="saioaitxi" value="Itxi saioa">
    </header>
    <section>
      <form action="bidaiaInsert.php" method="POST" id="bidaiErregistroa">
        <label for="izena">Izena:</label><br>
        <input type="text" id="izena" name="izena" value="<?php echo isset($_SESSION['izena']) ? $_SESSION['izena'] : ''; ?>"><br><br>
            
        <label>Bidaia mota:</label><br>
        <div>
          <select name="bidaiamota" id="bidaiamota" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              require 'conexioa.php';
                    
              $getBidaia = "SELECT kodea, deskribapena FROM bidaia_motak";
              $result = $conn->query($getBidaia);
                    
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kodea'];
                  $deskribapena = $row['deskribapena'];

                  $selected = (isset($_SESSION['bidaiamota']) && $_SESSION['bidaiamota'] == $kodea) ? "selected" : "";
                  echo "<option value='$kodea' $selected>$deskribapena</option>";
                }
              } else {
                  echo "<option value=''>Ez daude bidaiarik</option>";
              }
            ?>
          </select>
        </div>
        <br><br>
            
        <label>Hasiera Data:</label><br>
        <input type="date" name="hasieradata" id="hasieradata" value="<?php echo isset($_SESSION['hasieradata']) ? $_SESSION['hasieradata'] : ''; ?>"><br><br>
            
        <label>Amaiera Data:</label><br>
        <input type="date" name="amaieradata" id="amaieradata" value="<?php echo isset($_SESSION['amaieradata']) ? $_SESSION['amaieradata'] : ''; ?>"><br><br>
            
        <label>Egunak:</label><br>
        <input type="text" name="egunak" id="egunak" disabled><br><br>
        
            
        <label>Herrialdea:</label><br>
        <div>
          <select name="herrialdea" id="herrialdea" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              require 'conexioa.php';
                    
              $getHerria = "SELECT kod_herrialdeak, herrialdeak FROM herrialdeak";
              $result = $conn->query($getHerria);
                    
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kod_herrialdeak'];
                  $izena = $row['herrialdeak'];

                  $selected = (isset($_SESSION['herrialdea']) && $_SESSION['herrialdea'] == $kodea) ? "selected" : "";
                  echo "<option value='$kodea' $selected>$izena</option>";
                }
              } else {
                  echo "<option value=''>No hay usuarios disponibles</option>";
              }
            ?>
          </select>
        </div>
        <br><br>
            
        <label>Deskribapena:</label><br>
        <textarea name="deskribapena" id="deskribapena"><?php echo isset($_SESSION['deskribapena']) ? $_SESSION['deskribapena'] : ''; ?></textarea>
        <br><br>
            
        <label>Kanpoan geratzen diren zerbitzuak:</label>
        <br>
        <textarea name="kanpZerb" id="kanpZerb"><?php echo isset($_SESSION['kanpZerb']) ? $_SESSION['kanpZerb'] : ''; ?></textarea>
        <br><br>
        <input type="submit" id="bidaiagorde" value="GORDE">
      </form>
      <br><br>
      <div id="mezua" style='display:none'><p><b>Datuak ondo gorde dira datu basean</b></p></div>

      <script>
        window.onload = function() {
          function taula() {
            let izena = document.getElementById('izena').value;
            let bidaiamota = document.getElementById('bidaiamota');
            let hasieradata = document.getElementById('hasieradata').value;
            let amaieradata = document.getElementById('amaieradata').value;
            let iraupena = document.getElementById('egunak').value;
            let herrialdea = document.getElementById('herrialdea');
            let deskribapena = document.getElementById('deskribapena').value;

            if (hasieradata && amaieradata) {
              let HData = new Date(hasieradata);
              let AData = new Date(amaieradata);
              let egunak = Math.floor((AData - HData) / (1000 * 60 * 60 * 24)) + 1;
              iraupena = egunak;
            }

            let taula = document.querySelector('table');
            let body = taula.tBodies[0];

            let lerroa = body.insertRow();

            let bidaiaZelda = lerroa.insertCell();
            bidaiaZelda.innerText = izena;

            let bidaiaMotaTextua = bidaiamota.options[bidaiamota.selectedIndex].text;
            let bidaiaMotaZelda = lerroa.insertCell();
            bidaiaMotaZelda.innerText = bidaiaMotaTextua;

            let hasieraDataZelda = lerroa.insertCell();
            hasieraDataZelda.innerText = hasieradata;

            let amaieraDataZelda = lerroa.insertCell();
            amaieraDataZelda.innerText = amaieradata;

            let egunakZelda = lerroa.insertCell();
            egunakZelda.innerText = iraupena;

            let herrialdeTextua = herrialdea.options[herrialdea.selectedIndex].text;
            let herrialdeaZelda = lerroa.insertCell();
            herrialdeaZelda.innerText = herrialdeTextua;

            let deskribapenaZelda = lerroa.insertCell();
            deskribapenaZelda.innerText = deskribapena;

            let lerroKant = body.rows.length;

            if (lerroKant > 0) {
              taula.style.display = 'table';
            }

            document.getElementById('izena').value = "";
            bidaiamota.value = "";
            document.getElementById('hasieradata').value = "";
            document.getElementById('amaieradata').value = "";
            document.getElementById('egunak').value = "";
            herrialdea.value = "";
            document.getElementById('deskribapena').value = "";
            document.getElementById('kanpZerb').value = "";
          }

          function mezuaIkusi() {
            document.getElementById('mezua').style.display = 'block';

            setTimeout(function() {
              document.getElementById('mezua').style.display = 'none';
            }, 5000);
          }

          <?php
          if(isset($_SESSION['datuakBidalita'])){
            unset($_SESSION['datuakBidalita']);

            echo 'mezuaIkusi();';
            echo 'taula();';
            unset($_SESSION['izena']);
            unset($_SESSION['bidaiamota']);
            unset($_SESSION['hasieradata']);
            unset($_SESSION['amaieradata']);
            unset($_SESSION['egunak']);
            unset($_SESSION['herrialdea']);
            unset($_SESSION['deskribapena']);
            unset($_SESSION['kanpZerb']);
          }
          ?>
        };
      </script>

      <br>
      <table style='display:none'>
        <thead>
          <tr>
            <th>BIDAIA</th>
            <th>BIDAIA MOTA</th>
            <th>HASIERA DATA</th>
            <th>AMAIERA DATA</th>
            <th>EGUNAK</th>
            <th>HERRIALDEA</th>
            <th>DESKRIBAPENA</th>
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
    <script src="../js/bidaiakErregistratu.js"></script>
    <script src="../js/saioaitxi.js"></script>
</body>
</html>