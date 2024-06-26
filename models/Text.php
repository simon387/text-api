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
		$limit = 1;
		if ($all == 'yes') { // if query string 'all' == 'yes', get all values
			$limit = 1024;
		}
		$query = "SELECT * FROM text ORDER BY id desc LIMIT :limit";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
		$stmt->execute();
		if ($all == 'yes') {
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
			return $stmt->fetch(PDO::FETCH_ASSOC); // ritorna json a singolo elemento senza array
		}
		return [];
	}
}
