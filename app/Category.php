<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Interest;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    protected $fillable = [
        'title',
    ];

    // public function subscriptions()
    // {
    //     # code...
    //     return $this.hasMany(App\Interest);
    // }


    public function subscribe($category_id=null, $user_id=null)
    {
        # code...
        $create=Interest::create([
            'user_id'=>$user_id,
            'category_id'=>$category_id
        ]);
        return $create;
    }

    public function unsubscribe($id=null)
    {
        # code...
        // $this->subscriptions()
        // ->where('user_id', $userId?: auth()->id())
        // ->delete();
        $delete=Interest::find($id);
        $delete->delete();
        return $delete;
        // Interest::whereUser_idAndCategory_id('$user_id', 'category_id')->first()->delete();
    }
}
