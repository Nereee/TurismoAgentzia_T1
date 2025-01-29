<?php
session_start();
require 'conexioa.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <section>
    <form action="php/login.php" method="POST" id="login">
      <label for="erabiltzailea" id="erabiltzailealabel"><b>Erabiltzailea: </b></label>
      <br>
      <input type="text" id="erabiltzailea" name="erabiltzailea" required>
      <br><br>
      <label for="pasahitza" id="pasahitzalabel"><b>Pasahitza: </b></label>
      <br>
      <input type="password" id="pasahitza" name="pasahitza" required>
      <br>
      <label for="pasahitzaikusi" id="pasahitzaikusilabel">Ikusi pasahitza: <input type="checkbox" name="pasahitzaikusi"
          id="pasahitzaikusi"></label>
      <br><br><br>
      <input type="submit" id="saioahasi" value="Saioa hasi">
    </form>
  </section>
</body>
<script src="js/login.js"></script>
<H1></H1>
</html>

<?php
$nombre = htmlspecialchars(trim($_POST['erabiltzailea']));
$pasahitza = htmlspecialchars(trim($_POST['pasahitza']));

$sql = "SELECT erabiltzailea, pasahitza, izena FROM agentzia WHERE erabiltzailea = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ((string)$pasahitza === (string)$user['pasahitza']) {
        session_regenerate_id(true);
        $_SESSION['agentzia'] = $user['izena'];
        $_SESSION['erabiltzailea'] === $user['erabiltzailea'];
        header("Location: menuPrintzipala.php");
        exit();
    } else {
        echo "<script>
            alert('Pasahitza okerra da. Saiatu berriro.');
            window.location.href = '../index.html';
        </script>";
    }         
} else {
    echo "<script>
        alert('Erabiltzailearen izena ez da existitzen.');
        window.location.href = '../index.html';
    </script>";
}
$conn->close();
?>