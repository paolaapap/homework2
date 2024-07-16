<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public $timestamps = false;
    
    public function users()
    {
        return $this->belongsToMany(Utenti::class, 'favorites', 'collection_id', 'user_id');
    }
}
?>
