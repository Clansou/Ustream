<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
    <title>Document</title>
    @vite('public/app.css')
</head>
<body>
<header>
  <?php require(app_path("require_resources\search.php")) ;?>
</header>
<?php if(isset($_GET['Search'])){
display_search();
}
?>
  <h3 class="filmTitle font-bold">{$id_film->title}</h3>            
  <?php


      $api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=FRS';
      $json_data = file_get_contents($api_url);
      $film = json_decode($json_data);
      $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
      $filmNoImg = "/img/noimg.jpg";
      $posterExists = $film->poster_path;
      $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
  ?>
  <img src="<?= $filmImg ?>" alt="Film Poster">


<script>
    console.log({{$id_film}});
    console.log("https://api.themoviedb.org/3/movie/{{$id_film}}?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=FRS");
    axios.get("https://api.themoviedb.org/3/movie/{{$id_film}}?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=FRS").then(function (film_data) {
    // handle success
    console.log(film_data.data);
  })

</script>
</body>
</html>