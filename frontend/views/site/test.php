<script>
	var board = [
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0],
		[0,0,0,0,0,0,0,0,0,0]
	];

	// 0为空，1为黑棋，2为白棋
	var chess = 1;

	var continuous = 1;
	var continuous_max = continuous;

	var ishead = 0;
	var istail = 0;

	$(function() {
		// 1.读取棋盘数据
		for (var y = 0; y < 10; y++) {
			for (var x = 0; x < 10; x++) {
				console.log(board[y][x]);
				// 2.如果读取到我方棋子，判断其八个方位
				for (var i = 1; i < 9; i++) {
					if (y + i < 10) {
						// 上方
						if (board[y+i][x] == chess) {
							continuous++;
						} else {
							if (board[y+i][x] != 0) {
								ishead = 1;
							}
						}
					} else {
						break;
					}
				}
				for (var i = 1; i < 9; i++) {
					if (y - i > -1) {
						// 下方
						if (board[y-i][x] == chess) {
							continuous++;
						} else {
							if (board[y-1][x] != 0) {
								istail = 1;
							}
						}
					} else {
						break;
					}
				}

				if (x - 1 > -1) {
					board[y][x-1] // 左方
				}
				if (x + 1 < 10) {
					board[y][x+1] // 右方
				}

				if (y + 1 < 10 && x - 1 > -1) {
					board[y+1][x-1] // 左上
				}
				if (y - 1 > -1 && x + 1 < 10) {
					board[y-1][x+1] // 右下
				}

				if (y + 1 < 10 && x + 1 < 10) {
					board[y+1][x+1] // 右上
				}
				if (y - 1 > -1 && x - 1 > -1) {
					board[y-1][x-1] // 左下
				}
			}
			console.log("\r");
		}
	});

	function check() {
		if (continuous > continuous_max) {
			continuous_max = continuous;
		}
	}
</script>