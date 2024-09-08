<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\Apps\MahaVisitorOrganizerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Apps\Visitor;
use Illuminate\Http\Request;

class MahaVisitorOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MahaVisitorOrganizerDataTable $dataTable)
    {
        return $dataTable->render('apps.visitor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('apps.visitor.show', [
            'visitor' => $visitor
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
