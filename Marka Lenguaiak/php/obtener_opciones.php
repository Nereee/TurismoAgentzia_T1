<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de conexión a la base de datos
$host = "localhost";
$user = "root"; // Cambiar si tienes un usuario diferente
$password = ""; // Cambiar si tienes una contraseña
$database = "ejemplo_db";

// Crear conexión
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los datos de la tabla
$sql = "SELECT nombre FROM opciones";
$result = $conn->query($sql);

// Verificar si hay resultados y generar el desplegable
if ($result->num_rows > 0) {
    echo '<select name="opciones" id="opciones">';
    echo '<option value="">Seleccione una opción</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['nombre']) . '">' . htmlspecialchars($row['nombre']) . '</option>';
    }
    echo '</select>';
} else {
    echo '<select name="opciones" id="opciones">';
    echo '<option value="">No hay opciones disponibles</option>';
    echo '</select>';
}

// Cerrar conexión
$conn->close();
?>
