<html>
<head></head>
<body>
	<h3>Hello {{$user->name}}</h3>
	<p>Here is your scheduled CSV imports report:</p>
	<p>{{$result['total']}} products were imported of which </p>
	<p>{{$result['success']}} were successfully registered and {{$result['failures']}} failed </p>
</body>
</html>