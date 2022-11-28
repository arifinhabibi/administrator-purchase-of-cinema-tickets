<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];

    protected $hidden = ['created_at', 'updated_at']; 

    public function seat(){
        return $this->hasMany(PurchaseTicket::class);
    }

    public function created_by(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

}
