<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class PagesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function home()
  {
    return view('home');
  }

  public function shop()
  {
    $users = User::all();
    $products = Product::all();

	return view('pages.shop', [
      'users' => $users,
      'products' => $products
    ]);

  }

  public function gallery()
  {
    $users = User::all();

    return view('pages.gallery', compact('users'));
  }

  public function about()
  {
    $users = User::all();

    return view('pages.about', compact('users'));
  }

  public function accountDetails()
  {
    $user = User::where('id', session('LoggedUser'))->first();

    if(session('LoggedUser')) {
      return view('account.details', compact('user'));
    } else {
      return redirect('login');
    }
  }

  public function changePassword()
  {
    if(session('LoggedUser')){
      return view('account.change-password');
    } else {
      return redirect('login');
    }
  }

  public function orders()
  {
    if(session('LoggedUser') == 8) {
      $order = Order::paginate(25);
      return view('admin.orders', compact('order'));
    } elseif(!session('LoggedUser')) {
      return redirect('login');
    } else {
      $order = Order::where('user_id', session('LoggedUser'))->get();
      return view('account.orders', compact('order'));
    }
  }

  public function logout()
  {
    $users = User::all();
    return view('pages.logout', compact('users'));
  }

  public function checkout()
  {
    return view('pages.checkout');
  }

  public function layout()
  {
    $users = User::all();

    return view('layouts.pages', compact('users'));
  }

	public function test()
	{
		return 'test aja gan';
	}	


}
