<?php

class Velha {
    private $board;
    private $currentPlayer;

    public function __construct() {
        $this->board = array_fill(0, 9, null);
        $this->currentPlayer = 'X';
    }

    public function play($posicao) {
        if ($this->board[$posicao] === null) {
            $this->board[$posicao] = $this->currentPlayer;
            $this->currentPlayer = ($this->currentPlayer === 'X') ? 'O' : 'X';
        }
    }

    public function getBoard() {
        return $this->board;
    }

    public function getCurrentPlayer() {
        return $this->currentPlayer;
    }
}