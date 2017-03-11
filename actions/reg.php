<?php

header("Content-type: text/html; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (!empty($_POST["login"]) || 
		!empty($_POST["pass"]) || 
		!empty($_["email"]) || 
		!empty($_POST["name"])) {

			$login = $_POST["login"];
			$pass = $_POST["pass"];
			$email = $_POST["email"];
			$name = $_POST["name"];

			$db = mysqli_connect("localhost", "root", "111208", "jquerymobile") or die("не работает");

			mysqli_query($db, "SET NAMES UTF8") or die("не установил кодировку");

			$status = [];

			//проверка на существование такого же логина
			$doubleLogin = "SELECT login, email FROM users WHERE login = '$login' and email = '$email'";

			$resultDoubleLogin = mysqli_query($db, $doubleLogin);

			if (!mysqli_num_rows($resultDoubleLogin)) {
				$query = "INSERT INTO users(name, login, pass, email)
							VALUES ('$name', '$login', '$pass', '$email')";

				$result = mysqli_query($db, $query);

				if (!$result) {
					mysqli_error($db);
					$status = [
						"error" => "ошибка при добавлении пользователя"
					];
					echo json_encode($status);
				}
				else {
					$status = [
						"success" => "Вы успешно зарегистрировались"
					];
					echo json_encode($status);
				}
			}
			else {
				$status = [
					"error" => "Пользователь с таким логином уже существует"
				];
				echo json_encode($status);
			}

		}
		else {
			$error = [
				"error" => "Не ввели какие то данные"
			];
			echo json_encode($status);
		}

}