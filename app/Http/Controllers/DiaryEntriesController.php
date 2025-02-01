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
	public function create(Diaries $diary)
	{
		return Inertia::render('DiaryEntries/NewEntry', [
			'diary' => $diary,
			'flash' => session('status')
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreDiaryEntriesRequest $request)
	{
		$entry = DiaryEntries::create([
			'diary_id' => $request->diary_id,
			'entry_date' => $request->entry_date,
			'entry_title' => $request->entry_title,
			'content' => $request->content,
			'user_id' => Auth::id(),
		]);

		return redirect()->route('diary-entries', ['diary' => $request->diary_id])
			->with('status', 'Entry created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(DiaryEntries $diaryEntries)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(DiaryEntries $diaryEntries)
	{
		return Inertia::render('DiaryEntries/EditEntry', [
            'entry' => $diaryEntries,
            'flash' => session('status')
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDiaryEntriesRequest $request, DiaryEntries $diaryEntries)
	{
		if ($diaryEntries->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
		$diaryEntries->update($request->all());

		return redirect()->route('diary-entries', ['diary' => $diaryEntries->diary_id])
			->with('status', 'Entry updated successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(DiaryEntries $diaryEntries)
	{
		if ($diaryEntries->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
		$diary_id = $diaryEntries->diary_id;
		$diaryEntries->delete();
		return redirect()->route('diary-entries', ['diary' => $diary_id])
			->with('status', 'Entry deleted successfully.');
	}
}
