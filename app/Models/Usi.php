<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usi extends Model
{
    use HasFactory;

    protected $connection = 'mongodb'; // Pastikan koneksi diatur ke MongoDB
    protected $collection = 'usi';     // Nama koleksi di MongoDB

}
