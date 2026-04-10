<?php

namespace App\Http\Controllers;

use App\Models\MasterTicketing;
use App\Models\ProjectHeader;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectHeaderController extends Controller
{
    public function index()
    {
        return view('project-header.index');
    }

    public function dataTable()
    {
        $data = ProjectHeader::with('developer', 'prpk', 'memo')->get()->map(fn($p) => [
            'id'               => $p->id,
            'application_name' => $p->application_name,
            'program_version'  => $p->program_version,
            'developer'        => $p->developer?->first_name . ' ' . $p->developer?->last_name,
            'prpk'             => $p->prpk?->ticket_number ?? '-',
            'memo'             => $p->memo?->ticket_number ?? '-',
            'test_date'        => $p->test_date ? \Carbon\Carbon::parse($p->test_date)->format('d M Y') : '-',
        ]);
        return response()->json(['data' => $data]);
    }

    public function create()
    {
        $users     = User::all();
        $ticketing = MasterTicketing::all();
        return view('project-header.form', ['project' => null, 'users' => $users, 'ticketing' => $ticketing]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_name'  => 'required|string|max:255',
            'program_version'   => 'required|string|max:50',
            'developed_by'      => 'required|exists:users,id',
            'prpk_id'           => 'nullable|exists:master_ticketing,id',
            'pic_prpk'          => 'nullable|exists:users,id',
            'name_pic_prpk'     => 'nullable|string|max:255',
            'memo_id'           => 'nullable|exists:master_ticketing,id',
            'pic_memo'          => 'nullable|exists:users,id',
            'name_pic_memo'     => 'nullable|string|max:255',
            'developer_testing' => 'nullable|exists:users,id',
            'support_testing'   => 'nullable|exists:users,id',
            'test_date'         => 'nullable|date',
        ]);

        ProjectHeader::create([
            ...$request->only([
                'application_name',
                'program_version',
                'developed_by',
                'prpk_id',
                'pic_prpk',
                'name_pic_prpk',
                'memo_id',
                'pic_memo',
                'name_pic_memo',
                'developer_testing',
                'support_testing',
                'test_date',
            ]),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('project-header.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(ProjectHeader $projectHeader)
    {
        $projectHeader->load('developer', 'prpk', 'memo', 'picPrpk', 'picMemo', 'developerTesting', 'supportTesting', 'information', 'details');
        return view('project-header.show', compact('projectHeader'));
    }

    public function edit(ProjectHeader $projectHeader)
    {
        $users     = User::all();
        $ticketing = MasterTicketing::all();
        return view('project-header.form', ['project' => $projectHeader, 'users' => $users, 'ticketing' => $ticketing]);
    }

    public function update(Request $request, ProjectHeader $projectHeader)
    {
        $request->validate([
            'application_name'  => 'required|string|max:255',
            'program_version'   => 'required|string|max:50',
            'developed_by'      => 'required|exists:users,id',
            'prpk_id'           => 'nullable|exists:master_ticketing,id',
            'pic_prpk'          => 'nullable|exists:users,id',
            'name_pic_prpk'     => 'nullable|string|max:255',
            'memo_id'           => 'nullable|exists:master_ticketing,id',
            'pic_memo'          => 'nullable|exists:users,id',
            'name_pic_memo'     => 'nullable|string|max:255',
            'developer_testing' => 'nullable|exists:users,id',
            'support_testing'   => 'nullable|exists:users,id',
            'test_date'         => 'nullable|date',
        ]);

        $projectHeader->update([
            ...$request->only([
                'application_name',
                'program_version',
                'developed_by',
                'prpk_id',
                'pic_prpk',
                'name_pic_prpk',
                'memo_id',
                'pic_memo',
                'name_pic_memo',
                'developer_testing',
                'support_testing',
                'test_date',
            ]),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('project-header.index')->with('success', 'Project berhasil diupdate.');
    }

    public function destroy(ProjectHeader $projectHeader)
    {
        $projectHeader->delete();
        return back()->with('success', 'Project berhasil dihapus.');
    }
}
