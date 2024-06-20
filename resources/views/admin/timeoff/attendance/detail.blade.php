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
                <p><strong>Radius (km): </strong> <span id="radiusKm"></span></p>
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

        function degrees_to_radians(degrees) {
            // Store the value of pi.
            var pi = Math.PI;
            // Multiply degrees by pi divided by 180 to convert to radians.
            return degrees * (pi / 180);
        }

        var lat1 = {{ $absence->lat }};
        var lng1 = {{ $absence->lng }};
        var lat2 = {{ $absence->employee->branch->lat }};
        var lng2 = {{ $absence->employee->branch->long }};

        // Calculate the distance between two points
        var R = 6371; // Radius of the earth in km
        var dLat = degrees_to_radians(lat2 - lat1);
        var dLon = degrees_to_radians(lng2 - lng1);
        var lat1 = degrees_to_radians(lat1);
        var lat2 = degrees_to_radians(lat2);

        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c; // Distance in km

        // Display the distance between two points
        document.getElementById('radiusKm').innerHTML = d.toFixed(2) + ' km';
    </script>
@endsection
