<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Roles\Role;
use App\Models\Roles\RoleUser;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'            => 'required',
            'email'           => 'required|email|unique:users,email',
            'password'        => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->uncompromised()
            ],
            'confirmPassword' => 'required|same:password'
        ], [
            'password.required'        => 'O campo senha é obrigatório.',
            'password.uncompromised'   => 'A nova senha fornecida apareceu em um vazamento de dados por https://haveibeenpwned.com, escolha uma nova senha diferente. ',
            'confirmPassword.required' => 'O campo confirmar senha é obrigatório.',
            'confirmPassword.same'     => 'O campo senha e o confirmar senha estão diferentes.',
        ]);

        $user = User::create([
            'name'                 => $request->input('name'),
            'slug'                 => Str::slug($request->input('name')),
            'email'                => $request->input('email'),
            'password'             => bcrypt($request->input('password')),
            'is_active'            => 1,
            'is_office_login_only' => 0
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id.'.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        $role = Role::where('label', 'admin')->first();

        RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);

        add_user_log([
            'title'        => "registered ".$user->name,
            'reference_id' => $user->id,
            'section'      => 'Auth',
            'type'         => 'Register'
        ]);

        Auth::loginUsingId($user->id);

        return redirect('admin');
    }
}
