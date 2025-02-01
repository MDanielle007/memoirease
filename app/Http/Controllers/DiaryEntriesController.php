<?php

namespace App\Http\Controllers;

use App\Models\Diaries;
use App\Models\DiaryEntries;
use App\Http\Requests\StoreDiaryEntriesRequest;
use App\Http\Requests\UpdateDiaryEntriesRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DiaryEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Diaries $diary)
    {
		if ($diary->user_id !== Auth::id()) {
			abort(403, 'Unauthorized action.');
		}

		$entries = DiaryEntries::where('diary_id', $diary->id)->get();

		return Inertia::render('DiaryEntries/Entries', [
			'diary' => $diary,
			'entries' => $entries,
			'flash' => session('status')
		]);
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
    public function store(StoreDiaryEntriesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DiaryEntries $diaryEntries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiaryEntries $diaryEntries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiaryEntriesRequest $request, DiaryEntries $diaryEntries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiaryEntries $diaryEntries)
    {

    }
}
