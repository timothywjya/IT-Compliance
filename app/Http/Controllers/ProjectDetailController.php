<?php

namespace App\Http\Controllers;

use App\Models\ProjectDetail;
use App\Models\ProjectHeader;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    public function create(ProjectHeader $projectHeader)
    {
        return view('project-detail.form', ['projectHeader' => $projectHeader, 'detail' => null]);
    }

    public function store(Request $request, ProjectHeader $projectHeader)
    {
        $request->validate([
            'testing_scenario'      => 'required|string|max:255',
            'target'                => 'nullable|string|max:255',
            'testing_by_support'    => 'required|in:Y,N',
            'testing_by_programmer' => 'required|in:Y,N',
        ]);

        $projectHeader->details()->create([
            ...$request->only('testing_scenario', 'target', 'testing_by_support', 'testing_by_programmer'),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('project-header.show', $projectHeader)->with('success', 'Detail testing berhasil ditambahkan.');
    }

    public function edit(ProjectHeader $projectHeader, ProjectDetail $detail)
    {
        return view('project-detail.form', compact('projectHeader', 'detail'));
    }

    public function update(Request $request, ProjectHeader $projectHeader, ProjectDetail $detail)
    {
        $request->validate([
            'testing_scenario'      => 'required|string|max:255',
            'target'                => 'nullable|string|max:255',
            'testing_by_support'    => 'required|in:Y,N',
            'testing_by_programmer' => 'required|in:Y,N',
        ]);

        $detail->update([
            ...$request->only('testing_scenario', 'target', 'testing_by_support', 'testing_by_programmer'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('project-header.show', $projectHeader)->with('success', 'Detail testing berhasil diupdate.');
    }

    public function destroy(ProjectHeader $projectHeader, ProjectDetail $detail)
    {
        $detail->delete();
        return back()->with('success', 'Detail testing berhasil dihapus.');
    }
}
