<?php

namespace App\Http\Controllers;

use App\Models\Kopi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KopiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kopis = Kopi::where('user_id', Auth::id())->get();
        return view('kopi.index', compact('kopis'));
    }

    public function create()
    {
        return view('kopi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'asal_kopi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Kopi::create([
            'user_id' => Auth::id(),
            'nama_kopi' => $request->nama_kopi,
            'asal_kopi' => $request->asal_kopi,
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
            'rating' => $request->rating,
        ]);

        return redirect()->route('kopi.index')->with('success', 'Catatan berhasil ditambahkan!');
    }

    public function edit(Kopi $kopi)
    {
        if ($kopi->user_id !== Auth::id()) {
            return redirect()->route('kopi.index')->with('error', 'Anda tidak punya akses ke catatan ini!');
        }
        return view('kopi.edit', compact('kopi'));
    }

    public function update(Request $request, Kopi $kopi)
    {
        if ($kopi->user_id !== Auth::id()) {
            return redirect()->route('kopi.index')->with('error', 'Anda tidak punya akses ke catatan ini!');
        }

        $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'asal_kopi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $kopi->update([
            'nama_kopi' => $request->nama_kopi,
            'asal_kopi' => $request->asal_kopi,
            'tanggal' => $request->tanggal,
            'catatan' => $request->catatan,
            'rating' => $request->rating,
        ]);

        return redirect()->route('kopi.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy(Kopi $kopi)
    {
        if ($kopi->user_id !== Auth::id()) {
            return redirect()->route('kopi.index')->with('error', 'Anda tidak punya akses ke catatan ini!');
        }

        $kopi->delete();
        return redirect()->route('kopi.index')->with('success', 'Catatan berhasil dihapus!');
    }
}