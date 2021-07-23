<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductInfo;
use App\Models\Product;

class ProductsController extends Controller
{
  public function friendship(Product $id)
  {
    return 'hello';
  }

  public function anxiety(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202102')->get();

    return view('products.anxiety', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function forgiving(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202103')->get();

    return view('products.forgiving', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function paramore(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202118')->get();

    return view('products.paramore', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function beerbongs(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202110')->get();

    return view('products.beerbongs', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function blackpink(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202111')->get();

    return view('products.blackpink', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function drake(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202115')->get();

    return view('products.drake', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function dualipa(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202107')->get();

    return view('products.dualipa', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function dynamite(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202116')->get();

    return view('products.dynamite', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function hayley(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202109')->get();

    return view('products.hayley', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function hollywoods(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202113')->get();

    return view('products.hollywoods', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function lookmom(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202108')->get();

    return view('products.lookmom', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function modernity(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202119')->get();

    return view('products.modernity', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function neckdeep(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202120')->get();

    return view('products.neckdeep', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function purpose(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202112')->get();

    return view('products.purpose', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function starboy(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202105')->get();

    return view('products.starboy', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function travis(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202106')->get();

    return view('products.travis', [
      'products' => $products,
      'info' => $info
    ]);
  }

  public function zayn(Product $id)
  {
    $products = Product::find($id);

    $info = ProductInfo::where('product_id', '202114')->get();

    return view('products.zayn', [
      'products' => $products,
      'info' => $info
    ]);
  }
}
