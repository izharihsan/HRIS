<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use Carbon\Carbon;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Shift;
use App\Models\Schedule;

class AttendanceCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getCurrentAttendance()
    {
        // get the latest in today absence
        $absence = Absence::where('user_id', auth()->user()->employee->id)
            ->whereDate('tanggal', Carbon::today())
            ->latest()
            ->first();
        return response()->json($absence, 200);
    }

    public function getAttendanceHistory()
    {
        $absences = Absence::where('user_id', auth()->user()->employee->id)
            ->latest()
            ->get();
        return response()->json($absences, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function clock_in(Request $request)
    {
        try {
            $validate = $request->validate([
                'lat' => 'required',
                'lng' => 'required',
            ]);

            $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $day = $days[Carbon::now()->dayOfWeek];

            $userId = auth()->user()->employee->id;
            $schedule = Schedule::with('shift')->where('day', $day)
                ->whereRaw("user_ids LIKE '%,$userId,%' OR user_ids LIKE '$userId,%' OR user_ids LIKE '%,$userId' OR user_ids = '$userId'")
                ->first();

            if (!$schedule) {
                return throw new \Exception('You are not scheduled to work today');
            }

            // check if user late or not based on schedule -> shift start time
            $late = false;
            $shift_start_time = Carbon::parse($schedule->shift->start_time);
            $current_time = Carbon::parse($request->start_time);
            if ($current_time->gt($shift_start_time)) {
                $late = true;
            }

            //  save proof image and face recognition image in storage public
            $proof_image = $request->file('proof_image');
            $proof_image_name = time() . '.' . $proof_image->getClientOriginalExtension();
            $proof_image->move(public_path('absences'), $proof_image_name);

            $face_recognition = $request->file('face_recognition');
            $face_recognition_name = time() . '.' . $face_recognition->getClientOriginalExtension();
            $face_recognition->move(public_path('absences'), $face_recognition_name);

            $absence = new Absence();
            $absence->user_id = auth()->user()->employee->id;
            $absence->type = 'clock_in';
            $absence->timestamp = Carbon::now();
            $absence->lat = $request->lat;
            $absence->lng = $request->lng;
            $absence->proof_image = $proof_image_name;
            $absence->face_recognition = $face_recognition_name;
            $absence->start_time = $request->start_time;
            $absence->late = $late;
            $absence->tanggal = Carbon::today();
            $absence->save();

            return response()->json(['message' => 'Absence recorded successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function clock_out(Request $request)
    {
        $find_absence = Absence::where('user_id', auth()->user()->employee->id)->where('type', 'clock_in')->latest()->first();

        if ($find_absence) {
            try {
                $validate = $request->validate([
                    'end_time' => 'required',
                    // 'lat' => 'required',
                    // 'lng' => 'required',
                    // 'proof_image' => 'required',
                    // 'face_recognition' => 'required'
                ]);

                // // save proof image and face recognition image in storage absences folder
                // $proof_image = $request->file('proof_image');
                // $proof_image_name = time() . '.' . $proof_image->getClientOriginalExtension();
                // Storage::disk('absences')->put($proof_image_name, file_get_contents($proof_image));

                // $face_recognition = $request->file('face_recognition');
                // $face_recognition_name = time() . '.' . $face_recognition->getClientOriginalExtension();
                // Storage::disk('absences')->put($face_recognition_name, file_get_contents($face_recognition));

                $find_absence->update([
                    'type' => 'clock_out',
                    'timestamp' => Carbon::now(),
                    'end_time' => $request->end_time,
                    // 'lat' => $request->lat,
                    // 'lng' => $request->lng,
                    // 'proof_image' => $request->proof_image,
                    // 'face_recognition' => $request->face_recognition
                ]);

                return response()->json(['message' => 'Absence recorded successfully'], 200);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['message' => 'An error occurred'], 500);
            }
        } else {
            return response()->json(['message' => 'You have not clocked in yet'], 400);
        }
    }

    public function forgot_clock_in(Request $request)
    {
        try {
            $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $day = $days[Carbon::parse($request->tanggal)->dayOfWeek];

            $userId = auth()->user()->employee->id;
            $schedule = Schedule::with('shift')
                ->where('day', '=', $day)
                ->where('user_ids', 'like', "%,$userId")
                ->orWhere('user_ids', 'like', "%,$userId,%")
                ->orWhere('user_ids', 'like', "$userId,%")
                ->first();

            // return response()->json(['request' => $request->all(), 'hari' => $day, 'data' => $schedule], 200);

            if (!$schedule) {
                return throw new \Exception('You are not scheduled to work today');
            }

            $userId = auth()->user()->employee->id;
            $face_recognition_name = null;

            $absence = new Absence();
            $absence->user_id = auth()->user()->employee->id;
            $absence->type = 'forgot_clock_in';
            $absence->timestamp = Carbon::now();
            $absence->tanggal = $request->tanggal;
            $absence->lat = $request->lat ?? ''; // optional
            $absence->lng = $request->lng ?? ''; // optional
            $absence->proof_image = $proof_image_name ?? ''; // optional
            $absence->face_recognition = $face_recognition_name ?? ''; // optional
            $absence->start_time = $request->start_time;
            $absence->late = true;
            $absence->save();

            return response()->json(['message' => 'Lupa absen masuk recorded successfully'], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function forgot_clock_out(Request $request)
    {
        $reqTanggal = Carbon::parse($request->tanggal);
        $find_absence = Absence::where('user_id', auth()->user()->employee->id)->where('tanggal', $reqTanggal)->latest()->first();

        if ($find_absence) {
            try {
                $validate = $request->validate([
                    'end_time' => 'required',
                    // 'lat' => 'required',
                    // 'lng' => 'required',
                    // 'proof_image' => 'required',
                    // 'face_recognition' => 'required'
                ]);

                // // save proof image and face recognition image in storage absences folder
                // $proof_image = $request->file('proof_image');
                // $proof_image_name = time() . '.' . $proof_image->getClientOriginalExtension();
                // Storage::disk('absences')->put($proof_image_name, file_get_contents($proof_image));

                // $face_recognition = $request->file('face_recognition');
                // $face_recognition_name = time() . '.' . $face_recognition->getClientOriginalExtension();
                // Storage::disk('absences')->put($face_recognition_name, file_get_contents($face_recognition));

                $find_absence->update([
                    'type' => 'forgot_clock_out',
                    'end_time' => $request->end_time,
                    // 'lat' => $request->lat,
                    // 'lng' => $request->lng,
                    // 'proof_image' => $request->proof_image,
                    // 'face_recognition' => $request->face_recognition
                ]);

                return response()->json(['message' => 'Absence recorded successfully'], 201);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return response()->json(['message' => 'An error occurred'], 500);
            }
        } else {
            return response()->json(['message' => 'You have not clocked in yet'], 400);
        }
    }

    public function checkIsForgotClockIn()
    {
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = $days[Carbon::now()->dayOfWeek];

        $userId = auth()->user()->employee->id;
        $schedule = Schedule::with('shift')->where('day', $day)
            ->whereRaw("user_ids LIKE '%,$userId,%' OR user_ids LIKE '$userId,%' OR user_ids LIKE '%,$userId' OR user_ids = '$userId'")
            ->first();

        if (!$schedule) {
            return throw new \Exception('You are not scheduled to work today');
        }

        $absence = Absence::where('user_id', auth()->user()->employee->id)
            ->whereDate('tanggal', Carbon::today())
            ->where('type', 'forgot_clock_in')
            ->latest()
            ->first();

        if ($absence) {
            return response()->json(['message' => 'You have forgotten to clock in'], 200);
        } else {
            return response()->json(['message' => 'You have clocked in'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
