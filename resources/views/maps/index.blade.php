@extends('layouts.app')

@section('title', 'Peta Wisata Kota Kendari')

@push('styles')
    <style>
        #map {
            height: 600px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .leaflet-popup-content {
            margin: 0;
            padding: 0;
        }
        .popup-card {
            width: 250px;
        }
        .popup-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px 5px 0 0;
        }
        .popup-content {
            padding: 10px;
        }
        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .legend {
            background: white;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.4);
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-2">Peta Wisata Kota Kendari</h1>
            <p class="text-muted">Jelajahi berbagai destinasi wisata menarik di Kota Kendari, Sulawesi Tenggara</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="filter-section">
        <form method="GET" class="row g-3">
            <div class="col-md-5">
                <label for="jenis_id" class="form-label">Jenis Wisata</label>
                <select name="jenis_id" id="jenis_id" class="form-select">
                    <option value="">-- Semua Jenis Wisata --</option>
                    @foreach ($jenis_wisata as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenis_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="kecamatan_id" class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" class="form-select">
                    <option value="">-- Semua Kecamatan --</option>
                    @foreach ($daftar_kecamatan as $kec)
                        <option value="{{ $kec->id }}" {{ request('kecamatan_id') == $kec->id ? 'selected' : '' }}>
                            {{ $kec->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Terapkan</button>
            </div>
            @if(request('jenis_id') || request('kecamatan_id'))
                <div class="col-12">
                    <a href="{{ route('pemetaan.index') }}" class="btn btn-sm btn-outline-secondary">Reset Filter</a>
                </div>
            @endif
        </form>
    </div>

    <!-- Map -->
    <div class="card mb-4">
        <div class="card-body p-0">
            <div id="map"></div>
        </div>
    </div>

    <!-- Wisata List Preview -->
    <div class="row mt-4">
        <div class="col-12">
            <h3>Tempat Wisata Terpopuler</h3>
            <div class="row">
                @forelse($daftar_wisata->take(3) as $wisata)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($wisata->gambar)
                                <img src="{{ asset('storage/' . $wisata->gambar) }}" class="card-img-top" alt="{{ $wisata->nama }}" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light text-center py-5">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $wisata->nama }}</h5>
                                <p class="card-text mb-1"><small class="text-muted">{{ $wisata->jenis->nama }} • {{ $wisata->kecamatan->nama }}</small></p>
                                @if($wisata->rating)
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($wisata->rating))
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1">{{ $wisata->rating }}/5</span>
                                    </div>
                                @endif
                                <p class="card-text">{{ Str::limit($wisata->deskripsi, 100) }}</p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Tidak ada tempat wisata yang ditemukan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Font Awesome untuk ikon rating -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi peta dengan koordinat Kota Kendari
            const map = L.map('map').setView([-3.9674, 122.5947], 12);

            // Tambahkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            // Data tempat wisata
            const wisataData = @json($daftar_wisata);

            // Buat objek untuk menyimpan jenis dan warna marker
            const jenisColors = {};
            let colorIndex = 0;
            const colors = ['#FF5733', '#33A8FF', '#33FF57', '#FF33F6', '#F6FF33', '#8C33FF', '#FF8C33'];

            // Icon default dan warna-warna marker
            const createMarkerIcon = (color) => {
                return L.divIcon({
                    className: 'custom-marker',
                    html: `<svg width="24" height="36" viewBox="0 0 24 36">
                              <path fill="${color}" d="M12 0C5.4 0 0 5.4 0 12c0 7.2 12 24 12 24s12-16.8 12-24c0-6.6-5.4-12-12-12z"/>
                              <circle fill="white" cx="12" cy="12" r="5"/>
                          </svg>`,
                    iconSize: [24, 36],
                    iconAnchor: [12, 36],
                    popupAnchor: [0, -36]
                });
            };

            // Legenda
            const legend = L.control({position: 'bottomright'});
            legend.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'legend');
                div.innerHTML = '<h6>Jenis Wisata</h6>';
                return div;
            };
            legend.addTo(map);

            // Tambahkan marker untuk setiap tempat wisata
            const markers = [];
            const legendItems = new Set();

            wisataData.forEach(w => {
                if (w.latitude && w.longitude) {
                    // Tetapkan warna untuk jenis wisata
                    if (!jenisColors[w.jenis.id]) {
                        jenisColors[w.jenis.id] = colors[colorIndex % colors.length];
                        colorIndex++;
                    }

                    const markerColor = jenisColors[w.jenis.id];
                    const icon = createMarkerIcon(markerColor);

                    const marker = L.marker([w.latitude, w.longitude], {icon: icon}).addTo(map);

                    // Tambahkan jenis wisata ke legenda
                    if (!legendItems.has(w.jenis.id)) {
                        const legendDiv = document.querySelector('.legend');
                        legendDiv.innerHTML += `
                            <div class="mb-1">
                                <i style="background:${markerColor}"></i>
                                <span>${w.jenis.nama}</span>
                            </div>
                        `;
                        legendItems.add(w.jenis.id);
                    }

                    // Popup konten
                    const popupHtml = `
                        <div class="popup-card">
                            ${w.gambar ? `<img src="/storage/${w.gambar}" alt="${w.nama}" onerror="this.onerror=null;this.src='/images/no-image.jpg';">` : ''}
                            <div class="popup-content">
                                <h6 class="mb-2">${w.nama}</h6>
                                <div class="mb-2">
                                    <small><strong>Jenis:</strong> ${w.jenis.nama}</small><br>
                                    <small><strong>Kecamatan:</strong> ${w.kecamatan.nama}</small><br>
                                    <small><strong>Alamat:</strong> ${w.alamat}</small><br>
                                    <small><strong>Rating:</strong> ${w.rating ? w.rating + '/5' : '-'}</small>
                                </div>
                                <a href="{{ url('/pariwisata') }}/${w.id}" class="btn btn-sm btn-primary w-100 mt-2">Lihat Detail</a>
                            </div>
                        </div>
                    `;

                    marker.bindPopup(popupHtml, {
                        closeButton: true,
                        maxWidth: 250,
                        minWidth: 250
                    });

                    markers.push(marker);
                }
            });

            // Jika ada marker, atur tampilan peta
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            } else {
                // Jika tidak ada marker, tetap di pusat Kendari
                map.setView([-3.9674, 122.5947], 12);
            }

            // Tambahkan kontrol skala
            L.control.scale({imperial: false, metric: true}).addTo(map);

            // Tambahkan tombol lokasi saya
            L.control.locate({
                position: 'topright',
                strings: {
                    title: "Lokasi Saya"
                },
                locateOptions: {
                    enableHighAccuracy: true
                }
            }).addTo(map);
        });
    </script>
@endpush
