<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utenti extends Model
{
    protected $table = 'utenti';
    public $timestamps = false;

    public function cookies()
    {
        return $this->hasMany(Cookie::class, 'user_id');
    }

    public function tours()
    {
        return $this->hasMany(Tour::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'user_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'user_id');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'favorites', 'user_id', 'collection_id');
    }
}
?>