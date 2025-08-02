<?php

namespace App\Http\Controllers;

use App\Models\Berita_model;
use App\Models\Kategori_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Berita extends Controller
{
    // Main page
    public function index()
    {
        $site   = DB::table('konfigurasi')->first();
        $berita = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where('berita.status_berita', 'Publish')
            ->orderBy('berita.id_berita', 'DESC')
            ->paginate(9);

        $data = [
            'title'     => 'Berita, Artikel, dan Informasi',
            'deskripsi' => 'Berita, Artikel, dan Informasi',
            'keywords'  => 'Berita, Artikel, dan Informasi',
            'site'      => $site,
            'berita'    => $berita,
            'content'   => 'berita/index',
        ];
        return view('layout/wrapper', $data);
    }

    // Main page - Jual
    public function jual(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        
        // --- BAGIAN YANG DIPERBAIKI ---

        // 1. Memulai query dasar untuk properti yang dijual
        $query = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where(['berita.status_berita' => 'Publish', 'berita.jenis_berita' => 'Jual']);

        // 2. Menerapkan filter secara dinamis hanya jika input diisi
        if ($request->filled('keywords')) {
            $query->where('berita.judul_berita', 'LIKE', '%' . $request->keywords . '%');
        }
        if ($request->filled('min_harga')) {
            $query->where('berita.harga', '>=', $request->min_harga);
        }
        if ($request->filled('max_harga')) {
            $query->where('berita.harga', '<=', $request->max_harga);
        }
        if ($request->filled('bedroom')) {
            $query->where('berita.jumlah_kamar_tidur', $request->bedroom);
        }
        if ($request->filled('bathroom')) {
            $query->where('berita.jumlah_kamar_mandi', $request->bathroom);
        }
        if ($request->filled('min_lt')) {
            $query->where('berita.luas_tanah', '>=', $request->min_lt);
        }
        if ($request->filled('max_lt')) {
            $query->where('berita.luas_tanah', '<=', $request->max_lt);
        }
        if ($request->filled('min_lb')) {
            $query->where('berita.luas_bangunan', '>=', $request->min_lb);
        }
        if ($request->filled('max_lb')) {
            $query->where('berita.luas_bangunan', '<=', $request->max_lb);
        }

        // 3. Mengambil hasil query
        $berita = $query->orderBy('berita.id_berita', 'DESC')->paginate(9);

        // --- AKHIR BAGIAN YANG DIPERBAIKI ---

        $data = [
            'title'     => 'Jual Property',
            'deskripsi' => 'Jual Property',
            'keywords'  => 'Jual Property',
            'site'      => $site,
            'berita'    => $berita,
            'content'   => 'berita/jual',
        ];
        return view('layout/wrapper', $data);
    }

    // Main page - Sewa
    public function sewa(Request $request)
    {
        $site   = DB::table('konfigurasi')->first();
        
        // --- BAGIAN YANG DIPERBAIKI ---

        // 1. Memulai query dasar untuk properti yang disewa
        $query = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where(['berita.status_berita' => 'Publish', 'berita.jenis_berita' => 'Sewa']);

        // 2. Menerapkan filter secara dinamis hanya jika input diisi
        if ($request->filled('keywords')) {
            $query->where('berita.judul_berita', 'LIKE', '%' . $request->keywords . '%');
        }
        if ($request->filled('min_harga')) {
            $query->where('berita.harga', '>=', $request->min_harga);
        }
        if ($request->filled('max_harga')) {
            $query->where('berita.harga', '<=', $request->max_harga);
        }
        if ($request->filled('bedroom')) {
            $query->where('berita.jumlah_kamar_tidur', $request->bedroom);
        }
        if ($request->filled('bathroom')) {
            $query->where('berita.jumlah_kamar_mandi', $request->bathroom);
        }
        if ($request->filled('min_lt')) {
            $query->where('berita.luas_tanah', '>=', $request->min_lt);
        }
        if ($request->filled('max_lt')) {
            $query->where('berita.luas_tanah', '<=', $request->max_lt);
        }
        if ($request->filled('min_lb')) {
            $query->where('berita.luas_bangunan', '>=', $request->min_lb);
        }
        if ($request->filled('max_lb')) {
            $query->where('berita.luas_bangunan', '<=', $request->max_lb);
        }

        // 3. Mengambil hasil query
        $berita = $query->orderBy('berita.id_berita', 'DESC')->paginate(9);
        
        // --- AKHIR BAGIAN YANG DIPERBAIKI ---

        $data = [
            'title'     => 'Sewa Property',
            'deskripsi' => 'Sewa Property',
            'keywords'  => 'Sewa Property',
            'site'      => $site,
            'berita'    => $berita,
            'content'   => 'berita/sewa',
        ];
        return view('layout/wrapper', $data);
    }

    // kategori
    public function kategori($slug_kategori)
    {
        $site     = DB::table('konfigurasi')->first();
        $kategori = DB::table('kategori')->where('slug_kategori', $slug_kategori)->first();
        if (!$kategori) {
            return redirect('/');
        }
        $berita = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where([
                'berita.status_berita'  => 'Publish',
                'berita.id_kategori'    => $kategori->id_kategori,
            ])
            ->orderBy('berita.id_berita', 'DESC')
            ->paginate(9);

        $data = [
            'title'     => $kategori->nama_kategori,
            'deskripsi' => $kategori->nama_kategori,
            'keywords'  => $kategori->nama_kategori,
            'site'      => $site,
            'berita'    => $berita,
            'content'   => 'berita/index',
        ];
        return view('layout/wrapper', $data);
    }

    // read
    public function read($slug_berita)
    {
        $site   = DB::table('konfigurasi')->first();
        $berita = Berita_model::select('berita.*', 'kategori.nama_kategori', 'kategori.slug_kategori', 'users.name')
            ->join('kategori', 'kategori.id_kategori', '=', 'berita.id_kategori')
            ->join('users', 'users.id_user', '=', 'berita.id_user')
            ->where('berita.slug_berita', $slug_berita)
            ->first();
        // paginasi
        $kategori = DB::table('kategori')->orderBy('urutan', 'ASC')->get();

        $data = [
            'title'     => $berita->judul_berita,
            'deskripsi' => $berita->judul_berita,
            'keywords'  => $berita->judul_berita,
            'site'      => $site,
            'berita'    => $berita,
            'kategori'  => $kategori,
            'content'   => 'berita/read',
        ];
        return view('layout/wrapper', $data);
    }
}