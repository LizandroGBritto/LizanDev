<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MensajeContacto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MensajeController extends Controller
{
    public function index(Request $request): View
    {
        $soloSinLeer = $request->query('filtro') === 'sin-leer';

        $mensajes = MensajeContacto::query()
            ->when($soloSinLeer, fn ($consulta) => $consulta->sinLeer())
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $sinLeer = MensajeContacto::sinLeer()->count();

        return view('admin.mensajes', compact('mensajes', 'sinLeer', 'soloSinLeer'));
    }

    public function marcarLeido(MensajeContacto $mensaje): RedirectResponse
    {
        $mensaje->alternarLeido();

        return back();
    }

    public function destroy(MensajeContacto $mensaje): RedirectResponse
    {
        $mensaje->delete();

        return back()->with('status', __('Message deleted.'));
    }
}
