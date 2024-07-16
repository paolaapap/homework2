<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(Utenti::class, 'user_id');
    }
}
?>
