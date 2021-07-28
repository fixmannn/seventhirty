<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\OrdersController;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Register new account via checkout
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
            ],
            'nama_depan' => 'string',
            'nama_belakang' => 'string',
            'alamat' => 'string',
            'kecamatan' => 'string',
            'kota' => 'string',
            'provinsi' => 'string',
            'nomor_handphone' => 'integer'
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
            'nama_depan' => $request->first_name,
            'nama_belakang' => $request->last_name,
            'alamat' => $request->address,
            'kecamatan' => $request->district,
            'kota' => $request->city_destination,
            'provinsi' => $request->province_destination,
            'nomor_handphone' => $request->phonenumber
        ]);

        $xenditcontroller = new XenditController();
        $ordercontroller = new OrdersController();



        if ($user) {

            session()->put('guest', $user);

            $ordercontroller->create();

            if ($request->payment == 'MANDIRI' || $request->payment == 'BRI' || $request->payment == 'PERMATA' || $request->payment == 'BNI') {
                $xenditcontroller->createVa($request);
            } elseif ($request->payment == 'ID_OVO' || $request->payment == 'ID_DANA' || $request->payment == 'ID_SHOPEEPAY' || $request->payment == 'ID_LINKAJA') {
                $xenditcontroller->createEWallets($request);
            }

            // Sending Email
            $ordermail = new MailController();
            $ordermail->paymentMail();

            return view('checkout.payment');
        } else {
            return back()->with('fail', 'Akun gagal dibuat gan, coba di cek lagi!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $provinces = Province::all();
        return view('checkout.index', [
            'user' => $user,
            'provinces' => $provinces
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        if (session('LoggedUser')) {
            $update = User::where('id', session('LoggedUser'))
                ->update([
                    'nama_depan' => $request->first_name,
                    'nama_belakang' => $request->last_name,
                    'alamat' => $request->address,
                    'kecamatan' => $request->district,
                    'kota' => $request->city_destination,
                    'provinsi' => $request->province_destination,
                    'nomor_handphone' => $request->phonenumber
                ]);
            }

        return back()->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Order $id)
    {
        $xenditcontroller = new XenditController();
        $ordercontroller = new OrdersController();

        if (session('LoggedUser')) {
            $update = User::where('id', session('LoggedUser'))
                ->update([
                    'nama_depan' => $request->first_name,
                    'nama_belakang' => $request->last_name,
                    'alamat' => $request->address,
                    'kecamatan' => $request->district,
                    'kota' => $request->city_destination,
                    'provinsi' => $request->province_destination,
                    'nomor_handphone' => $request->phonenumber
                ]);

            $ordercontroller->create();


            if ($request->payment == 'MANDIRI' || $request->payment == 'BRI' || $request->payment == 'PERMATA' || $request->payment == 'BNI') {
                $xenditcontroller->createVa($request);
            } elseif ($request->payment == 'ID_OVO' || $request->payment == 'ID_DANA' || $request->payment == 'ID_SHOPEEPAY' || $request->payment == 'ID_LINKAJA') {
                $xenditcontroller->createEWallets($request);
            } else {
                $xenditcontroller->createQR($request);
            }

            // Sending Email
            $ordermail = new MailController();
            $ordermail->paymentMail();
        } else {

            $update = [
                'email' => $request->email,
                'nama_depan' => $request->first_name,
                'nama_belakang' => $request->last_name,
                'alamat' => $request->address,
                'kecamatan' => $request->district,
                'kota' => $request->city_destination,
                'provinsi' => $request->province_destination,
                'nomor_handphone' => $request->phonenumber
            ];

            session()->put('guest', $update);

            $ordercontroller->create();

            if ($request->payment == 'MANDIRI' || $request->payment == 'BRI' || $request->payment == 'PERMATA' || $request->payment == 'BNI') {
                $xenditcontroller->createVa($request);
            } elseif ($request->payment == 'ID_OVO' || $request->payment == 'ID_DANA' || $request->payment == 'ID_SHOPEEPAY' || $request->payment == 'ID_LINKAJA') {
                $xenditcontroller->createEWallets($request);
            } else {
                $xenditcontroller->createQR($request);
            }

            // Sending Email
            $ordermail = new MailController();
            $ordermail->paymentMail();
        }

        return view('checkout.payment');
    }

    public function change(Request $request, User $user)
    {
        $rules = [
            'old_password' => 'required'
            'password' => [
                'required',
                'string',
                'min:8',
                'max:32'
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed'
            ]
            ];

        $customMessages = [
            'required' => ':attribute harus di isi gan',
            'min' => 'password kurang dari 8 karakter gan',
            'max' => 'password jangan panjang2 gan',
            'regex' => 'password harus mengandung huruf besar, dan angka gan',
            'confirmed' => 'password ga sama nih gan'
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::where('id', session('LoggedUser'))->first();

        if($user) {
            if(Hash::check($user->password, $request->old_password)) {
                User::update([
                    'password' => Hash::make($request->password)
                ]);

                return back()->with('success', 'password berhasil diganti');
            } else {
                return back()->with('fail', 'password lama salah gan');
            }

            return back()->with('fail', 'password gagal diganti');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
