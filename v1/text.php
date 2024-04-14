<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, Origin, X-Auth-Token");

include_once '../services/TextService.php';

$bestemmieService = new TextService();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		$bestemmie_arr = $bestemmieService->getLast();
		echo json_encode($bestemmie_arr);
		break;
	case 'POST':
		$data = json_decode(file_get_contents("php://input"));
		if ($bestemmieService->create($data)) {
			http_response_code(201);
			echo json_encode(array("response" => "Text created"));
		} else {
			http_response_code(500);
			echo json_encode(array("response" => "Impossible to create the Text"));
		}
		break;
	case 'OPTIONS':
		http_response_code(200);
		die();
	default:
		http_response_code(405);
		echo json_encode(array("response" => "Method not supported"));
		die();
}
