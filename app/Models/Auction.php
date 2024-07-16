<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Utenti::class, 'user_id');
    }
    
    public function offers()
    {
        return $this->hasMany(Offer::class, 'auction_id');
    }
}
?>