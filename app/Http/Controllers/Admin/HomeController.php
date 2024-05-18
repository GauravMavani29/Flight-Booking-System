<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seat;

class HomeController extends Controller
{
    public function __construct()
    {
        // Permission Check
        // $this->middleware(['permission:admin_dashboard'])->only('index');
    }

    public function index()
    {

        $seats = Seat::where('airplane_id', 2)
            ->orderBy('class')
            ->orderBy('number')
            ->orderBy('alphabet')
            ->get()
            ->groupBy(['class', 'number']);

        // Ensure seats within each class are sorted by number
        $sortedSeats = collect([
            'Economy class' => collect($seats->get('Economy Class', collect()))->sortKeys()->toArray(),
            'business class' => collect($seats->get('Business Class', collect()))->sortKeys()->toArray(),
            'economy class' => collect($seats->get('Economy Class', collect()))->sortKeys()->toArray(),
        ]);

        return view('admin.dashboard', ['seats' => $sortedSeats]);
    }

}
