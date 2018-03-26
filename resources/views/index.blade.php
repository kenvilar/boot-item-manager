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

    <div class="container">
        <h1>Add Item</h1>
        <form action="" id="itemForm">
            <div class="form-group">
                <label for="text">Text</label>
                <input type="text" id="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn btn-outline-primary">
        </form>
        <ul id="items" class="list-group"></ul>
    </div>

    <script
            src="//code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

    <script>
		$(document).ready(function () {
			getItems();

			$('#itemForm').on('submit', function (e) {
                e.preventDefault();

                let text = $('#text').val();
                let body = $('#body').val();

                addItem(text, body);
			});

			$('body').on('click', '#delete-item', deleteItem);

			//Functions Here
            function deleteItem(e) {
                e.preventDefault();
                id = $(this).data('id');

                deleteItemAjax(id);
            }

            function deleteItemAjax(id) {
                $.ajax({
                    url: '/api/items/' + id,
                    method: 'POST',
                    data: { _method: 'DELETE' }
                }).done(function (response) {
                    alert('Item Number ' + response.id + ' Deleted Successfully!');
                    location.reload();
                });
            }
            
            function addItem(text, body) {
                $.ajax({
                    url: '/api/items',
                    method: 'POST',
                    data: {
                    	text: text,
                        body: body
                    }
                }).done(function (response) {
                    alert('Item Number ' + response.id + ' Added Successfully!');
                    location.reload();
                });
            }

			function getItems() {
				$.ajax({
					url: '/api/items'
				}).done(function (response) {
					let output = '';
					$.each(response, function(key, val) {
						output += `
                            <li class="list-group-item">
                                <strong>${val.text}: </strong> ${val.body} <a href="#" id="delete-item"
                                class="btn btn-danger float-right" data-id="${val.id}">Delete</a>
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
