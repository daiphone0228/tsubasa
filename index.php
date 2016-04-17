<?php
	require('dbconnect.php');
	function json_safe_encode($data){
	    return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

	// フードとドリンクの情報を取得
	$sql = 'SELECT * FROM `drink` ORDER BY `drink_id`';
	$drinks = mysqli_query($db, $sql) or die (mysqli_error($db));

	$sql = 'SELECT * FROM `food` ORDER BY `food_id`';
	$foods = mysqli_query($db, $sql) or die (mysqli_error($db));
 ?>

<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="UTF-8">
	<title>Tsubasa's bro Store</title>
	<script type="text/javascript">
		function watch(){
			dd = new Date();
			document.F1.T1.value = dd.toLocaleString();
			window.setTimeout("watch()", 1000);
		}

		function changeSelect() {
			var select = document.getElementById('select');
			var options = document.getElementById('select').options;
			var num = options.item(select.selectedIndex).value;
			return num;
		}
	</script>
	<link rel="stylesheet" href="tsubasa.css">
</head>
<body onload="watch()">
	<form name="F1" action="#">
		<input type="text" name="T1" size=50>
	</form>
	<table class="total">
		<th>合計</th>
		<td>¥10000</td>
		<th>消費税</th>
		<td>¥800</td>
	</table>
	<table class="food">
		<thead>
			<tr>
				<th>商品名</th>
				<th>単価</th>
				<th>数量</th>
				<th>商品別小計</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($food = mysqli_fetch_assoc($foods)): ?>
			<tr>
				<td><?php echo htmlspecialchars($food['food_name'], ENT_QUOTES, 'UTF-8'); ?></td>
				<td id=price>¥<?php echo htmlspecialchars($food['food_price'], ENT_QUOTES, 'UTF-8'); ?></td>
				<td>
					<select id=select name="num" onChange="changeSelect()">
						<?php for($i=0; $i<=20; $i++){
							echo "<option value=". $i .">". $i. "</option>" . "<br>";
							}
						 ?>
					</select>
				</td>
				<td>
					<script type="text/javascript">
						// 変数定義する
						var price = '<?php echo $food['food_price']; ?>';
						document.write(num);
						document.write(price);
						// var sum = num * price;
						// document.write(sum);
						document.write("あ");
					</script>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
	<table class="drink">
		<thead>
			<tr>
				<th>商品名</th>
				<th>単価</th>
				<th>数量</th>
				<th>商品別小計</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($drink = mysqli_fetch_assoc($drinks)): ?>
			<tr>
				<td><?php echo htmlspecialchars($drink['drink_name'], ENT_QUOTES, 'UTF-8'); ?></td>
				<td>¥<?php echo htmlspecialchars($drink['drink_price'], ENT_QUOTES, 'UTF-8'); ?></td>
				<td>
					<select name="num" onChange="calc()">
						<?php for($i=0; $i<=20; $i++){
							echo "<option>". $i. "</option>" . "<br>";
							}
						 ?>
					</select>
				</td>
				<td>
					<script type="text/javascript">
						// 変数定義する
						var num = '<?php echo $i; ?>'
						var price = '<?php echo $drink['drink_price']; ?>'

						// numをクリックしたら、functionの中身を実行
						var sum = num * price;
						document.write(sum);
					</script>
				</td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</body>
</html>


