<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class UserSql extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    protected $connection = 'sqlsrv';
    protected $table = 'UserTest';
    protected $fillable = ['UserID', 'Password', 'Level', 'Email', 'UserName'];
    protected $hidden = ['Password'];

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
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    
}