<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.png">
    <title>Registration - Ustream</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>
<body>
<main class="flex items-center h-[100vh] justify-evenly flex-col md:flex-row">
    <img class="w-[40vw]" src="/img/logo.png" alt="Logo">
    <div class="container signup-form md:w-[20vw] w-[80vw]">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="flex flex-col items-center bg-yellow rounded-2xl p-8 text-grey">
                    <h3 class="card-header text-center text-4xl mb-5 font-bold">Registration</h3>
                    <div class="card-body text-xl">
                        <form class="flex flex-col gap-3" action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3 flex items-center">
                                <input type="password" placeholder="Password" id="password" class="form-control"
                                    name="password" required>
                                <img class="w-[35px]" src="img/eyeferme.png" alt="afficher mot de passe" id="voirPass">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> Remember Me</label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block font-semibold bg-white border-2 border-grey rounded-full px-8 py-2 hover:bg-grey hover:text-yellow">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<script type="text/javascript" src="/main.js"></script>
</html>
