<!doctype html>
	
<html lang="en">

<head>

	<meta charset="UTF-8">

	<title>My First App</title>

	<link rel="stylesheet" href="/css/all.css" >

</head>

<body class="container">

	@include('flash::message')

	@yield('content')

	<script src="/js/all.js"></script>

	<script>

		$('#flash-overlay-modal').modal();

		//$('div.alert').not('alert-important').delay(3000).slideUp(300);

	</script>

	@yield('footer')

</body>

</html>