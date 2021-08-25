<div class="col-lg-6 col-md-6">
  <div wire:ignore.self class="account_form" data-aos="fade-up" data-aos-delay="0">
    <h3>login</h3>
    <form wire:submit.prevent='login' wire:key='login-form'>

      <x-inputs.group model='user.login.email' for='userEmail'>
        <x-slot name='label'>
          Email address <span class='required'>*</span>
        </x-slot>
        <x-inputs.required.text wire:model.defer='user.login.email' id='userEmail' type="email" />
      </x-inputs.group>

      <x-inputs.group model='user.login.password' for='userPassword'>
        <x-slot name='label'>
          Password <span class='required'>*</span>
        </x-slot>
        <x-inputs.required.text wire:model.defer='user.login.password' id='userPassword' type="password" />
      </x-inputs.group>

      <div class="login_submit">
        <x-inputs.button-spinner type="submit" target='login' class="btn btn-md btn-black-default-hover mb-4">
          login
        </x-inputs.button-spinner>

        <div class='checkbox-default mb-4'>
          <input wire:model.defer='user.login.remember_me' type="checkbox" id="offer">
          <label for="offer">Remember me</label>
        </div>

        <a class='information' href="#" wire:loading.class='not-allowed' wire:click.prevent="$set('mode', 2)">
          Lost your password ?</a>
      </div>

      <div class="mt-4 text-center login-social">
        <h5 class="mb-3">Sign in with</h5>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="{{ url('/auth/login/facebook') }}" class="social-list-item facebook not-allowed">
              <i title="Login with Facebook" class="fa fa-facebook fa-fw"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="{{ url('/auth/login/twitter') }}" class="social-list-item twitter not-allowed">
              <i title="Login with Twitter" class="fa fa-twitter fa-fw"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="{{ url('/auth/login/google') }}" class="social-list-item google">
              <i title="Login with Google" class="fa fa-google fa-fw"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="{{ url('/auth/login/github') }}" class="social-list-item github not-allowed">
              <i title="Login with Github" class="fa fa-github fa-fw"></i>
            </a>
          </li>
        </ul>
      </div>
    </form>
  </div>
</div>
