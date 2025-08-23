<?php

class Velha
{
    private $board;
    private $currentPlayer;

    public function __construct()
    {
        $this->board = array_fill(0, 3, array_fill(0, 3, ""));
        $this->currentPlayer = "X";
    }

    public function play($row, $col)
    {
        if (
            isset($this->board[$row]) &&
            isset($this->board[$row][$col]) &&
            $this->board[$row][$col] === ""
        ) {
            $this->board[$row][$col] = $this->currentPlayer;
            $this->switchPlayer();
            return true;
        }
        return false;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function getCurrentPlayer()
    {
        return $this->currentPlayer;
    }

    public function checkWinner()
    {
        if (!$this->board) {
            return null;
        }
        
        $b = $this->board;
        for ($i = 0; $i < 3; $i++) {
            if (isset($b[$i]) && isset($b[$i][0]) && isset($b[$i][1]) && isset($b[$i][2]) &&
                $b[$i][0] !== "" && $b[$i][0] === $b[$i][1] && $b[$i][1] === $b[$i][2])
                return $b[$i][0];
            if (isset($b[0][$i]) && isset($b[1][$i]) && isset($b[2][$i]) &&
                $b[0][$i] !== "" && $b[0][$i] === $b[1][$i] && $b[1][$i] === $b[2][$i])
                return $b[0][$i];
        }
        if (isset($b[0][0]) && isset($b[1][1]) && isset($b[2][2]) &&
            $b[0][0] !== "" && $b[0][0] === $b[1][1] && $b[1][1] === $b[2][2])
            return $b[0][0];
        if (isset($b[0][2]) && isset($b[1][1]) && isset($b[2][0]) &&
            $b[0][2] !== "" && $b[0][2] === $b[1][1] && $b[1][1] === $b[2][0])
            return $b[0][2];
        return null;
    }

    private function switchPlayer()
    {
        $this->currentPlayer = ($this->currentPlayer === "X") ? "O" : "X";
    }
}