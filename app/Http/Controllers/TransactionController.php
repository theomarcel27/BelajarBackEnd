<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Kirim JSON ke view
        return view('transaction.index');
    }

    public function getData(Request $request){
        $validated = $request->validate([
            'UserID' => 'required|string',
        ]);

        // Ambil data dari model berdasarkan UserID
        $userID = $validated['UserID'];
        $data = Transaction::getData($userID);

        // Ambil data transaksi dari MongoDB
        $mongoData = $data['mongo'];

        // Ambil data pengguna dari SQL Server
        $sqlData = $data['sql'];
        
        // Format data untuk ditampilkan dalam satu tabel
        $combinedData = [];
        foreach ($mongoData as $mongoItem) {
            $combinedData[] = [
                'transactionID' => $mongoItem['TransactionID'],
                'transactionDate' => $mongoItem['TransactionDate'],
                'UserID' => $sqlData[0]->UserID, // Pastikan UserID ada di data SQL
                'UserName' => $sqlData[0]->UserName, // Pastikan UserName ada di data SQL
                'Email' => $sqlData[0]->Email // Pastikan Email ada di data SQL
            ];
        }

        return response()->json($combinedData);
    }

}
