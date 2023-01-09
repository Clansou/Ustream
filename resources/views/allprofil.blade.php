<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.png">
    <title>My Profil - Ustream</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>

<body>
    <header class="flex flex-col items-center px-4 py-[10vh] bg-white shadow-2xl">
    <div class="flex items-center justify-between w-full">
        <a class="sm:w-[350px] w-[300px] ml-8" href="http://ustream.test/films/1">
            <img src="/img/logo.png" alt="Logo">
        </a>
        <div class="flex flex-row justify-end gap-4 mr-8">
            <a class="w-[50px]" href="http://ustream.test/my_profil">
                <img class="m-2" src="/img/profil.png" alt="Profil">
            </a>
            <?php if(Auth::check()){ ?>
            <a class="w-[50px]" href="http://ustream.test/signout">
                <img class="m-2" src="/img/logout.png" alt="Logout">
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="flex flex-col items-center mt-[3%] gap-8 md:flex-row">
        <?php require(app_path("require_resources\search.php")) ;?>
        <div class="flex gap-8">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn bg-yellow font-semibold">Genre</button>
                <div id="myDropdown" class="dropdown-content">
                    <div class="dropdown-content-genre grid grid-cols-4 w-[100%]">
                        <?php
                        $each_genres = 'https://api.themoviedb.org/3/genre/movie/list?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
                        $each_genres = file_get_contents($each_genres);
                        $each_genres = json_decode($each_genres);
                        $each_genres= $each_genres->genres;
                        foreach ($each_genres as $each_genre) {

                            ?><a href="http://ustream.test/films/<?php print_r(strtolower($each_genre->name))?>/1"><?php print_r($each_genre->name)?></a>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
    <?php if(isset($_GET['Search'])){
        display_search();
    }?>

    <div class="flex justify-around text-3xl font-bold my-8 text-center">
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/my_profil">My profil</a>
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/MyInvitations">My invitation</a>
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/allprofils">All profils</a>
    </div>
<body>
    <h1 class="text-6xl text-yellow font-bold text-center my-4">All users</h1>
    <?php
    $users= DB::table('users')
    ->get()->all(); ?>

    <div class="allProfilGrid">
        <?php foreach($users as $user){?>
        <div class="bg-yellow border-grey rounded-full p-16 m-4">
            <a class="flex gap-8 items-center" href="/profil<?php echo $user->id ?>">
                <img class="w-[10%] bg-white p-8 rounded-full" src="public/img/profil.png">
                <div>
                    <h2 class="font-bold text-2xl"><?php echo $user->name;?></h2>
                    <h3 class="text-xl"><?php echo $user->email;?></h3>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>

    <footer class="bg-grey text-yellow flex flex-col md:flex-row items-center gap-[10%] p-[5%]">
        <img class="w-[200px]" src="/img/logowhite.png" alt="Logo">
        <div class="md:w-[50vw] w-[80vw]">
            <h2 class="text-2xl font-semibold my-2">Genres</h2>
            <div class="mx-2 grid grid-cols-4 w-[100%] gap-[5%]">
                <?php
                $each_genres = 'https://api.themoviedb.org/3/genre/movie/list?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
                $each_genres = file_get_contents($each_genres);
                $each_genres = json_decode($each_genres);
                $each_genres= $each_genres->genres;
                foreach ($each_genres as $each_genre) {

                    ?><a href="http://ustream.test/films/<?php print_r(strtolower($each_genre->name))?>/1"><?php print_r($each_genre->name)?></a>
                <?php }
                ?>
            </div>
        </div>
    </footer>
</body>
</html>
