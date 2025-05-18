@extends('layouts.app')

@section('title', 'Peta Wisata Kota Kendari')

@push('styles')
    <style>
        #map {
            height: 600px;
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.4);
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
    <div class="container">
        <div class="container d-flex justify-content-center" style="padding-top: 100px;">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="mb-2  text-primary">Peta Wisata Kota Kendari</h1>
                    <p class="text-muted">Jelajahi berbagai destinasi wisata menarik di Kota Kendari, Sulawesi Tenggara</p>
                </div>
            </div>
        </div>


        <!-- Filter -->
        <div class="filter-section">
            <form method="GET" action="{{ route('pemetaan.index') }}" class="row g-3">
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

                @if (request('jenis_id') || request('kecamatan_id'))
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
                                @if ($wisata->gambar)
                                    <img src="{{ asset('storage/' . $wisata->gambar) }}" class="card-img-top"
                                        alt="{{ $wisata->nama }}" style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="bg-light text-center py-5">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $wisata->nama }}</h5>
                                    <p class="card-text mb-1"><small class="text-muted">{{ $wisata->jenis->nama }} •
                                            {{ $wisata->kecamatan->nama }}</small></p>
                                    @if ($wisata->rating)
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= round($wisata->rating))
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

            // Colors untuk kecamatan - warna yang berbeda
            const kecamatanColors = {
                'kambu': '#E74C3C', // Merah
                'abeli': '#3498DB', // Biru
                'mandonga': '#2ECC71', // Hijau
                'baruga': '#9B59B6', // Ungu
                'poasia': '#F1C40F', // Kuning
                'kendari': '#1ABC9C', // Tosca
                'kendari_barat': '#00FF00', // Coral (merah muda-oranye)
                'kadia': '#34495E', // Abu gelap
                'wua_wua': '#E91E63', // Pink fanta
                'puuwatu': '#00B894', // Hijau turquoise terang
                'nambo': '#D35400' // Jingga tua
            };



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

            // Legenda untuk jenis wisata
            const legend = L.control({
                position: 'bottomright'
            });
            legend.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'legend');
                div.innerHTML = '<h6>Jenis Wisata</h6>';
                return div;
            };
            legend.addTo(map);

            // Legenda untuk kecamatan
            const kecamatanLegend = L.control({
                position: 'bottomleft'
            });
            kecamatanLegend.onAdd = function(map) {
                const div = L.DomUtil.create('div', 'legend kecamatan-legend');
                div.innerHTML = '<h6>Kecamatan</h6>';
                return div;
            };
            kecamatanLegend.addTo(map);

            // Tambahkan marker untuk setiap tempat wisata
            const markers = [];
            const legendItems = new Set();
            const kecamatanItems = new Set();

            // Kumpulkan semua kecamatan yang unik
            const uniqueKecamatan = {};
            wisataData.forEach(w => {
                if (w.kecamatan && w.kecamatan.id) {
                    uniqueKecamatan[w.kecamatan.id] = w.kecamatan;
                }
            });

            // Layer group untuk semua polygon kecamatan
            const kecamatanLayerGroup = L.layerGroup();

            // Fungsi untuk menambahkan GeoJSON kecamatan
            function addKecamatanGeoJSON(kecamatanName, kecamatanDisplayName, geojsonUrl) {
                fetch(geojsonUrl)
                    .then(response => response.json())
                    .then(data => {
                        // Warna untuk kecamatan
                        const color = kecamatanColors[kecamatanName.toLowerCase()] || '#888888';

                        // Buat layer GeoJSON
                        const kecamatanLayer = L.geoJSON(data, {
                            style: {
                                fillColor: color,
                                weight: 2,
                                opacity: 1,
                                color: 'white',
                                dashArray: '3',
                                fillOpacity: 0.4 // Transparansi 40%
                            }
                        });

                        // Tambahkan popup
                        kecamatanLayer.bindPopup(`<strong>Kecamatan ${kecamatanDisplayName}</strong>`);

                        // Tambahkan ke layer group
                        kecamatanLayerGroup.addLayer(kecamatanLayer);

                        // Tambahkan ke legenda
                        if (!kecamatanItems.has(kecamatanName)) {
                            const legendDiv = document.querySelector('.kecamatan-legend');
                            legendDiv.innerHTML += `
                        <div class="mb-1">
                            <i style="background:${color}"></i>
                            <span>${kecamatanDisplayName}</span>
                        </div>
                    `;
                            kecamatanItems.add(kecamatanName);
                        }

                        // Pastikan layer kecamatan berada di bawah marker
                        kecamatanLayer.bringToBack();
                    })
                    .catch(error => {
                        console.error(`Error loading ${kecamatanName} GeoJSON:`, error);
                    });
            }

            // Tambahkan GeoJSON untuk kecamatan yang ada
            addKecamatanGeoJSON('kambu', 'Kambu', '/geojson/kecamatan_kambu.geojson');
            addKecamatanGeoJSON('abeli', 'Abeli', '/geojson/kecamatan_abeli.geojson');
            addKecamatanGeoJSON('baruga', 'Baruga', '/geojson/kecamatan_baruga.geojson');
            addKecamatanGeoJSON('kadia', 'Kadia', '/geojson/kecamatan_kadia.geojson');
            addKecamatanGeoJSON('kendari_barat', 'Kendari barat', '/geojson/kecamatan_kendari_barat.geojson');
            addKecamatanGeoJSON('kendari', 'Kendari', '/geojson/kecamatan_kendari.geojson');
            addKecamatanGeoJSON('mandonga', 'Mandonga', '/geojson/kecamatan_mandonga.geojson');
            addKecamatanGeoJSON('nambo', 'Nambo', '/geojson/kecamatan_nambo.geojson');
            addKecamatanGeoJSON('poasia', 'Poasia', '/geojson/kecamatan_poasia.geojson');
            addKecamatanGeoJSON('puuwatu', 'Puuwatu', '/geojson/kecamatan_puuwatu.geojson');
            addKecamatanGeoJSON('wua_wua', 'Wua-wua', '/geojson/kecamatan_wua_wua.geojson');

            // Tambahkan kecamatan lain jika ada
            // addKecamatanGeoJSON('nama_kecamatan', 'Nama Display', '/path/to/geojson.geojson');

            // Tambahkan layer group ke peta
            kecamatanLayerGroup.addTo(map);

            // Untuk kecamatan yang tidak memiliki GeoJSON, buat polygon dari titik-titik wisata
            function createRemainingKecamatanPolygons() {
                // Kumpulkan kecamatan yang sudah memiliki GeoJSON
                const existingKecamatanIds = new Set();
                const kecamatanNameToId = {};

                // Pemetaan nama kecamatan ke ID (lowercase untuk perbandingan)
                Object.keys(uniqueKecamatan).forEach(id => {
                    const nama = uniqueKecamatan[id].nama.toLowerCase();
                    kecamatanNameToId[nama] = id;
                });



                // Grup wisata berdasarkan kecamatan
                const kecamatanGroups = {};

                wisataData.forEach(w => {
                    if (w.latitude && w.longitude && w.kecamatan && w.kecamatan.id) {
                        // Lewati kecamatan yang sudah memiliki GeoJSON
                        if (existingKecamatanIds.has(w.kecamatan.id)) {
                            return;
                        }

                        if (!kecamatanGroups[w.kecamatan.id]) {
                            kecamatanGroups[w.kecamatan.id] = {
                                nama: w.kecamatan.nama,
                                points: []
                            };
                        }
                        kecamatanGroups[w.kecamatan.id].points.push([w.latitude, w.longitude]);
                    }
                });

                // Buat polygon sederhana untuk kecamatan yang belum memiliki GeoJSON
                Object.keys(kecamatanGroups).forEach(kecId => {
                    const kecamatan = kecamatanGroups[kecId];
                    const points = kecamatan.points;

                    if (points.length >= 3) { // Minimal 3 titik untuk membuat polygon
                        // Temukan titik tengah/centroid dari semua titik
                        let sumLat = 0,
                            sumLng = 0;
                        points.forEach(point => {
                            sumLat += point[0];
                            sumLng += point[1];
                        });
                        const centerLat = sumLat / points.length;
                        const centerLng = sumLng / points.length;

                        // Cari radius maksimum dari titik tengah ke titik terjauh
                        let maxDistance = 0;
                        points.forEach(point => {
                            const distance = Math.sqrt(
                                Math.pow(point[0] - centerLat, 2) +
                                Math.pow(point[1] - centerLng, 2)
                            );
                            maxDistance = Math.max(maxDistance, distance);
                        });

                        // Tambahkan buffer (20% lebih besar)
                        const bufferDistance = maxDistance * 1.2;

                        // Buat hull/boundary dengan memberikan jarak dari titik tengah
                        const hullPoints = [];
                        const numPoints = Math.max(12, points.length *
                            2); // Minimal 12 titik atau 2x jumlah titik

                        for (let i = 0; i < numPoints; i++) {
                            const angle = (i / numPoints) * 2 * Math.PI;
                            const distanceVariation = bufferDistance * (0.8 + Math.random() *
                                0.4); // 80%-120% dari buffer
                            const lat = centerLat + distanceVariation * Math.cos(angle);
                            const lng = centerLng + distanceVariation * Math.sin(angle);
                            hullPoints.push([lat, lng]);
                        }

                        // Tambahkan titik asli ke hull (untuk memastikan semua titik wisata masuk)
                        points.forEach(point => {
                            hullPoints.push(point);
                        });

                        // Buat konveks hull sederhana
                        const sortedPoints = [...hullPoints].sort((a, b) => a[0] - b[0]);
                        const convexHull = getConvexHull(sortedPoints);

                        // Warna kecamatan (cari berdasarkan nama atau gunakan default)
                        const kecamatanNameLower = kecamatan.nama.toLowerCase().replace(/\s+/g, '_');
                        const color = kecamatanColors[kecamatanNameLower] ||
                            kecamatanColors[kecId] ||
                            '#' + ((1 << 24) * Math.random() | 0).toString(16); // Random color

                        // Buat polygon dengan hull points
                        const polygon = L.polygon(convexHull, {
                            fillColor: color,
                            weight: 2,
                            opacity: 1,
                            color: 'white',
                            dashArray: '3',
                            fillOpacity: 0.4 // Transparansi 40%
                        });

                        // Tambahkan ke layer group
                        kecamatanLayerGroup.addLayer(polygon);

                        polygon.bindPopup(`<strong>Kecamatan ${kecamatan.nama}</strong>`);

                        // Tambahkan ke legenda
                        if (!kecamatanItems.has(kecId)) {
                            const legendDiv = document.querySelector('.kecamatan-legend');
                            legendDiv.innerHTML += `
                        <div class="mb-1">
                            <i style="background:${color}"></i>
                            <span>${kecamatan.nama}</span>
                        </div>
                    `;
                            kecamatanItems.add(kecId);
                        }

                        // Pastikan polygon berada di bawah marker
                        polygon.bringToBack();
                    }
                });
            }

            // Fungsi untuk menghitung Convex Hull dengan algoritma Graham Scan
            function getConvexHull(points) {
                if (points.length < 3) return points;

                // Fungsi untuk menentukan arah 3 titik (CCW > 0, CW < 0, Collinear = 0)
                function orientation(p, q, r) {
                    const val = (q[1] - p[1]) * (r[0] - q[0]) - (q[0] - p[0]) * (r[1] - q[1]);
                    if (val === 0) return 0; // collinear
                    return (val > 0) ? 1 : 2; // clock or counterclock wise
                }

                // Temukan titik dengan y terendah (atau paling kiri jika ada beberapa)
                let minY = points[0][0];
                let minIndex = 0;
                for (let i = 1; i < points.length; i++) {
                    const y = points[i][0];
                    if ((y < minY) || (y === minY && points[i][1] < points[minIndex][1])) {
                        minY = y;
                        minIndex = i;
                    }
                }

                // Tukar titik terendah dengan titik pertama
                [points[0], points[minIndex]] = [points[minIndex], points[0]];

                // Urutkan titik berdasarkan sudut polar relatif terhadap titik terendah
                const p0 = points[0];
                points.sort((a, b) => {
                    const o = orientation(p0, a, b);
                    if (o === 0) {
                        // Jika collinear, ambil yang terdekat dulu
                        return (Math.pow(a[0] - p0[0], 2) + Math.pow(a[1] - p0[1], 2)) -
                            (Math.pow(b[0] - p0[0], 2) + Math.pow(b[1] - p0[1], 2));
                    }
                    return (o === 2) ? -1 : 1;
                });

                // Bangun hull
                const hull = [points[0], points[1]];
                for (let i = 2; i < points.length; i++) {
                    while (hull.length > 1 && orientation(hull[hull.length - 2], hull[hull.length - 1], points[
                            i]) !== 2) {
                        hull.pop();
                    }
                    hull.push(points[i]);
                }

                return hull;
            }

            // Jalankan setelah semua GeoJSON dimuat (tunggu sedikit)
            setTimeout(createRemainingKecamatanPolygons, 1000);

            // Tambahkan marker untuk setiap tempat wisata
            wisataData.forEach(w => {
                if (w.latitude && w.longitude) {
                    // Tetapkan warna untuk jenis wisata
                    if (!jenisColors[w.jenis.id]) {
                        jenisColors[w.jenis.id] = colors[colorIndex % colors.length];
                        colorIndex++;
                    }

                    const markerColor = jenisColors[w.jenis.id];
                    const icon = createMarkerIcon(markerColor);

                    const marker = L.marker([w.latitude, w.longitude], {
                        icon: icon
                    }).addTo(map);

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
            L.control.scale({
                imperial: false,
                metric: true
            }).addTo(map);

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

            // Tambahkan kontrol Layer untuk toggle visibility kecamatan
            const overlayMaps = {
                "Batas Kecamatan": kecamatanLayerGroup
            };

            L.control.layers(null, overlayMaps).addTo(map);

            // Tambahkan CSS style untuk legenda
            const style = document.createElement('style');
            style.innerHTML = `
        .legend {
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
        
        .kecamatan-legend {
            max-height: 200px;
            overflow-y: auto;
        }
    `;
            document.head.appendChild(style);
        });
    </script>
@endpush
