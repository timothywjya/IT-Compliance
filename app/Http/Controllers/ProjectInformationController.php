<?php

namespace App\Http\Controllers;

use App\Models\ProjectHeader;
use App\Models\ProjectInformation;
use Illuminate\Http\Request;

class ProjectInformationController extends Controller
{
    public function create(ProjectHeader $projectHeader)
    {
        $info = $projectHeader->information;
        return view('project-information.form', compact('projectHeader', 'info'));
    }

    public function store(Request $request, ProjectHeader $projectHeader)
    {
        $request->validate([
            'needs'             => 'nullable|string',
            'location'          => 'required|in:Server,Local',
            'configuration'     => 'nullable|string|max:255',
            'special_condition' => 'nullable|string|max:255',
            'dependency'        => 'nullable|string|max:255',
        ]);

        $projectHeader->information()->updateOrCreate(
            ['project_header_id' => $projectHeader->id],
            [
                ...$request->only('needs', 'location', 'configuration', 'special_condition', 'dependency'),
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]
        );

        return redirect()->route('project-header.show', $projectHeader)->with('success', 'Informasi project berhasil disimpan.');
    }

    public function edit(ProjectHeader $projectHeader, ProjectInformation $information)
    {
        return view('project-information.form', ['projectHeader' => $projectHeader, 'info' => $information]);
    }

    public function update(Request $request, ProjectHeader $projectHeader, ProjectInformation $information)
    {
        $request->validate([
            'needs'             => 'nullable|string',
            'location'          => 'required|in:Server,Local',
            'configuration'     => 'nullable|string|max:255',
            'special_condition' => 'nullable|string|max:255',
            'dependency'        => 'nullable|string|max:255',
        ]);

        $information->update([
            ...$request->only('needs', 'location', 'configuration', 'special_condition', 'dependency'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('project-header.show', $projectHeader)->with('success', 'Informasi project berhasil diupdate.');
    }

    public function destroy(ProjectHeader $projectHeader, ProjectInformation $information)
    {
        $information->delete();
        return back()->with('success', 'Informasi project berhasil dihapus.');
    }
}
