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
        <div class="flex items-center justify-around">
            <a class="w-[20%]" href="http://ustream.test/films/1">
                <img src="/img/logo.png" alt="Logo">
            </a>
            <div class="flex flex-row justify-end gap-8">
                <a class="w-[5%]" href="http://ustream.test/my_profil">
                    <img class="m-2" src="/img/profil.png" alt="Profil">
                </a>
                <?php if(Auth::check()){ ?>
                <a class="w-[5%]" href="http://ustream.test/signout">
                    <img class="m-2" src="/img/logout.png" alt="Logout">
                </a>
                <?php } ?>
            </div>
        </div>
        <div class="flex items-center mt-[3%] gap-[5%]">
            <?php require(app_path("require_resources\search.php")) ;?>
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
    </header>
    <?php if(isset($_GET['Search'])){
        display_search();
    }?>

    <<div class="flex justify-around text-3xl font-bold my-8 text-center">
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/my_profil">My profil</a>
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/MyInvitations">My invitation</a>
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/allprofils">All profils</a>
    </div>
    
    <h1>My invitations</h1>
    <?php
    $Invitations = DB::table('invitation')->where('user_id_invited', '=', Auth::user()->id)
    ->get()->all(); ?>
    @foreach($Invitations as $invitation)
        <?php $user_inviter_info = DB::table('users')->join('invitation', 'users.id', '=' , 'invitation.user_id_invited')->where('user_id_invited', '=', Auth::user()->id)
    ->first();
    ?>
    <?php $album_info = DB::table('albums')->where('id', '=', $invitation->albums_id)
    ->first();
    
    
    ?>
    <p>Invited by <?php echo($user_inviter_info->name); ?> on album <?php echo ($album_info->name)?> </p>
    <form class="flex flex-col gap-3" method="post" action="{{ route('Share_Album') }}">
                @csrf
                <input id="id_album" name="id_album" type="hidden" value="<?php echo $album_info->id ?>">
                <input id="id_user" name="id_user" type="hidden" value="<?php echo Auth::user()->id ?>">
                <input id="id" name="id" type="hidden" value="<?php echo $invitation->id ?>">
            <button type="submit">Accept</button>
    </form>

    @endforeach
    
</body>
</html>