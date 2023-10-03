<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info'; // Nama tabel yang diinginkan
    protected $fillable = [
        'user_id',
        'position',
        'image',
    ];

    // Definisikan hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
