<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featured = Car::query()
            ->published()
            ->where('is_featured', true)
            ->with(['brand', 'media'])
            ->latest()
            ->limit(6)
            ->get();

        // Landing page hanya menampilkan 3 mobil terbaru, sisanya ada di katalog
        $latest = Car::query()
            ->published()
            ->with(['brand', 'media'])
            ->latest()
            ->limit(3)
            ->get();

        return view('home.index', compact('featured', 'latest'));
    }
}