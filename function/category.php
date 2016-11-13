<?php
	class Category
	{
		private $conn;
		private $table_name = "categories";

		private $id;
		private $nama;

		public function __construct($db)
		{
			$this->conn = $db;
		}

		/*====================METHOD GETTER=======================*/

		/*
		*ambil nama tabel
		*/
		public function getTable()
		{
			return $this->table_name;
		}

		/*
		*ambil id kategori
		*/
		public function getID()
		{
			return $this->id;
		}

		/*
		*ambil nama kategori
		*/
		public function getNama()
		{
			return $this->nama;
		}

		/*====================METHOD SETTER=======================*/

		/*
		*set ID
		*/
		public function setID($category_id)
		{
			$this->id = $category_id;
		}

		/*====================METHOD ACTION(setter & getter)=======================*/
		
		/*
		*set nama kategori by ID untuk lihat product
		*/
		public function setNama()
		{
			$query = "SELECT nama FROM ".$this->getTable()." WHERE id = ? limit 0,1";
			$stmt  = $this->conn->prepare($query);

			$stmt->bindParam(1, $this->getID());
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$this->nama = $row['nama'];
		}

		/*
		*ambil id dan nama dari database untuk tambah dan edit
		*/
		public function getCategory()
		{
			$query = "SELECT id, nama FROM ".$this->getTable()." ORDER BY nama";
			$stmt  = $this->conn->prepare($query);
			$stmt->execute();

			return $stmt;
		}

		/*
		*tutup koneksi
		*/
		public function __destruct()
		{
			$this->conn = null;
		}
	}
?>