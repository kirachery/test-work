<?php


include('dbconnect.php');
function del_worker($id,$con) {
	$query = "DELETE FROM `worker_list` WHERE `worker_list`.`id` = ".$id;
	mysqli_query($con,$query);
}
function add_worker($fio,$position,$date,$con) {
	$query = "INSERT INTO `worker_list` (`fio`, `status`, `date`, `position`) VALUES ('".$fio."', '1','".$date."','".$position."')";
	mysqli_query($con,$query);
	return $query;
}
function up_worker($id,$fio,$date,$position,$con){
	$query = "UPDATE `worker_list` SET `position` = '".$position."', `fio` = '".$fio."', `date` = '".$date."' WHERE `worker_list`.`id` = ".$id;
	mysqli_query($con,$query);


}
function update_table($link,$limit,$page) {
	$start = ($page-1)*$limit;
	$query = "SELECT t1.id,t1.fio,t2.name as position,t1.status,t1.date FROM worker_list t1 INNER JOIN positions t2 ON t1.position = t2.code LIMIT ".$start.", ".$limit;
	$returned = mysqli_query($link,$query);
	$array = mysqli_fetch_all($returned,1);
	return $array;

}
function set_status($id,$status,$con){
	if ($status==0) {
		$query = "UPDATE `worker_list` SET `status` = '".$status."',`date` = NULL WHERE `worker_list`.`id` = ".$id;
	}
	else {
		$date = date("Y-m-d H:i:s");
	$query = "UPDATE `worker_list` SET `status` = '".$status."',`date` = '".$date."' WHERE `worker_list`.`id` = ".$id;
	}
	mysqli_query($con,$query);

}
function find($id,$con) {
	$query = "SELECT * FROM `worker_list` WHERE `id` = ".$id;
	$returned = mysqli_query($con,$query);
	$array = mysqli_fetch_all($returned,1);
	return $array;

}
/*function add($link,$fio.$position,$date) {
	$query = "INSERT INTO `worker_list` (`id`, `fio`, `status`, `date`, `position`) VALUES (NULL, \'Курица Пидор Сука\', \'1\', \'2018-02-07\', \'Dr\')";
	$returned = mysqli_query($link,$query);
	$array = mysqli_fetch_all($returned,1);
	return $array;

}*/

if ($_POST['deletable'] && $_POST['deletable'] != '') {
	del_worker($_POST['deletable'],$connect);
	echo $_POST['deletable'];
}

if ($_POST['update'] == 1) {
	$array = update_table($connect,$_POST['lim'],$_POST['page']);
	$res = json_encode($array);
	echo $res;
}

if ($_POST['add'] == 1) {
	add_worker($_POST['fio'],$_POST['position'],$_POST['date'],$connect);
}

if ($_POST['save'] == 1) {
	up_worker($_POST['id'],$_POST['fio'],$_POST['date'],$_POST['position'],$connect);

}

if ($_POST['change_status'] == 1) {
	set_status($_POST['id'],$_POST['status'],$connect);
}

if ($_POST['find'] == 1) {
	$array = find($_POST['id'],$connect);
	$res = json_encode($array);
	echo $res;
}