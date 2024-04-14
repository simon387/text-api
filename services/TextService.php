<?php

include('../config/Database.php');
include('../models/Text.php');

class TextService
{
	private Database $database;
	private ?PDO $connection;
	private Text $text;

	public function __construct()
	{
		$this->database = new Database();
		$this->connection = $this->database->getConnection();
		$this->text = new Text($this->connection);
	}

	public function __destruct()
	{
		if ($this->connection) {
			$this->connection = null;
		}
	}

	public function getLast(): ?array
	{
		return $this->text->getLast();
	}

	public function create($data): bool
	{
		if (empty($data->text)) {
			return false;
		}

		return $this->text->create($data->text);
	}
}
