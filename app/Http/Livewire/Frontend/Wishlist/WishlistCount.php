<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    // 
    protected $listeners = ['wishlistAddedUpdated' => 'checkwishlistcount'];
    public $wishlistcount;
    public function checkwishlistcount()
    {
        if (Auth::check()) {
            return $this->wishlistcount = Wishlist::where('user_id', auth()->user()->id)->count();
        } else {
            return $this->wishlistcount = 0;
        }
    }
    public function render()
    {
        $this->wishlistcount = $this->checkwishlistcount();
        return view('livewire.frontend.wishlist.wishlist-count', [
            "wishlistcount" => $this->wishlistcount
        ]);
    }
}
