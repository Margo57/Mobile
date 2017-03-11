<?php

//для входа

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (!empty($_POST["login"]) || !empty($_POST["pass"])) {
		$login = $_POST["login"];
		$pass = $_POST["pass"];

		$db = mysqli_connect("localhost", "root", "111208", "jquerymobile") or die("не работает");

		mysqli_query($db, "SET NAMES UTF8") or die("не установил кодировку");

		$error = [];

		$query = "SELECT id, login, pass, name FROM users WHERE login = '$login' and pass = '$pass'";

		$result = mysqli_query($db, $query);

		if (!$result) {
			mysqli_error($db);
			$error = [
				"error" => "ошибка"
			];
			echo json_encode($error);
		}
		else {
			if(mysqli_num_rows($result)) {
				$data = mysqli_fetch_assoc($result);
				echo json_encode($data);
			}
			else {
				$error = [
					"error" => "нет такого пользователя"
				];
				echo json_encode($error);
			}
		}

		}

}