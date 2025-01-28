<?php
session_start();
require 'conexion.php';

$nombre = htmlspecialchars(trim($_POST['erabiltzailea']));
$pasahitza = htmlspecialchars(trim($_POST['pasahitza']));

$sql = "SELECT * FROM usuarios WHERE nombre = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ((string)$pasahitza === (string)$user['contraseña']) {
        session_regenerate_id(true);
        $_SESSION['nombre'] === $user['nombre'];
        header("Location: ../html/menuPrintzipala.html");
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