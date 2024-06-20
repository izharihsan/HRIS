@extends('template.template', ['title' => 'Attendance', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Detail Attendance</h3>
            {{-- Display employee attendance details using the $absence variable --}}
            <div class="attendance-details">
                <p><strong>Employee Name:</strong> {{ $absence->employee->name }}</p>
                <p><strong>Status Attend:</strong>
                    @if ($absence->type == 'clock_in')
                        <span>Check In</span>
                    @elseif ($absence->type == 'forgot_clock_in')
                        <span>Forgot Check In</span>
                    @elseif ($absence->type == 'clock_out')
                        <span>Check Out</span>
                    @else
                        <span>Forgot Check Out</span>
                    @endif
                    <span class="badge p-1 bg-{{ $absence->late ? 'danger' : 'success' }}">
                        {{ $absence->late ? 'Late' : 'Present' }}
                    </span>
                </p>
                <p><strong>Late:</strong> {{ $absence->late ? 'Yes' : 'No' }}</p>
                <p><strong>Check In Time:</strong> {{ $absence->start_time }}</p>
                <p><strong>Check Out Time:</strong> {{ $absence->end_time }}</p>
                <p><strong>Proof Image:</strong>
                </p>
                @if ($absence->proof_image)
                    <img src="{{ asset('absences/' . $absence->proof_image) }}" alt="Proof Image" class="img-fluid" width="200">
                @endif
                <div class="mt-3"></div>
                <p><strong>Location:</strong></p>
                <div id="map" style="height: 400px;"></div>
                <br>
            </div>
            <a href="{{ route('attendance') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    {{-- Include Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    {{-- Include Leaflet JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the latitude and longitude from the $absence variable
            var lat = {{ $absence->lat }};
            var lng = {{ $absence->lng }};

            // Initialize the map
            var map = L.map('map').setView([lat, lng], 13);

            // Add the tile layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a marker to the map at the given coordinates
            L.marker([lat, lng]).addTo(map)
                .bindPopup('Location of the attendance')
                .openPopup();
        });
    </script>
@endsection
