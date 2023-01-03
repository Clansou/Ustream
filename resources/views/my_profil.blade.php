<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1><?php echo Auth::user()->id?></h1>
    <h2><?php echo Auth::user()->name?></h2>
    <h3><?php echo Auth::user()->email?></h3>
    
</body>
</html>