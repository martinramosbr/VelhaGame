const board = document.getElementById("board");
const statusEl = document.getElementById("status");

for (let r = 0; r < 3; r++) {
    for (let c = 0; c < 3; c++) {
        let cell = document.createElement("div");
        cell.classList.add("cell");
        cell.dataset.row = r;
        cell.dataset.col = c;
        cell.addEventListener("click", playMove);
        board.appendChild(cell);
    }
}

let gameState = { board: [["", "", ""], ["", "", ""], ["", "", ""]], currentPlayer: "X", winner: null };

function render(data) {
    gameState = data;
    updateBoard(gameState.board);
    statusEl.textContent = gameState.winner
        ? `Jogador ${gameState.winner} venceu!`
        : `Vez do jogador: ${gameState.currentPlayer}`;
}

function loadState() {
    fetch("../src/Controllers/VelhaController.php?action=state", { credentials: "same-origin" })
        .then(r => r.json())
        .then(render);
}

function playMove(e) {
    if (gameState.winner) return;
    if (e.target.textContent) return;

    const row = e.target.dataset.row;
    const col = e.target.dataset.col;

    fetch("../src/Controllers/VelhaController.php?action=play", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        credentials: "same-origin",
        body: `row=${encodeURIComponent(row)}&col=${encodeURIComponent(col)}`
    })
        .then(r => r.json())
        .then(render);
}

document.getElementById("reset").addEventListener("click", () => {
  fetch("../src/Controllers/VelhaController.php?action=reset", { credentials: "same-origin" })
    .then(r => r.json())
    .then(render);
});

window.addEventListener("DOMContentLoaded", loadState);

function updateBoard(boardState) {
    document.querySelectorAll(".cell").forEach(cell => {
        const r = cell.dataset.row, c = cell.dataset.col;
        const value = boardState[r][c];
        
        cell.textContent = value;
        cell.classList.remove("x", "o");
        
        if (value === "X") {
            cell.classList.add("x");
        } else if (value === "O") {
            cell.classList.add("o");
        }
    });
}
