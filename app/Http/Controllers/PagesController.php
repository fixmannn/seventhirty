<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    $users = User::all();
	
    return view('home', compact('users'));
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
    return view('account.details', compact('user'));
  }

  public function changePassword()
  {
    return view('account.change-password');
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
