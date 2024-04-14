<?php

class Text
{
	private mixed $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}


	public function create($text)
	{
		$query = "INSERT INTO text (text) VALUE (:text)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":text", $text);

		return $stmt->execute();
	}

	public function getLast()
	{
		$query = "SELECT * FROM text ORDER BY id desc LIMIT 1;";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}