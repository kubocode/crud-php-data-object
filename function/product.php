<?php
	/*
	*class Product
	*manajemen function-function create read update delete
	*/
	class Product
	{
		private $conn;
		private $table_name = "products";

		private $id;
		private $nama;
		private $harga;
		private $keterangan;
		private $category_id;
		private $timestamp;

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
		*ambil ID
		*/
		public function getID()
		{
			return $this->id;
		}

		/*
		*ambil nama
		*/
		public function getNama()
		{
			return $this->nama;
		}

		/*
		*ambil harga
		*/
		public function getHarga()
		{
			return $this->harga;
		}

		/*
		*ambil keterangan
		*/
		public function getKeterangan()
		{
			return $this->keterangan;
		}

		/*
		*ambil category_id
		*/
		public function getCategoryID()
		{
			return $this->category_id;
		}

		/*
		*ambil timestamp
		*/
		public function getTimestamp()
		{
			return $this->timestamp;
		}

		/*====================METHOD SETTER=======================*/
		
		/*
		*set nilai ID
		*/
		public function setID($id)
		{
			$this->id = $id;
		}

		/*
		*set nilai nama
		*/
		public function setNama($nama)
		{
			$this->nama = $nama;
		}

		/*
		*set nilai harga
		*/
		public function setHarga($harga)
		{
			$this->harga = $harga;
		}

		/*
		*set nilai keterangan
		*/
		public function setKeterangan($keterangan)
		{
			$this->keterangan = $keterangan;
		}

		/*
		*set nilai category_id
		*/
		public function setCategoryID($category_id)
		{
			$this->category_id = $category_id;
		}

		/*
		*set nilai waktu timestamp
		*/
		public function setTimestamp()
		{
			date_default_timezone_set('Asia/Jakarta');
			$this->timestamp = date('Y-m-d H:i:s');
		}

		/*====================METHOD ACTION(setter & getter)=======================*/
		
		/*
		*ambil seluruh data di database dengan LIMIT yang sudah ditentukan
		*/
		public function getAllData($jumlah_record, $data_per_page)
		{
			$query = "SELECT id, nama, keterangan, harga, category_id FROM ".$this->getTable()." ORDER BY nama ASC LIMIT {$jumlah_record}, {$data_per_page}";

			$stmt = $this->conn->prepare($query);
			$stmt->execute();

			return $stmt;
		}

		/*
		*hitung seluruh data di database
		*/
		public function getTotalData()
		{
			$query = "SELECT id FROM ".$this->table_name."";
			$stmt  = $this->conn->prepare($query);
			$stmt->execute();
			$num = $stmt->rowCount();

			return $num;
		}

		/*
		*set details product data berdasarkan id dari method GET 
		*/
		public function setDetailsProduct()
		{
			$query = "SELECT nama, harga, keterangan, category_id FROM ".$this->getTable()." WHERE id = ? LIMIT 0,1";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->getID());
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->setNama($row['nama']);
			$this->setHarga($row['harga']);
			$this->setKeterangan($row['keterangan']);
			$this->setCategoryID($row['category_id']);
		}

		/*
		*function untuk menambah product baru
		*/
		public function simpanProduct()
		{
			/*
			*set waktu timestamp
			*/
			$this->setTimestamp();
			
			$query = "INSERT INTO ".$this->getTable()." SET nama = ?, harga = ?, keterangan = ?, category_id = ?, dibuat = ?";

			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->getNama());
			$stmt->bindParam(2, $this->getHarga());
			$stmt->bindParam(3, $this->getKeterangan());
			$stmt->bindParam(4, $this->getCategoryID());
			$stmt->bindParam(5, $this->getTimestamp());

			if($stmt->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

		/*
		*function untuk mengupdate product
		*/
		public function updateProduct()
		{
			/*
			*set waktu timestamp
			*/
			$this->setTimestamp();

			$query = "UPDATE ".$this->getTable()." SET nama=:nama, harga=:harga, keterangan=:keterangan, category_id=:category_id, dimodifikasi=:dimodifikasi WHERE id = :id"; 

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':nama', $this->getNama());
			$stmt->bindParam(':harga', $this->getHarga());
			$stmt->bindParam(':keterangan', $this->getKeterangan());
			$stmt->bindParam(':category_id', $this->getCategoryID());
			$stmt->bindParam(':dimodifikasi', $this->getTimestamp());
			$stmt->bindParam(':id', $this->getID());

			if($stmt->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

		/*
		*function untuk menghapus product
		*/
		public function hapusProduct()
		{
			$query = "DELETE FROM ".$this->getTable()." WHERE id = ?";
			$stmt  = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->getID());

			if($result = $stmt->execute())
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}

		/*
		*function untuk mencari data product di database dengan LIMIT yang sudah ditentukan
		*/
		public function searchProduct($search_term, $jumlah_record, $data_per_page)
		{
			$query = "SELECT c.nama as nama_category, p.id, p.nama, p.keterangan, p.harga, p.category_id, p.dibuat FROM ".$this->getTable()." p LEFT JOIN categories c ON p.category_id = c.id WHERE p.nama LIKE ? OR p.keterangan LIKE ? ORDER BY p.nama ASC LIMIT ?, ?";

			$stmt = $this->conn->prepare($query);

			$search_term = "%{$search_term}%";
			$stmt->bindParam(1, $search_term);
			$stmt->bindParam(2, $search_term);
			$stmt->bindParam(3, $jumlah_record, PDO::PARAM_INT);
			$stmt->bindParam(4, $data_per_page, PDO::PARAM_INT);

			$stmt->execute();
			
			return $stmt;
		} 

		/*
		*hitung seluruh data product yang dicari
		*/
		public function getTotalDataBySearch($search_term)
		{
			$query = "SELECT COUNT(*) as total_baris FROM ".$this->getTable()." p LEFT JOIN categories c ON p.category_id = c.id WHERE p.nama LIKE ?";

			$stmt = $this->conn->prepare($query);
		
			$search_term = "%{$search_term}%";
			$stmt->bindParam(1, $search_term);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row['total_baris'];
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