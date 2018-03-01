<?php
function show_workers($link,$limit,$page) {
	$start = ($page-1)*$limit;
	$query = "SELECT t1.id,t1.fio,t2.name as position,t1.status,t1.date FROM worker_list t1 INNER JOIN positions t2 ON t1.position = t2.code LIMIT ".$start.", ".$limit;
	$returned = mysqli_query($link,$query);
	$array = mysqli_fetch_all($returned,1);
	return $array;

}

function del_worker($link,$id) {
	$query = "DELETE FROM `worker_list` WHERE `worker_list`.`id` = ".$id;
}

function get_positions($link) {
	$query = "SELECT * FROM `positions`";
	$returned = mysqli_query($link,$query);
	$array = mysqli_fetch_all($returned,1);
	return $array;

}
function get_count($link) {
	$query = "SELECT COUNT(*) as count FROM `worker_list`";
	$returned = mysqli_query($link,$query);
	$array = mysqli_fetch_all($returned,1);
	return $array[0]['count'];

}