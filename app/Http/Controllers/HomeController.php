<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Tambahkan ini

class HomeController extends Controller
{
    public function index()
    {
        return view('home'); // Menampilkan halaman home
    }

    public function adminHome()
    {
        $produks = Produk::all(); // Ambil semua data produk

        return view('adminHome', compact('produks')); // Kirim data ke view
    }

    public function managerHome()
    {
        return view('managerHome'); // Menampilkan halaman manager
    }
}
