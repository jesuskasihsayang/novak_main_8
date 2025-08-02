<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita_model;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Fungsi untuk mengambil semua data properti
    public function index()
    {
        $properti = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where('berita.status_berita', 'Publish')
            ->orderBy('berita.id_berita', 'DESC')
            ->paginate(10); // Menggunakan paginasi, 10 data per halaman

        if ($properti) {
            return response()->json([
                'success' => true,
                'message' => 'Data properti berhasil ditemukan',
                'data'    => $properti
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data properti tidak ditemukan',
        ], 404);
    }

    // Fungsi untuk mengambil detail satu properti
    public function show($id)
    {
        $properti = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where('berita.id_berita', $id)
            ->first();

        if ($properti) {
            return response()->json([
                'success' => true,
                'message' => 'Detail properti berhasil ditemukan',
                'data'    => $properti
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Properti dengan ID ' . $id . ' tidak ditemukan',
        ], 404);
    }
}