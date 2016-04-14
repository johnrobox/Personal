<?php

include('../Php/connection.php');

	$start=0;
	$limit=8;

	if(isset($_GET['page']))
	{
		$id=$_GET['page'];
		$start=($id-1)*$limit;
	}
	else{
		$id=1;
	}

	$categoryId = $_GET['id'];

	$sql = "SELECT * FROM image WHERE category_id = $categoryId  LIMIT $start, $limit" ;

	$result = $connection->query($sql);
	$tempArray = array();

	while($row = mysqli_fetch_assoc($result)) {
		$tempArray['images'][] = $row;
	}

	$sqlForCount = "SELECT COUNT(id) FROM image WHERE category_id = $categoryId";
	$rs_result = $connection->query($sqlForCount);
	$row = mysqli_fetch_row($rs_result);

	$total_records = $row[0];
	$total_pages = ceil($total_records / $limit);

	$tempArray['all_images'] = $total_records;
	$tempArray['all_pages'] = $total_pages;

	echo json_encode($tempArray);

	$connection->close();