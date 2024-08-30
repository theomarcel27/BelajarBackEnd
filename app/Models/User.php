<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'sqlsrv';
    protected $table = 'UserTest';
    protected $fillable = ['UserID', 'Password', 'Level', 'Email', 'UserName'];
    protected $hidden = ['Password'];

    public $timestamps = false;

    // Implementasi getAuthPassword untuk Eloquent
    public function getAuthPassword()
    {
        return $this->Password;
    }

    public static function getDataUser()
    {
        return self::all(); // Menggunakan Eloquent untuk mendapatkan data
    }

    public static function insertDataUser($data)
    {
        return self::create([
            'UserID' => $data['UserID'],
            'UserName' => $data['UserName'],
            'Email' => $data['Email'],
            'Level' => $data['Level'],
            'Password' => Hash::make($data['Password']) // Password harus dienkripsi
        ]);
    }

    public static function login($userID, $password)
    {
        $user = self::where('UserID', $userID)->first();

        if ($user && Hash::check($password, $user->Password)) {
            return $user;
        }
        return false;
    }
}
