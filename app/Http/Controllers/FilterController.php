<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filter_date(Request $request)
    {
        $first = $request['firstDate'];
        $second = $request['secondDate'];

        $filter = DB::table('events')
            ->whereBetween('date', [$first, $second])
            ->get();

        return response()->json(['filter' => $filter]);
    }

    public function filter_category(Request $request)
    {
        $category = $request['type'];

        $filter = DB::table('events')
            ->where('type', [$category])
            ->get();

        return response()->json(['filter' => $filter]);
    }
}
