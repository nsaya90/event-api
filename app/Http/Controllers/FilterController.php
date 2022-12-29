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

    public function filter_type(Request $request, $type)
    {
        $type = $request['type'];

        $filter = DB::table('events')
            ->where('type', '=', $type)
            ->get();

        return response()->json(['filter' => $filter]);
    }


    public function filter_city(Request $request, $city)
    {
        $city = $request['city'];

        $filter = DB::table('events')
            ->where('city', '=', $city)
            ->get();

        return response()->json(['filter' => $filter]);
    }
}
