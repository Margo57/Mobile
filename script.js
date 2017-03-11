$(function() {


$('#formReg').slideUp();

$('#btnOpenReg').on({
	click: function(event) {
		$('#formReg').slideDown();
	}
});

$('#formAuth').on(
	"submit", function(event) {
		event.preventDefault();
		$data = $(this).serialize();

		//скрипт Php для входа
		$.ajax({
			type: "POST",
			url: "actions/auth.php",
			data: $data,
			success: function (response) {
				var res = JSON.parse(response);
				for(key in res) {
					if (key == "error") {
						$(".authRes").text(res[key]);
					}
					else {
						$(".authRes").text("Вы успешно вошли");
						$.mobile.changePage("admin.html", "slide");
					}
				}
			},
			error: function (response) {

			}
		});
	}
);

$('#formReg').on(
	"submit", function(event) {
		event.preventDefault();
		$data = $(this).serialize();

		//скрипт php для регистрации
		$.ajax({
			type: "POST",
			url: "actions/reg.php",
			data: $data,
			success: function (response) {
				var res = JSON.parse(response);
				for(key in res) {
					console.log(key);
					if (key == "error") {
						$(".regRes").text(res[key]);
					}
					else if (key == "success") {
						$(".regRes").text(res[key]);
					}
				}
			},
			error: function (response) {

			}
		});
	}
);




});