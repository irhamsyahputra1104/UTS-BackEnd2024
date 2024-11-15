<?php

namespace App\Http\Controllers;

use App\Models\Covid;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function index()
    {
        $covid = Covid::get();

        $message = $covid->isEmpty()
        ?  'Data is Empty'
        :   'Get all response';

        return response()->json([
            'message' => $message,
            'data' => $covid
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'status' => ['required', 'string', 'max:255'],
            'in_date_at' => ['required', 'string'],
            'out_date_at' => ['required', 'string'],
        ]);

        $covid = Covid::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at,
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $covid,
        ], 201);
    }

    public function show(String $id)
    {
        $covid = Covid::where('id', $id)->first();

        if (!$covid) {
            return response()->json([
                'message'=> 'Data tidak ditemukan',
                'data'=> $covid,
                ],404);
        }

        return response()->json([
            'message'=> 'Mendapatkan data secara detail',
            'data'=> $covid,
            ],200);
    }
    public function update(Request $request, String $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'status' => ['required', 'string', 'max:255'],
            'in_date_at' => ['required', 'string'],
            'out_date_at' => ['required', 'string'],
        ]);

        $covid = Covid::where('id', $id)->first();

        if (!$covid) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => $covid,
            ], 404);
        }

        $covid->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at,
        ]);

        return response()->json([
            'message' => 'Data berhasil di update',
            'data' => $covid
        ], 200);
    }

    public function delete(Request $request, String $id)
    {
        $covid = Covid::where('id', $id)->first();

        if (!$covid) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => $covid,
            ], 404);
        }

        $covid->delete();

        return response()->json([
            'message' => 'Data berhasil di hapus',
            'data' => $covid
        ], 200);
    }

    public function search($name)
    {

        $covid = Covid::where('name', 'like', '%' . $name .'%')->get();

        if (!$covid->IsEmpty()) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => $covid,
            ], 404);
        }

        return response()->json([
            'message' => 'Data berhasil dicari',
            'total' => $covid->count(),
            'data' => $covid
        ], 200);

    }

    public function getPositiveResources()
    {
        // Mengambil semua resource yang positif
        $positiveResources = Covid::where('status', 'positive')->get();

        // Mengembalikan response dengan total dan data jika resource ditemukan
        return response()->json([
            'message' => 'Pasien positive ditemukan',
            'total' => $positiveResources->count(),
            'data' => $positiveResources,
        ], 200);
    }

    public function getRecoveredResources()
    {
        // Mengambil semua resource yang positif
        $recoveredResources = Covid::where('status', 'recorved')->get();

        // Mengembalikan response dengan total dan data jika resource ditemukan
        return response()->json([
            'message' => 'Pasien yg sembuh ditemukan',
            'total' => $recoveredResources->count(),
            'data' => $recoveredResources,
        ], 200);
    }

    public function getDeadResources()
    {
        $deadPatients = Covid::where('status', 'dead')->get();

        // Mengembalikan response dengan total dan data pasien yang ditemukan
        return response()->json([
            'message' => 'Pasien yang meninggal ditemukan',
            'total' => $deadPatients->count(),
            'data' => $deadPatients,
        ], 200);
    }

}





