<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=c800206ebd27d3b6b6e7b19c646c4928';
    $json_data = file_get_contents($api_url);
    //print_r($json_data);
    $films_data = json_decode($json_data);
    //print_r($films_data);
    $films_data = $films_data->results;
    //print_r($films_data);
    foreach ($films_data as $film) {
        echo "name: ".$film->title;
        echo "<br />";
        echo "description: ".$film->overview;
        echo "<br /> <br />";
    }


    
    
    ?>
</body>
</html>