<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absence;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AttendanceCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'proof_image' => 'required',
                'face_recognition' => 'required'
            ]);

            // save proof image and face recognition image in storage absences folder
            $proof_image = $request->file('proof_image');
            $proof_image_name = time() . '.' . $proof_image->getClientOriginalExtension();
            Storage::disk('absences')->put($proof_image_name, file_get_contents($proof_image));

            $face_recognition = $request->file('face_recognition');
            $face_recognition_name = time() . '.' . $face_recognition->getClientOriginalExtension();
            Storage::disk('absences')->put($face_recognition_name, file_get_contents($face_recognition));

            $absence = new Absence();
            $absence->user_id = auth()->user()->id;
            $absence->type = 'clock_in';
            $absence->timestamp = Carbon::now();
            $absence->lat = $request->lat;
            $absence->lng = $request->lng;
            $absence->proof_image = $request->proof_image;
            $absence->face_recognition = $request->face_recognition;
            $absence->save();
            return response()->json(['message' => 'Absence recorded successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function clock_out(Request $request)
    {
        $find_absence = Absence::where('user_id', auth()->user()->id)->where('type', 'clock_in')->latest()->first();

        if ($find_absence) {
            try {
                $validate = $request->validate([
                    'lat' => 'required',
                    'lng' => 'required',
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
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    // 'proof_image' => $request->proof_image,
                    // 'face_recognition' => $request->face_recognition
                ]);

                return response()->json(['message' => 'Absence recorded successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'An error occurred'], 500);
            }
        } else {
            return response()->json(['message' => 'You have not clocked in yet'], 400);
        }
    }

    public function forgot_clock_in(Request $request)
    {
    }
    public function forgot_clock_out(Request $request)
    {
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