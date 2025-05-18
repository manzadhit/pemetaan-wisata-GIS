@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">


                    <h1 class="hero-title mb-4">Sistem Informasi Pemetaan Tempat Wisata di Kota
                        Kendari</h1>

                    <p class="hero-description mb-4">Selamat Datang di Sistem Informasi Pemetaan Tempat Wisata di
                        Kota
                        Kendari. Temukan informasi tempat wisata menarik di Kota Kendari secara interaktif!</p>

                    <div class="cta-wrapper">
                        <a href="#" class="btn btn-primary">Lihat Peta Wisata</a>
                        <a href="#" class="btn btn-success">Daftar Wisata</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image">
                        <img src="{{ asset('assets/img/hero_kmi.png') }}" alt="Business Growth" class="img-fluid"
                            loading="lazy">
                    </div>
                </div>
            </div>
            <div class="row feature-boxes">
                <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon me-sm-4 mb-3 mb-sm-0">
                            📍
                        </div>
                        <div class="feature-content">
                            <h4> Pemetaan Interaktif</h4>
                            <p>Lihat lokasi wisata langsung di peta dengan filter berdasarkan jenis dan wilayah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon me-sm-4 mb-3 mb-sm-0">
                            📋
                        </div>
                        <div class="feature-content">
                            <h4> Data Lengkap</h4>
                            <p>Akses informasi detail tentang destinasi wisata favorit di sekitarmu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon me-sm-4 mb-3 mb-sm-0">
                            ⭐
                        </div>
                        <div class="feature-content">
                            <h4> Penilaian & Rating</h4>
                            <p>Lihat rating wisata dari pengunjung lain untuk menentukan pilihan terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Hero Section -->
    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Keunggulan</h2>
            <p>Website Kami memiliki beberapa keunggulan diantaranya sebagai berikut</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row justify-content-center g-5">

                <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <div class="service-content">
                            <h3>Custom Web Development</h3>
                            <p>Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla quis lorem ut
                                libero malesuada feugiat. Curabitur non nulla sit amet nisl tempus convallis. Lorem
                                ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <a href="#" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-left" data-aos-delay="100">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-phone-fill"></i>
                        </div>
                        <div class="service-content">
                            <h3>Mobile App Solutions</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna
                                justo, lacinia eget consectetur sed. Quisque velit nisi, pretium ut lacinia in,
                                elementum id enim. Donec rutrum congue leo eget malesuada.</p>
                            <a href="#" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-palette2"></i>
                        </div>
                        <div class="service-content">
                            <h3>UI/UX Design</h3>
                            <p>Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                vehicula elementum sed sit amet dui.</p>
                            <a href="#" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-bar-chart-line"></i>
                        </div>
                        <div class="service-content">
                            <h3>Digital Marketing</h3>
                            <p>Donec rutrum congue leo eget malesuada. Mauris blandit aliquet elit, eget tincidunt
                                nibh pulvinar a. Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui
                                posuere blandit.</p>
                            <a href="#" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-right" data-aos-delay="300">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-cloud-check"></i>
                        </div>
                        <div class="service-content">
                            <h3>Cloud Computing</h3>
                            <p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Vivamus
                                magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut
                                libero malesuada feugiat.</p>
                            <a href="#" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-md-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <div class="service-content">
                            <h3>Cybersecurity Solutions</h3>
                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Donec
                                sollicitudin molestie malesuada. Curabitur arcu erat, accumsan id imperdiet et.
                                Proin eget tortor risus.</p>
                            <a href="#" class="service-link">
                                <span>Learn More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Services Section -->
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Wisata Favorit</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente excepturi expedita possimus? Ipsam
                quia veritatis ex sint autem excepturi pariatur id magni culpa impedit! Aperiam consectetur modi id
                accusantium earum!</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <div class="portfolio-filters-container" data-aos="fade-up" data-aos-delay="200">
                    <ul class="portfolio-filters isotope-filters">
                        <li data-filter="*" class="filter-active">All Work</li>
                        <li data-filter=".filter-web">Web Design</li>
                        <li data-filter=".filter-graphics">Graphics</li>
                        <li data-filter=".filter-motion">Motion</li>
                        <li data-filter=".filter-brand">Branding</li>
                    </ul>
                </div>

                <div class="row g-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
                        <div class="portfolio-card">
                            <div class="portfolio-image">
                                <img src="{{ asset('assets/img/portfolio/portfolio-1.webp') }}" class="img-fluid"
                                    alt="" loading="lazy">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-actions">
                                        <a href="{{ asset('assets/img/portfolio/portfolio-1.webp') }}"
                                            class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="portfolio-details.html" class="details-link"><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <span class="category">Web Design</span>
                                <h3>Modern Dashboard Interface</h3>
                                <p>Maecenas faucibus mollis interdum sed posuere consectetur est at lobortis.</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-graphics">
                        <div class="portfolio-card">
                            <div class="portfolio-image">
                                <img src="{{ asset('assets/img/portfolio/portfolio-10.webp') }}" class="img-fluid"
                                    alt="" loading="lazy">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-actions">
                                        <a href="{{ asset('assets/img/portfolio/portfolio-10.webp') }}"
                                            class="glightbox preview-link" data-gallery="portfolio-gallery-graphics"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="portfolio-details.html" class="details-link"><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <span class="category">Graphics</span>
                                <h3>Creative Brand Identity</h3>
                                <p>Vestibulum id ligula porta felis euismod semper at vulputate.</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-motion">
                        <div class="portfolio-card">
                            <div class="portfolio-image">
                                <img src="{{ asset('assets/img/portfolio/portfolio-7.webp') }}" class="img-fluid"
                                    alt="" loading="lazy">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-actions">
                                        <a href="{{ asset('assets/img/portfolio/portfolio-7.webp') }}"
                                            class="glightbox preview-link" data-gallery="portfolio-gallery-motion"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="portfolio-details.html" class="details-link"><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <span class="category">Motion</span>
                                <h3>Product Animation Reel</h3>
                                <p>Donec ullamcorper nulla non metus auctor fringilla dapibus.</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-brand">
                        <div class="portfolio-card">
                            <div class="portfolio-image">
                                <img src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}" class="img-fluid"
                                    alt="" loading="lazy">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-actions">
                                        <a href="{{ asset('assets/img/portfolio/portfolio-4.webp') }}"
                                            class="glightbox preview-link" data-gallery="portfolio-gallery-brand"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="portfolio-details.html" class="details-link"><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <span class="category">Branding</span>
                                <h3>Luxury Brand Package</h3>
                                <p>Aenean lacinia bibendum nulla sed consectetur elit.</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-web">
                        <div class="portfolio-card">
                            <div class="portfolio-image">
                                <img src="{{ asset('assets/img/portfolio/portfolio-2.webp') }}" class="img-fluid"
                                    alt="" loading="lazy">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-actions">
                                        <a href="{{ asset('assets/img/portfolio/portfolio-2.webp') }}"
                                            class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="portfolio-details.html" class="details-link"><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <span class="category">Web Design</span>
                                <h3>E-commerce Platform</h3>
                                <p>Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-6 col-md-6 portfolio-item isotope-item filter-graphics">
                        <div class="portfolio-card">
                            <div class="portfolio-image">
                                <img src="{{ asset('assets/img/portfolio/portfolio-11.webp') }}" class="img-fluid"
                                    alt="" loading="lazy">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-actions">
                                        <a href="{{ asset('assets/img/portfolio/portfolio-11.webp') }}"
                                            class="glightbox preview-link" data-gallery="portfolio-gallery-graphics"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="portfolio-details.html" class="details-link"><i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-content">
                                <span class="category">Graphics</span>
                                <h3>Digital Art Collection</h3>
                                <p>Cras mattis consectetur purus sit amet fermentum.</p>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->

                </div><!-- End Portfolio Container -->

            </div>

        </div>

    </section><!-- /Portfolio Section -->

@endsection
