<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Job</title>
</head>

<body>
    <h1>Create new job</h1>
    <form action="/jobs" method="POST">
        @csrf
    <input type="text" name="title" placeholder="title">
    <input type="text" name="description" placeholder="description">
    <button type="submit">Submit</button>
</form>
</body>

</html>