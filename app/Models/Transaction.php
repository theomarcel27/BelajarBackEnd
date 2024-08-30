<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;
    
    public static function getData($userID){
        $mongoData = DB::connection('mongodb')
        ->collection('transaction')
        ->where('UserID', $userID)
        ->get(['TransactionID', 'TransactionDate'])
        ->toArray();

        $sqlData = DB::connection('sqlsrv')
        ->select('Select UserID, UserName, Email From UserTest WHERE UserID = ?', [$userID]);

        return [
            'mongo' => $mongoData,
            'sql' => $sqlData
        ];
    }
}
