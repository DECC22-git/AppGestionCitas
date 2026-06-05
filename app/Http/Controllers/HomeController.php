<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Usamos la fachada DB para hacerlo rápido y limpio

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Contamos el total de registros de cada tabla
        $totalPacientes = DB::table('patients')->count();
        $totalDoctores  = DB::table('doctors')->count();
        $totalCitas     = DB::table('appointments')->count();

        // Pasamos las tres variables a la vista
        return view('home', compact('totalPacientes', 'totalDoctores', 'totalCitas'));
    }
}