<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ItemAPI</title>
    <link rel="stylesheet" href="//bootswatch.com/4/simplex/bootstrap.min.css">
</head>
<body>
<div class="flex-center position-ref full-height">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">ItemAPI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="content">
        <ul id="items" class="list-group"></ul>
    </div>

    <script
            src="//code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

    <script>
		$(document).ready(function () {
			getItems();

			function getItems() {
				$.ajax({
					url: '/api/items'
				}).done(function (response) {
					let output = '';
					$.each(response, function(key, val) {
						output += `
                            <li class="list-group-item">
                                <strong>${val.text}: </strong> ${val.body}
                            </li>
                        `;
					});

					$('#items').append(output);
				});
			}
		});
    </script>
</div>
</body>
</html>
