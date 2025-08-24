<?php

use Martin\VelhaGame\Models\Velha;

it('inicia o tabuleiro vazio', function () {
    $velha = new Velha();
    $board = $velha->getBoard();
    expect($board)->toBe([
        ["", "", ""],
        ["", "", ""],
        ["", "", ""]
    ]);
});

it('alterna o jogador após uma jogada', function () {
    $velha = new Velha();
    $velha->play(0, 0);
    expect($velha->getCurrentPlayer())->toBe('O');
});

it('detecta vitória na linha', function () {
    $velha = new Velha();
    $velha->play(0, 0); // X
    $velha->play(1, 0); // O
    $velha->play(0, 1); // X
    $velha->play(1, 1); // O
    $velha->play(0, 2); // X
    expect($velha->checkWinner())->toBe('X');
});