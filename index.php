<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?
require_once('dbconnect.php');
include('app.php');
?>
<?$limit = 10; 
if ($_GET['page'] && $_GET['page'] != '') {
	$page = $_GET['page'];
}
else {
$page = 1;}?>
<?$workers = show_workers($connect,$limit,$page);
$count = get_count($connect);
$pages = ceil($count/$limit);
$position_list = get_positions($connect);
?>

	<div class="wrapper">

		<div class="row controls">
			<a href="" onclick="update(<?=$page?>,<?=$limit?>); return false;" id="refresh"><img src="images/refresh.png" alt=""></a>
			<?if ($page>1) {?>
				<a href="/?page=<?echo ($page-1);?>" id="prev"><img src="images/arrow.png" alt=""></a>
			<?}?>
			
			<span id="page"><?=$page?></span>
			<?if ($page<$pages) {?>
			<a href="/?page=<?echo ($page+1);?>" id="next"><img src="images/arrow.png" alt=""></a>
			<?}?>
		</div>
		<div class="header row">
			<div class="w-1-4 col">ФИО</div>
			<div class="w-1-4 col">Должность</div>
			<div class="w-1-4 col">Дата приема</div>
			<div class="w-1-8 col">Работает сейчас</div>
			<div class="w-1-8 col">Управление</div>
		</div>
		<div class="table" id="table">
			<?
				foreach ($workers as $key => $value) {
					$color = 'blue';
					if ($value['status'] == 0) {
						$color = 'gray';
					}
					if ($value['date'] == '0000-00-00') {
						$value['date'] = '<b>-</b>';
					}
					echo '<div id="'.$value['id'].'" class="row '.$color.'">';
					echo '<div class="w-1-4 col"><p class="fio" onclick="edit_row('.$value['id'].');">'.$value['fio'].'</p></div>';
					echo '<div class="w-1-4 col"><p>'.$value['position'].'</p></div>';
					echo '<div class="w-1-4 col"><p>'.$value['date'].'</p></div>';
					echo '<div class="w-1-8 col">';
					if ($value['status']==1) {
						echo '<input type="checkbox" onclick="set_status('.$value['id'].',0);" checked>';
					}
					else {echo '<input type="checkbox" onclick="set_status('.$value['id'].',1);">';}
					echo '</div>';
					echo '<div class="w-1-8 col"><a class="edit" onclick="edit_row('.$value['id'].');"></a><a class="delete" onclick="delete_row('.$value['id'].')"></a></div>';
					echo '</div>';
				}
			?>
		</div>
		<button class="add_but" onclick="modal_on('add_window');">Добавить</button>
	</div>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="functions.js"></script>
<div class="modal" id="add_window">
	<form name="addform" id="forma" onsubmit="add(this);modal_off();return false">
		<p>ФИО</p>
		<input type="text" name="fio">
		<p>Должность</p>
		<select name="position" id="">
			<?
			foreach ($position_list as $key => $value) {
				echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
			}
			?>
		</select>
		<p>Дата</p>
		<input type="date" name="date">
		<button>Сохранить</button>
		<button onclick="modal_off(); return false">Отмена</button>
	</form>
</div>

<div class="modal" id="edit_window">
	<form name="editform" id="editform" onsubmit="save(this);modal_off();return false">
		<input type="hidden" name="id">
		<p>ФИО</p>
		<input type="text" name="fio">
		<p>Должность</p>
		<select name="position" id="">
			<?
			foreach ($position_list as $key => $value) {
				echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
			}
			?>
		</select>
		<p>Дата</p>
		<input type="date" name="date">

		<button>Сохранить</button>
		<button onclick="modal_off(); return false">Отмена</button>
	</form>
</div>

</body>
</html>