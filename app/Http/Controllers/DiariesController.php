<?php

namespace App\Http\Controllers;

use App\Models\Diaries;
use App\Http\Requests\StoreDiariesRequest;
use App\Http\Requests\UpdateDiariesRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class DiariesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$diaries = Diaries::where('user_id', Auth::id())->get();

		return Inertia::render('Dashboard', [
			'diaries' => $diaries
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return Inertia::render('Diary/NewDiary');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreDiariesRequest $request)
	{
		Diaries::create([
			'user_id' => Auth::id(),
			'title' => $request->title,
			'description' => $request->description,
		]);

		return redirect()->route('dashboard')->with('status', 'Diary created successfully!');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Diaries $diaries)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Diaries $diaries)
	{
		if ($diaries->user_id !== Auth::id()) {
			abort(403, 'Unauthorized action.');
		}

		return Inertia::render('Diary/EditDiary', [
			'diary' => $diaries,
			'flash' => session('status')
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateDiariesRequest $request, Diaries $diaries)
	{
		$diaries->update($request->all());

		return redirect()->route('dashboard')
			->with('status', 'Diary updated successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Diaries $diaries)
	{
		$diaries->delete();

		return redirect()->route('dashboard')->with('status', 'Diary deleted successfully.');
	}
}
