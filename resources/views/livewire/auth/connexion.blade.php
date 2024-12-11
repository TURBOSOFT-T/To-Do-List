<div>
   {{--  <form class="h-add-bottom" method="POST" action="{{ route('login') }}"> --}}

    @if (session()->has('error'))
    <div class="alert alert-danger p-3 small">
        {{ session('error') }}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success p-3 small">
        {{ session('success') }}
    </div>
@endif
    <form class="h-add-bottom" wire:submit='connexion' class="auth-form" action="#">
        @csrf

        <!-- Email Address -->
        <div class="field">
            {{--
            <x-auth.input-email /> --}}
            <label>E_mail</label>
            <input id="email" type="email" name="email"  wire:model="email"
                 required>
        </div>
        <div class="field">
            <!-- Password -->
            {{-- <x-auth.input-password /> --}}
            <label>Mot de passes</label>
            <input id="password" {{-- class="h-full-width" --}}
            wire:model="password" 
            type="password" name="password" required>
        </div>



        <!-- Remember Me -->
       <div class="content">
            <div class="checkbox">

                <input id="remember_me" type="checkbox"  checked="" name="remember_me">
                <label for="remember_me">Souvenir de moi</label>
            </div>
            <div class="pass-link">
                <a href="#">Mot de passe perdu?</a>
            </div>
        </div>
       {{--    <div class="field">
        <x-auth.submit title="connexion" />
          </div> --}}
          <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button"> Connexion

           {{--  <span wire:loading>
                <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
            </span> --}}
        </button>

       <div class="signup-link">
        Pas de compte?
        <a href="{{ route('register') }}">Inscrivez vous ici!</a>
    </div>

    </form>
</div>


