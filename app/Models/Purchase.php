<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';

    protected $casts = ['data' => 'json'];

    protected $fillable = ['purchase_id', 'data', 'payment_id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
