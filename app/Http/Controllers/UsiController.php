<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserSql;
use Illuminate\Support\Facades\Hash;

class UsiController extends Controller
{
    public function index()
    {
        // Ambil data dari koleksi 'usi' menggunakan koneksi MongoDB
        $mongoData = DB::connection('mongodb')
                        ->collection('usi')
                        ->get();

        // Mengubah data menjadi JSON
        $jsonMongoData = json_encode($mongoData);

        // Kirim JSON ke view
        return view('usi.index', ['usiData' => $jsonMongoData]);
    }

    public function index2(){
        $data =UserSql::getDataUser();

        $dataSqlJson = json_encode($data);

        return view('usi.index2', ['userData'=>$dataSqlJson]);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'a' => 'required|string',
        ]);

        try {
            // Insert data ke koleksi 'usi'
            DB::connection('mongodb')
                ->collection('usi')
                ->insert($validatedData);

            // Kembalikan data dalam format JSON
            return response()->json([
                'message' => 'Data berhasil ditambahkan!',
                'data' => $validatedData
            ]);
        } catch (\Exception $e) {
            // Kembalikan pesan error jika insert gagal
            return response()->json([
                'message' => 'Gagal menambahkan data! Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store2(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'UserID' => 'required|string',
            'UserName' => 'required|string',
            'Email' => 'required|email',
            'Level' => 'required',
            'Password' => 'required|min:6'
        ]);

        $validatedData['Password'] = Hash::make($validatedData['Password']);

        try {
            $inserted = UserSql::insertDataUser($validatedData);
            // Kembalikan data dalam format JSON
            return response()->json([
                'message' => 'Data berhasil ditambahkan!',
                'data' => $validatedData
            ]);
        } catch (\Exception $e) {
            // Kembalikan pesan error jika insert gagal
            return response()->json([
                'message' => 'Gagal menambahkan data! Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
