<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Database via Eloquent ORM
        $rules = [
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'confirmed'
            ]
        ];

        $customMessages = [
            'required' => ':attribute harus di isi gan',
            'min' => 'password kurang dari 8 karakter gan',
            'max' => 'password kelebihan gan',
            'regex' => 'password harus ada huruf besar, dan angka minimal 1 gan',
            'unique' => 'email sudah terdaftar gan',
            'confirmed' => 'password ga sama nih gan'
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        if ($user) {
            return back()->with('success', 'Akun nya berhasil dibuat gan');
        } else {
            return back()->with('fail', 'Akun gagal dibuat gan, coba di cek lagi!');
        }
    }
}
