<?php




class NewsController
{

	public $servername;
	public $username;
	public $password;

	public $my_db;



	public function showAllNews()
	{
		$row = $this->DBModel->getAllNews();

		include 'index.php';
	}

	public function showLastNews()
	{
		$last_news = $this->DBModel->getLastNews();
		include 'index.php';
	}

}

$link = new mysqli("localhost", "root", "", "news");





include_once('Model/DBModel.php');



?>