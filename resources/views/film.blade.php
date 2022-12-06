<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



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