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
    <link rel="stylesheet" href="../css/bidaiakErregistratu.css">
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
      <!--action="bidaiaInsert.php" method=POST-->
      <form action="" method="get" id="bidaiErregistroa">
        <label for="izena">Izena:</label><br>
        <input type="text" id="izena" name="izena"><br><br>
            
        <label>Bidaia mota:</label><br> <!-- Datu basetik atera -->

        <div>
          <select name="bidaiamota" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                    
              // Consulta para obtener todos los usuarios
              $getBidaia = "SELECT kodea, deskribapena FROM bidaia_motak";
              $result = $conn->query($getBidaia);
                    
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                  while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kodea'];
                  $deskribapena = $row['deskribapena'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$kodea'>$deskribapena</option>";
                }
              } else {
                  echo "<option value=''>Ez daude bidaiarik</option>";
              }
            ?>
          </select>
        </div>
        <br><br>
            
        <label>Hasiera Data:</label><br>
        <input type="date" id="hasieradata"><br><br>
            
        <label>Amaiera Data:</label><br>
        <input type="date" id="amaieradata"><br><br>
            
        <label>Egunak:</label><br> <!-- if (zbk < 1){alerta} -->
        <input type="number" id="egunak"><br><br>
            
        <label>Herrialdea:</label><br> <!-- Datu basetik atera -->
        <div>
          <select name="herrialdea" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              // Incluir el archivo de conexión
              require 'conexioa.php';
                    
              // Consulta para obtener todos los usuarios
              $getHerria = "SELECT kod_herrialdeak, herrialdeak FROM herrialdeak";
              $result = $conn->query($getHerria);
                    
              // Verificar si hay resultados
              if ($result->num_rows > 0) {
                // Recorrer los resultados y generar las opciones del select
                while ($row = $result->fetch_assoc()) {
                  $kodea = $row['kod_herrialdeak'];
                  $izena = $row['herrialdeak'];
                  // Mostrar el nombre en el valor del option y la contraseña como texto visible
                  echo "<option value='$kodea'>$izena</option>";
                }
              } else {
                  echo "<option value=''>No hay usuarios disponibles</option>";
              }
            ?>
          </select>
        </div>
        <br><br>
            
        <label>Deskribapena:</label><br>
        <textarea name="desc" id="deskribapena"></textarea>
        <br><br>
            
        <label>Kanpoan geratzen diren zerbitzuak:</label>
        <br>
        <textarea name="kanpZerb" id="kanpZerb"></textarea>
        <br><br>
        <input type="submit" id="bidaiagorde" value="GORDE">
      </form>
      <br><br>
      <table>
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
    </section>
</body>
<script src="../js/bidaiakErregistratu.js"></script>
</html>