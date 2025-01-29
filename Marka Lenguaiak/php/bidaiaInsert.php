<?php
session_start();
require 'conexioa.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $izena = $_POST['izena'];
    $bidaiamota = $_POST['bidaiamota'];
    $hasieradata = $_POST['hasieradata'];
    $amaieradata = $_POST['amaieradata'];
    $egunak = $_POST['egunak'];
    $herrialdea = $_POST['herrialdea'];
    $deskribapena = $_POST['desc'];
    $kanpZerb = $_POST['kanpZerb'];

    // Insertar en la base de datos
    $sql = "INSERT INTO bidaia (izena, bidaiamota, hasieradata, amaieradata, egunak, herrialdea, deskribapena, kanpZerb)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssss", $izena, $bidaiamota, $hasieradata, $amaieradata, $egunak, $herrialdea, $deskribapena, $kanpZerb);
        
        if ($stmt->execute()) {
            // Respondemos con un JSON que contiene los datos insertados
            echo json_encode([
                'success' => true,
                'bidaiak' => $izena,
                'bidaiamota' => $bidaiamota,
                'hasieradata' => $hasieradata,
                'amaieradata' => $amaieradata,
                'egunak' => $egunak,
                'herrialdea' => $herrialdea,
                'deskribapena' => $deskribapena
            ]);
        } else {
            echo json_encode(['success' => false]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false]);
    }
    $conn->close();
}
?>
