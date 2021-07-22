<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class PagesLayout extends Component
{
  /**
   * Get the view / contents that represents the component.
   *
   * @return \Illuminate\View\View
   */
  public function render()
  {
    $users = User::all();

    return view('layouts.pages', compact('users'));
  }
}
