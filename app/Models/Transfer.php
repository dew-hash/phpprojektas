<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = ['fromiban', 'toiban', 'purpose', 'amount', 'time', 'id', 'currency'];


    public function account(){
        return $this->belongsTo(Account::class);
    }
}
