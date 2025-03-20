<?php
	$last_news;
	class DBModel {
		//public $last_news;
		public function getAllNews(){
			
			global $sql, $link, $row;
			
			$sql = mysqli_query($link, "SELECT * FROM `news` ORDER BY `date` DESC");
			

			$row = mysqli_fetch_array($sql);
			return $row;

		}


		public function getLastNews(){
			global $sql, $link, $last_news;
			$sql = mysqli_query($link, "SELECT * FROM `news` ORDER BY `date` DESC");

			$last_news = mysqli_fetch_array($sql);
			//$this->last_news = $last_news = mysqli_fetch_array($sql);
			return $last_news;

		}

		public function getDetalNews(){
			global $sql, $link, $all;
			$sql = mysqli_query($link, "SELECT * FROM `news` ORDER BY `date` DESC");
			$all = mysqli_fetch_all($sql);
			return $all;
		}
	}
	$DBModel = new DBModel();
	$DBModel->getAllNews();
	$DBModel->getLastNews();
	$DBModel->getDetalNews();
	



?>