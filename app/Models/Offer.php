<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(Utenti::class, 'user_id');
    }

    public function auctions()
    {
        return $this->belongsTo(Auction::class, 'auction_id');
    }
}
?>

