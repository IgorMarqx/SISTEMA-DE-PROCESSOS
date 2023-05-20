<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrativeCollectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrative =  AdministrativeCollective::paginate(7);

        $administrative_count = AdministrativeCollective::count();

        $progress_administrative = AdministrativeCollective::where('progress_collective', '1')->count();
        $update_administrative = AdministrativeCollective::where('update_collective', '1')->count();
        $finish_administrative = AdministrativeCollective::where('finish_collective', '1')->count();

        return view('admin.collective.administrative.index', [
            'administrative' => $administrative,

            'administrative_count' =>  $administrative_count,
            'progress_administrative' => $progress_administrative,

            'update_administrative' => $update_administrative,
            'finish_administrative' => $finish_administrative,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();

        return view('admin.collective.administrative.create', [
            'users' =>  $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $administrative = AdministrativeCollective::find($id);
        $user = $administrative->user;
        $attachment = Attachment::where('administrative_collective_id', $id)->get();

        return view('admin.collective.administrative.details', [
            'administrative' => $administrative,
            'user' => $user,
            'attachment' => $attachment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
