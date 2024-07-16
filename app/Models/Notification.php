<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(Utenti::class, 'user_id');
    }
}
?>
