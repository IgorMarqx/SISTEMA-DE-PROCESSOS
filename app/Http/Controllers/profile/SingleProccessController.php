<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\JudicialCollective;
use Illuminate\Http\Request;

class SingleProccessController extends Controller
{
    public function index()
    {
        $loggedId = auth()->user()->id;
        $judicialCollective = JudicialCollective::where('user_id', $loggedId)->get();

        return view('admin.myProccess.index', [
            'data' => $judicialCollective,
        ]);
    }
}
