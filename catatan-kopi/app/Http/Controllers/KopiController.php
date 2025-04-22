<?php

namespace App\Http\Controllers;

use App\Models\Kopi;
use Illuminate\Http\Request;

class KopiController extends Controller
{
    //
    public function index()
    {
        $kopis = Kopi::all();
        return view('kopi.index', compact('kopis'));
    }
}
