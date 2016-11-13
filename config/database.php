<?php
	/*
	*koneksi PDO
	*sesuaikan configurasi sesuai database di pc masing-masing
	*/

	class Database
	{
		private $host     = "localhost";
		private $db_name  = "db_pdo_crud";
		private $username = "root";
		private $password = "dZfJnPcBj2Qqyfz5"; //kosongkan jika mysql anda tidak dipassword

		private $conn;

		public function getConnection()
		{
			$this->conn = null;

			try
			{
				$this->conn = new PDO("mysql:host=".$this->host."; dbname=".$this->db_name, $this->username, $this->password);
			}
			catch(PDOException $exception)
			{
				echo "koneksi error: " . $exception->getMessage();
			}

			return $this->conn;
		}

		//tutup koneksi
		public function __destruct()
		{
			$this->conn = null;
		}
	}
?>