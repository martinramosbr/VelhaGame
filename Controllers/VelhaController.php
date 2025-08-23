<?php
session_start();
require_once(__DIR__ . '/../Models/Velha.php');

if (!isset($_SESSION['velha'])) {
    $_SESSION['velha'] = new Velha();
}

$game = $_SESSION['velha'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $row = $_POST["row"];
    $game->play($row);
    echo json_encode([
        "board" => $game->getBoard(),
        "currentPlayer" => $game->getCurrentPlayer()
    ]);
    exit;
}