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

	public function getLast($all): array
	{
		if ($all == 'yes') { // if query string 'all' == 'yes', get all values
			$query = "SELECT * FROM text ORDER BY id desc";
		} else {
			$query = "SELECT * FROM text ORDER BY id desc LIMIT 1;";
		}
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($all) {
			$num = $stmt->rowCount();
			if ($num > 0) {
				$text_arr = array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					extract($row);
					$text_item = array(
						"id" => intval($id),
						"text" => $text,
						"created" => $created,
					);
					$text_arr[] = $text_item;
				}
				return $text_arr;
			}
		} else {
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return [];
	}
}
