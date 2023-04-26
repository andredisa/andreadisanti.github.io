// Definisci la griglia di gioco
var grid = [];
var gridSize = 10;
for (var i = 0; i < gridSize; i++) {
	grid[i] = [];
	for (var j = 0; j < gridSize; j++) {
		grid[i][j] = {hasMine: false, isRevealed: false};
	}
}

// Aggiungi le mine alla griglia di gioco
var numMines = 20;
for (var i = 0; i < numMines; i++) {
	var row = Math.floor(Math.random() * gridSize);
	var col = Math.floor(Math.random() * gridSize);
	if (grid[row][col].hasMine) {
		// Se la cella selezionata già contiene una mina, prova con un'altra cella
		i--;
	} else {
		grid[row][col].hasMine = true;
	}
}

// Crea la griglia di gioco nell'HTML
var gridEl = $('#grid');
for (var i = 0; i < gridSize; i++) {
	for (var j = 0; j < gridSize; j++) {
		var cellEl = $('<div class="cell"></div>');
		cellEl.attr('data-row', i);
		cellEl.attr('data-col', j);
		gridEl.append(cellEl);
	}
}

// Aggiungi un evento click a ciascuna cella della griglia
$('.cell').click(function() {
	var row = $(this).data('row');
	var col = $(this).data('col');
	var cell = grid[row][col];

	if (cell.isRevealed) {
		// Se la cella è già stata scoperta, non fare nulla
		return;
	}

	if (cell.hasMine) {
		// Se la cella contiene una mina, il gioco finisce
		$(this).addClass('mine');
		alert('Hai perso!');
		resetGame();
	} else {
		// Altrimenti, mostra il numero di mine adiacenti alla cella
		var numAdjacentMines = getNumAdjacentMines(row, col);
		$(this).addClass('revealed');
		cell.isRevealed = true;
		if (numAdjacentMines > 0) {
			$(this).text(numAdjacentMines);
		} else {
			// Se non ci sono mine adiacenti, mostra anche le celle adiacenti
			revealAdjacentCells(row, col);
		}
	}
});

// Aggiungi un evento click al pulsante "Nuova partita"
$('#reset').click(function() {
	resetGame();
});

// Funzione per ripristinare il gioco
function resetGame() {
	$('.cell').removeClass('revealed mine');
	grid = [];
	for (var i = 0; i < gridSize; i++) {
		grid[i] = [];
		for (var j = 0; j < gridSize; j++) {
			grid[i][j] = {hasMine: false, isRevealed: false};
		}
	}
	for (var i = 0; i < numMines; i++) {
		var row = Math.floor(Math.random() * gridSize);
		var col = Math.floor(Math.random() * gridSize);
		if (grid[row][col].hasMine) {
			i--;
		} else {
			grid[row][col].hasMine = true;
		}
	}
}

// Funzione per ottenere il numero di mine adiacenti alla cella
function getNumAdjacentMines(row, col) {
	var numMines = 0;
	for (var i = row - 1; i <= row + 1; i++) {
		for (var j = col - 1; j <= col + 1; j++) {
			if (i >= 0 && i < gridSize && j >= 0 && j < gridSize) {
				if (grid[i][j].hasMine) {
					numMines++;
				}
			}
		}
	}
	return numMines;
}

// Funzione per mostrare le celle adiacenti se non ci sono mine adiacenti
function revealAdjacentCells(row, col) {
	for (var i = row - 1; i <= row + 1; i++) {
		for (var j = col - 1; j <= col + 1; j++) {
			if (i >= 0 && i < gridSize && j >= 0 && j < gridSize) {
				var cellEl = $('[data-row="' + i + '"][data-col="' + j + '"]');
				var cell = grid[i][j];
				if (!cell.hasMine && !cell.isRevealed) {
					var numAdjacentMines = getNumAdjacentMines(i, j);
					cellEl.addClass('revealed');
					cell.isRevealed = true;
					if (numAdjacentMines > 0) {
						cellEl.text(numAdjacentMines);
					} else {
						revealAdjacentCells(i, j);
					}
				}
			}
		}
	}
}