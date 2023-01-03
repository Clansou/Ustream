<?php   $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<form method="get" action="">
<?php

if(isset($_GET['Search'])){
  $_SESSION['Search'] = $_GET['Search'];
}




if(isset($_SESSION['Search'])){
  echo '<input id="search-bar" value="'.$_SESSION['Search'].'" class="mt-[10vh] p-6 h-[10vh] w-[50vw] rounded-full border-2 border-black shadow-xl italic font-semibold" type="text" name="Search" placeholder="Search movie...">';
}else{
echo '<input id="search-bar" class="mt-[10vh] p-6 h-[10vh] w-[50vw] rounded-full border-2 border-black shadow-xl italic font-semibold" type="text" name="Search" placeholder="Search movie...">';
}
?>
</form>
<?php


function display_search(){
  $_SESSION['Search'] = str_replace(" ", "+",$_SESSION['Search']);
  $search_api_url = 'https://api.themoviedb.org/3/search/movie?api_key=c800206ebd27d3b6b6e7b19c646c4928&query='.$_SESSION["Search"];
  $search_json_data = file_get_contents($search_api_url);
  //print_r($json_data);
  $search_films_data = json_decode($search_json_data);
  if($search_films_data->total_results == 0){
    ?><h2>Aucun film trouvé</h2><?php
  }
  else{
  ?>
  <h2 class="text-2xl font-bold mx-[4%] mt-[3%]">Top research</h2>
  <div class="grid grid-cols-4 justify-items-center">
      <?php foreach($search_films_data->results as $film){?>
          <div class="filmCard m-4 text-lg shadow-2xl flex flex-col w-[58%]">
              <a href="http://ustream.test/film/<?php echo $film->id ?>">
              <h3 class="filmTitle font-bold"><?php echo $film->title ?></h3>
              <?php
                $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
                $filmNoImg = "/img/noimg.jpg";
                $posterExists = $film->poster_path;
                $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
              ?>
              <img src="<?= $filmImg ?>" alt="Film Poster">
              </a>
          </div>
      <?php } ?>
  </div>
<?php     
}
}
?>