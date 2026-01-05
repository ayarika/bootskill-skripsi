<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use App\Models\Event;
use App\Models\Module;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $results = Bootcamp::where(function ($q) use ($query) {
                            $q->where('title', 'like', '%' . $query . '%')
                                ->orWhere('description', 'like', '%' . $query . '%');
                        })
                        ->where('end_at', '>=', now())
                        ->get();

        return view('searchresults', compact('results', 'query'));
    }
}
