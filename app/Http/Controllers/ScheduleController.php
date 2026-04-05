<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display the daily planner timeline for a given date.
     * Defaults to today if no ?date= parameter is provided.
     */
    public function index(Request $request)
    {
        $selectedDate = $request->query('date', Carbon::today()->toDateString());

        // Validate date format, fallback to today
        try {
            $selectedDate = Carbon::parse($selectedDate)->toDateString();
        } catch (\Exception $e) {
            $selectedDate = Carbon::today()->toDateString();
        }

        $schedules = Auth::user()
            ->schedules()
            ->whereDate('date', $selectedDate)
            ->ordered()
            ->get();

        // Navigation dates
        $prevDate = Carbon::parse($selectedDate)->subDay()->toDateString();
        $nextDate = Carbon::parse($selectedDate)->addDay()->toDateString();
        $isToday  = $selectedDate === Carbon::today()->toDateString();

        return view('schedule', compact(
            'schedules',
            'selectedDate',
            'prevDate',
            'nextDate',
            'isToday'
        ));
    }

    /**
     * Store a new schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|max:255',
            'icon'       => 'required|max:10',
            'date'       => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i',
            'note'       => 'nullable|max:500',
        ]);

        Auth::user()->schedules()->create($validated);

        return redirect()
            ->route('schedule.index', ['date' => $validated['date']])
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Update an existing schedule.
     */
    public function update(Request $request, Schedule $schedule)
    {
        abort_unless($schedule->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'title'      => 'required|max:255',
            'icon'       => 'required|max:10',
            'date'       => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i',
            'note'       => 'nullable|max:500',
        ]);

        $schedule->update($validated);

        return redirect()
            ->route('schedule.index', ['date' => $validated['date']])
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Delete a schedule.
     */
    public function destroy(Request $request, Schedule $schedule)
    {
        abort_unless($schedule->user_id === Auth::id(), 403);

        $date = $schedule->date
            ? Carbon::parse($schedule->date)->toDateString()
            : Carbon::today()->toDateString();

        $schedule->delete();

        return redirect()
            ->route('schedule.index', ['date' => $date])
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
