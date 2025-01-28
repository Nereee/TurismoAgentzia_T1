<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bidaiak Erregistratu</title>
    <link rel="stylesheet" href="../css/maketazioa.css">
    <link rel="stylesheet" href="../css/bidaiakEr.css">
</head>

<body>
    <header>
        <!--<img src="../img/logoadib.jpg" alt="logoadib" id="logoadib">-->
        <input type="submit" id="saioaitxi" value="Itxi saioa">
    </header>
    <section>
      <!--action="php/bidaiakErregistratu.php"-->
      <form action="#" method="get" id="zerbitzuErregistroa">
        <label for="bidaia">Aukeratu bidaia:</label><br>
        <div>
          <select name="bidaia" class="select-css">
            <option value="">--Aukeratu--</option>
            <?php
              // Incluir el archivo de conexión
              require 'conexia.php';
                    
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
                  echo "<option value=''>No hay usuarios disponibles</option>";
              }
            ?>
          </select>
        </div>
        <br><br>
            
        <label for="zeinzerbitzu">Zein zerbitzu erregistratu behar duzu?</label><br>
        <label for="hegaldizerbitzua"><input type="radio" name="zeinzerbitzu" id="hegaldia" value="Hegaldia"></label>

        <br><br>
        <input type="submit" id="bidaiagorde" value="GORDE">
      </form>
      <br><br>

    </section>
</body>
<script src="/js/bidaiakErregistratu.js"></script>
</html>