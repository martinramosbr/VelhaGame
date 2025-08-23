<?php
require_once(__DIR__ . '/../Models/Velha.php');
session_start();
header('Content-Type: application/json');
header('Cache-Control: no-store');

if (!isset($_SESSION['velha']) || !($_SESSION['velha'] instanceof Velha)) {
    $_SESSION['velha'] = new Velha();
}

$game = $_SESSION['velha'];
$action = $_GET['action'] ?? 'state';

if ($action === 'play' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $row = filter_input(INPUT_POST, 'row', FILTER_VALIDATE_INT);
    $col = filter_input(INPUT_POST, 'col', FILTER_VALIDATE_INT);
    if ($row !== false && $col !== false) {
        $board = $game->getBoard();
        if (
            isset($board[$row]) &&
            isset($board[$row][$col]) &&
            $board[$row][$col] === "" &&
            $game->checkWinner() === null
        ) {
            $game->play($row, $col);
        }
    }
}

if ($action === 'reset') {
    $_SESSION['velha'] = new Velha();
    $game = $_SESSION['velha'];
}

echo json_encode([
    "board" => $game->getBoard(),
    "winner" => $game->checkWinner(),
    "currentPlayer" => $game->getCurrentPlayer()
]);