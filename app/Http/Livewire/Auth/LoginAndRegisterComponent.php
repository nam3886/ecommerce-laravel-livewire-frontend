<?php

namespace App\Http\Livewire\Auth;

use App\Http\Livewire\Options\WithNotifyMsgUi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class LoginAndRegisterComponent extends Component
{
    use WithNotifyMsgUi;

    public int  $mode               =   1;
    public      $user               =   [];

    protected $loginRules           =   [
        'user.login.email'          =>  'required|email|exists:App\Models\User,email',
        'user.login.password'       =>  'required|max:255',
        'user.login.remember_me'    => 'nullable|boolean',
    ];
    protected $forgotRules           =   [
        'user.forgot.email'          =>  'required|email|exists:App\Models\User,email',
    ];
    protected   $resetRules  =   [
        'user.reset.token'         =>  'required',
        'user.reset.email'         =>  'required|email|exists:App\Models\User,email',
        'user.reset.password'      =>  'required|confirmed|min:8|max:255',
    ];
    protected $registerRules        =   [
        'user.register.email'       =>  'required|email|unique:App\Models\User,email',
        'user.register.password'    =>  'required|min:8|max:255|confirmed',
        'user.register.agree_PP'    =>  'required|accepted',
        'user.register.subscribe'   =>  'nullable|boolean',
    ];

    public function mount(string $token = ''): void
    {
        $this->user['login']['remember_me'] = false;
        $this->user['register']['agree_PP'] = false;

        if (!empty($token)) {
            $this->user['reset']['token'] = $token;
            $this->user['reset']['email'] = request()->email;
            $this->mode = 3;
        }
    }

    public function render()
    {
        return view('livewire.auth.login-and-register-component');
    }

    protected function updatedMode(bool $value): void
    {
        // not login mode and exist user.login.email
        if ($value !== 1 && isset($this->user['login']['email'])) {
            $this->user['forgot']['email'] = $this->user['login']['email'];
        }
    }

    public function login()
    {
        $this->validate($this->loginRules);

        $credentials    =   collect($this->user['login'])->only('email', 'password')->toArray();
        $credentials    +=  ['active' => 1];
        $remember       =   $this->user['login']['remember_me'] ?? false;

        if (Auth::attempt($credentials, $remember)) {
            // session()->put('user.actions.locale', auth()->user()->country);
            // session()->put('user.actions.currency', auth()->user()->currency);
            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'user.login.email' => __('auth.failed'),
        ]);
    }

    public function sendMailResetLink()
    {
        $this->validate($this->forgotRules);

        $status = Password::sendResetLink(
            ['email' => $this->user['forgot']['email']]
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->flashMessage(__($status), 'error');
        } else {
            $this->flashMessage(__($status));
        }
    }

    public function resetPassword()
    {
        $this->validate($this->resetRules);

        $status = Password::reset($this->user['reset'], function ($user) {
            $user->forceFill([
                // no need hash because already set attribute in model
                'password'  => $this->user['reset']['password'],
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });

        if ($status != Password::PASSWORD_RESET) {
            $this->flashMessage(__($status), 'error');
        } else {
            $this->flashMessage(__($status));
            $this->mode = 1;
            $this->user['login']['email'] = $this->user['reset']['email'];
        }
    }

    public function register()
    {
        $this->validate($this->registerRules);

        $user = new User;
        $user->name = $this->user['register']['email'];
        $user->fill($this->user['register']);
        $user->save();
        // role first is customer
        $user->roles()->attach(Role::first());

        Auth::login($user);
        event(new Registered($user));
        return redirect()->route('home');
    }
}
