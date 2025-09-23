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

it('detecta vitória na coluna', function () {
    $velha = new Velha();
    $velha->play(0, 0); // X
    $velha->play(0, 1); // O
    $velha->play(1, 0); // X
    $velha->play(0, 2); // O
    $velha->play(2, 0); // X
    expect($velha->checkWinner())->toBe('X');
});

it('detecta vitória na diagonal principal', function () {
    $velha = new Velha();
    $velha->play(0, 0); // X
    $velha->play(0, 1); // O
    $velha->play(1, 1); // X
    $velha->play(0, 2); // O
    $velha->play(2, 2); // X
    expect($velha->checkWinner())->toBe('X');
});

it('detecta vitória na diagonal secundária', function () {
    $velha = new Velha();
    $velha->play(0, 2); // X
    $velha->play(0, 0); // O
    $velha->play(1, 1); // X
    $velha->play(0, 1); // O
    $velha->play(2, 0); // X
    expect($velha->checkWinner())->toBe('X');
});

it('não permite jogar em posição ocupada', function () {
    $velha = new Velha();
    $velha->play(0, 0); // X
    $result = $velha->play(0, 0); // Tentativa de jogar na mesma posição
    expect($result)->toBe(false);
    expect($velha->getCurrentPlayer())->toBe('O'); // Jogador não deve ter mudado
});

it('não permite jogar fora dos limites', function () {
    $velha = new Velha();
    $result1 = $velha->play(-1, 0); // Linha negativa
    $result2 = $velha->play(0, 3);  // Coluna fora do limite
    $result3 = $velha->play(3, 0);  // Linha fora do limite
    
    expect($result1)->toBe(false);
    expect($result2)->toBe(false);
    expect($result3)->toBe(false);
    expect($velha->getCurrentPlayer())->toBe('X'); // Jogador deve permanecer X
});

it('detecta empate quando tabuleiro está cheio sem vencedor', function () {
    $velha = new Velha();
    
    // Simular um jogo que termina em empate
    $velha->play(0, 0); // X
    $velha->play(0, 1); // O
    $velha->play(0, 2); // X
    $velha->play(1, 0); // O
    $velha->play(1, 1); // X
    $velha->play(2, 0); // O
    $velha->play(1, 2); // X
    $velha->play(2, 2); // O
    $velha->play(2, 1); // X
    
    expect($velha->checkWinner())->toBe(null);
    
    // Verificar se o tabuleiro está cheio
    $board = $velha->getBoard();
    $isEmpty = false;
    foreach ($board as $row) {
        foreach ($row as $cell) {
            if ($cell === "") {
                $isEmpty = true;
                break 2;
            }
        }
    }
    expect($isEmpty)->toBe(false);
});

it('retorna true para jogada válida', function () {
    $velha = new Velha();
    $result = $velha->play(0, 0);
    expect($result)->toBe(true);
});

it('retorna false para jogada inválida', function () {
    $velha = new Velha();
    $velha->play(0, 0); // Primeira jogada válida
    $result = $velha->play(0, 0); // Tentativa de jogar na mesma posição
    expect($result)->toBe(false);
});

it('alterna jogadores corretamente em múltiplas jogadas', function () {
    $velha = new Velha();
    
    expect($velha->getCurrentPlayer())->toBe('X');
    
    $velha->play(0, 0); // X
    expect($velha->getCurrentPlayer())->toBe('O');
    
    $velha->play(0, 1); // O
    expect($velha->getCurrentPlayer())->toBe('X');
    
    $velha->play(0, 2); // X
    expect($velha->getCurrentPlayer())->toBe('O');
    
    $velha->play(1, 0); // O
    expect($velha->getCurrentPlayer())->toBe('X');
});