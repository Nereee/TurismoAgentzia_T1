<?php
require 'conexioa.php';

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el JSON enviado desde JavaScript
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Asegurarse de que 'codigoVuelo' está presente
    if (isset($data['joanekokodeaValue'])) {
        $joanekoHegaldiKodea = $data['joanekokodeaValue'];

        $sql = "SELECT COUNT(*) FROM joaneko_hegaldia WHERE kodea = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $joanekoHegaldiKodea); // 's' para string
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        // Devolver la respuesta en formato JSON
        if ($count > 0) {
            // Si el código de vuelo existe
            echo json_encode(['errepikatuta' => true]);
        } else {
            // Si el código de vuelo no existe
            echo json_encode(['errepikatuta' => false]);
        }


        $sql = "SELECT COUNT(*) FROM joan_etorriko_hegaldia WHERE kodea = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $joanekoHegaldiKodea); // 's' para string
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            // Si el código de vuelo existe
            echo json_encode(['errepikatuta' => true]);
        } else {
            // Si el código de vuelo no existe
            echo json_encode(['errepikatuta' => false]);
        }


        $stmt->close();
        $conn->close();
    } else {
        // Si no se ha recibido el código de vuelo
        echo json_encode(['error' => 'Ez da jaso hegaldi koderik']);
    }
}
?>