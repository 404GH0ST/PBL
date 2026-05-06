<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Deenhag</title>

    @vite(['resources/css/product-detail.css', 'resources/js/app.js'])
    @vite(['resources/css/product-detail.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<header class="header">
    <div class="container header-wrap">
        <a href="#" class="brand">
            <span class="brand-logo"></span>
            <span>DEENHAG</span>
        </a>

        <nav class="nav">
            <a href="#" class="active">Beranda</a>
            <a href="#">Katalog</a>
            <a href="#">Blog</a>
            <a href="#">Lacak</a>
        </nav>

        <div class="right-menu">
            <div class="theme-toggle">
                <span class="active">☀</span>
                <span>☾</span>
            </div>

            <img class="avatar" src="{{ asset('images/avatar.jpg') }}" alt="Avatar">
        </div>
    </div>
</header>

<main>
    <section class="container product-section">
        <div>
            <img id="mainImage" class="main-product-img" src="{{ asset('images/produk/sablon-kaos-custom.jpg') }}" alt="Sablon Kaos Custom">

            <div class="thumb-list">
                <img class="active" src="{{ asset('images/produk/sablon-kaos-custom.jpg') }}" alt="Thumbnail">
                <img src="{{ asset('images/produk/thumb-1.jpg') }}" alt="Thumbnail">
                <img src="{{ asset('images/produk/thumb-2.jpg') }}" alt="Thumbnail">
                <img src="{{ asset('images/produk/thumb-3.jpg') }}" alt="Thumbnail">
            </div>
        </div>

        <div>
            <p class="category">Kaos</p>

            <h1 class="product-title">Sablon Kaos Custom</h1>

            <div class="rating">
                <div class="stars">★★★★★</div>
                <p class="rating-text">4.9 &nbsp; (1.2K Reviews)</p>
            </div>

            <div class="price">
                <span class="new">Rp. 50.999</span>
                <span class="old">Rp. 100.000</span>
            </div>

            <p class="desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.
            </p>

            <p class="option-title">Ukuran</p>
            <div class="option-list">
                <button>A6</button>
                <button>A5</button>
                <button>A4</button>
                <button>A3</button>
                <button>A5+A5</button>
                <button>A4+A4</button>
                <button>A4+A3</button>
                <button>A3+A3</button>
                <button>Logo + Nama</button>
            </div>

            <p class="option-title">Size</p>
            <div class="option-list">
                <button>XS - XL</button>
                <button>XXL</button>
            </div>

            <div class="buy-row">
                <div class="qty">
                    <button type="button" onclick="minusQty()">-</button>
                    <span id="qtyValue">1</span>
                    <button type="button" onclick="addQty()">+</button>
                </div>

                <button class="btn-buy">Beli Sekarang</button>
            </div>

            <div class="product-meta">
                <p><b>SKU:</b> FH27634571267253G</p>
                <p><b>Tags:</b> Kaos, Sablon, DTF</p>
            <p>
                <b>Share:</b>
                <span class="share">
                    <a href="#" class="share-icon facebook" aria-label="Share ke Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#" class="share-icon tiktok" aria-label="Share ke TikTok">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>

                    <a href="#" class="share-icon instagram" aria-label="Share ke Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>

                    <a href="#" class="share-icon whatsapp" aria-label="Share ke WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </span>
            </p>
            </div>
        </div>
    </section>

    <section class="container tabs-section">
        <div class="tabs">
            <button class="tab-btn" type="button" data-tab="deskripsi">Deskripsi</button>
            <button class="tab-btn" type="button" data-tab="informasi">Informasi Tambahan</button>
            <button class="tab-btn active" type="button" data-tab="reviews">Reviews</button>
        </div>

        <div class="tab-content" id="deskripsi">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>

            <br>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.
            </p>

            <ul>
                <li>➜ 100% Lorem ipsum dolor sit amet</li>
                <li>➜ Consectur adipisicing elit</li>
                <li>➜ Ut enim ad minim veniam</li>
                <li>➜ Cras laoreet lacus in dui posuere fringita</li>
            </ul>
        </div>

        <div class="tab-content active" id="informasi">
            <div class="info-table">
                <div class="info-row info-head">
                    <div>Atribut</div>
                    <div>Detail</div>
                </div>

                <div class="info-row">
                    <div>Bahan</div>
                    <div>Katun Combed 30s</div>
                </div>

                <div class="info-row">
                    <div>Garis Leher</div>
                    <div>Round Neck</div>
                </div>

                <div class="info-row">
                    <div>Jenis Kulit</div>
                    <div>Nyaman untuk kulit sensitif</div>
                </div>

                <div class="info-row">
                    <div>Jenis Atasan</div>
                    <div>Kaos Custom</div>
                </div>

                <div class="info-row">
                    <div>Motif</div>
                    <div>Sablon Custom DTF</div>
                </div>
            </div>
        </div>

        <div class="tab-content active" id="reviews">
            <div class="review-wrapper">
                <div class="review-overview">
                    <div class="review-score">
                        <div class="score-line">
                            <span class="score-number">4.9</span>
                            <span class="score-text">Dari 5</span>
                        </div>

                        <div class="review-stars">★★★★★</div>
                        <p>(1.2K Reviews)</p>
                    </div>

                    <div class="rating-bars">
                        <div class="rating-row">
                            <span>5 Bintang</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="--value: 92%;"></div>
                            </div>
                        </div>

                        <div class="rating-row">
                            <span>4 Bintang</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="--value: 13%;"></div>
                            </div>
                        </div>

                        <div class="rating-row">
                            <span>3 Bintang</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="--value: 10%;"></div>
                            </div>
                        </div>

                        <div class="rating-row">
                            <span>2 Bintang</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="--value: 7%;"></div>
                            </div>
                        </div>

                        <div class="rating-row">
                            <span>1 Bintang</span>
                            <div class="bar-track">
                                <div class="bar-fill" style="--value: 5%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-list-header">
                    <div>
                        <h3>Review List</h3>
                        <p id="reviewCountInfo">Menampilkan dari 1-3 dari 1.2K hasil</p>
                    </div>

                    <label>
                        Urutkan berdasarkan:
                        <select>
                            <option>Terbaru</option>
                            <option>Terlama</option>
                            <option>Rating tertinggi</option>
                        </select>
                    </label>
                </div>

                <div class="review-list" id="reviewList">
                    <article class="review-item">
                        <div class="review-user-row">
                            <div class="review-user">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Ajeng Febria">
                                <strong>Ajeng Febria</strong>
                            </div>

                            <span class="review-date">1 bulan yang lalu</span>
                        </div>

                        <div class="review-body">
                            <h4>Saya sangat menyukai produk ini!</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>

                            <div class="review-rating">
                                <span>★★★★★</span>
                                <small>5.0</small>
                            </div>
                        </div>
                    </article>

                    <article class="review-item">
                        <div class="review-user-row">
                            <div class="review-user">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Fahrul Kz">
                                <strong>Fahrul Kz</strong>
                            </div>

                            <span class="review-date">2 Bulan yang lalu</span>
                        </div>

                        <div class="review-body">
                            <h4>Saya sangat menyukai produk ini!</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>

                            <div class="review-rating">
                                <span>★★★★★</span>
                                <small>5.0</small>
                            </div>
                        </div>
                    </article>

                    <article class="review-item">
                        <div class="review-user-row">
                            <div class="review-user">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Jefri Nichol">
                                <strong>Jefri Nichol</strong>
                            </div>

                            <span class="review-date">2 Bulan yang lalu</span>
                        </div>

                        <div class="review-body">
                            <h4>Saya sangat menyukai produk ini!</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>

                            <div class="review-rating">
                                <span>★★★★★</span>
                                <small>5.0</small>
                            </div>
                        </div>
                    </article>

                    <article class="review-item is-hidden">
                        <div class="review-user-row">
                            <div class="review-user">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Ajeng Febria">
                                <strong>Ajeng Febria</strong>
                            </div>

                            <span class="review-date">1 bulan yang lalu</span>
                        </div>

                        <div class="review-body">
                            <h4>Saya sangat menyukai produk ini!</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                            </p>

                            <div class="review-rating">
                                <span>★★★★★</span>
                                <small>5.0</small>
                            </div>
                        </div>
                    </article>

                    <article class="review-item is-hidden">
                        <div class="review-user-row">
                            <div class="review-user">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Fahrul Kz">
                                <strong>Fahrul Kz</strong>
                            </div>

                            <span class="review-date">2 Bulan yang lalu</span>
                        </div>

                        <div class="review-body">
                            <h4>Saya sangat menyukai produk ini!</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit.
                            </p>

                            <div class="review-rating">
                                <span>★★★★★</span>
                                <small>5.0</small>
                            </div>
                        </div>
                    </article>

                    <article class="review-item is-hidden">
                        <div class="review-user-row">
                            <div class="review-user">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Jefri Nichol">
                                <strong>Jefri Nichol</strong>
                            </div>

                            <span class="review-date">2 Bulan yang lalu</span>
                        </div>

                        <div class="review-body">
                            <h4>Saya sangat menyukai produk ini!</h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>

                            <div class="review-rating">
                                <span>★★★★★</span>
                                <small>5.0</small>
                            </div>
                        </div>
                    </article>
                </div>

                <button class="review-toggle-btn" id="reviewToggleBtn" type="button" aria-label="Lihat review lainnya">
                    <span class="chevron-icon"></span>
                </button>
            </div>
        </div>
    </section>

    <section class="container recommendation">
        <h2 class="section-title">Rekomendasi Produk</h2>

        <div class="product-grid">
            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-1.jpg') }}" alt="Sablon Kaos Custom">
                <div class="card-top">
                    <span>Kaos</span>
                    <span class="rating-card">
                    <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Sablon Kaos Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 50.999</span>
                    <span class="old">Rp. 100.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-2.jpg') }}" alt="Cetak DTF Setrika Kaos">
                <div class="card-top">
                    <span>DTF</span>
                    <span class="rating-card">
                    <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Cetak DTF Setrika Kaos</h3>
                <div class="card-price">
                    <span class="new">Rp. 50.999</span>
                    <span class="old">Rp. 100.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-3.jpg') }}" alt="Banner Custom">
                <div class="card-top">
                    <span>Kaos</span>
                    <span class="rating-card">
                    <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Banner Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 50.999</span>
                    <span class="old">Rp. 100.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-4.jpg') }}" alt="Tripod Banner">
                <div class="card-top">
                    <span>Kaos</span>
                    <span class="rating-card">
                    <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Tripod Banner</h3>
                <div class="card-price">
                    <span class="new">Rp. 50.999</span>
                    <span class="old">Rp. 100.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-1.jpg') }}" alt="Sablon Hoodie Custom">
                <div class="card-top">
                    <span>Hoodie</span>
                    <span class="rating-card">
                        <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Sablon Hoodie Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 85.999</span>
                    <span class="old">Rp. 150.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-2.jpg') }}" alt="Stiker Custom">
                <div class="card-top">
                    <span>Stiker</span>
                    <span class="rating-card">
                        <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Stiker Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 25.999</span>
                    <span class="old">Rp. 50.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-3.jpg') }}" alt="X Banner Custom">
                <div class="card-top">
                    <span>Banner</span>
                    <span class="rating-card">
                        <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">X Banner Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 75.999</span>
                    <span class="old">Rp. 120.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-4.jpg') }}" alt="Totebag Custom">
                <div class="card-top">
                    <span>Totebag</span>
                    <span class="rating-card">
                        <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Totebag Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 35.999</span>
                    <span class="old">Rp. 70.000</span>
                </div>
            </article>

            <article class="product-card">
                <img src="{{ asset('images/produk/rekomendasi-1.jpg') }}" alt="Polo Custom">
                <div class="card-top">
                    <span>Polo</span>
                    <span class="rating-card">
                        <span class="star-icon">★</span>
                        <span class="rating-number">5.0</span>
                    </span>
                </div>
                <h3 class="card-title">Polo Custom</h3>
                <div class="card-price">
                    <span class="new">Rp. 65.999</span>
                    <span class="old">Rp. 110.000</span>
                </div>
            </article>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">
                    <span class="brand-logo"></span>
                    <span>Deenhag</span>
                </div>

                <p>
                    Kami melayani kebutuhan konveksi dan digital printing untuk personal,
                    komunitas, maupun bisnis, mulai dari apparel custom, media promosi,
                    hingga kebutuhan cetak usaha dengan kualitas yang rapi dan terpercaya.
                </p>

                <div class="social">
                    <span>f</span>
                    <span>t</span>
                    <span>♪</span>
                    <span>◎</span>
                </div>
            </div>

            <div>
                <h4>Navigasi Cepat</h4>
                <ul>
                    <li>Beranda</li>
                    <li>Katalog</li>
                    <li>Blog</li>
                    <li>Keranjang</li>
                    <li>Lacak Pesanan</li>
                </ul>
            </div>

            <div>
                <h4>Layanan Kami</h4>
                <ul>
                    <li>Konveksi Apparel</li>
                    <li>Media Promosi</li>
                    <li>Cetak DTF</li>
                    <li>Kebutuhan Bisnis</li>
                </ul>
            </div>

            <div>
                <h4>Hubungi Kami</h4>
                <ul>
                    <li>☏ +62 23456789123</li>
                    <li>✉ deenhag@gmail.com</li>
                    <li>⌖ Ponorogo, Indonesia</li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            © 2026 Deenhag. All rights reserved.
        </div>
    </div>
</footer>

<script>
    const thumbnails = document.querySelectorAll('.thumb-list img');
    const mainImage = document.getElementById('mainImage');
    const qtyValue = document.getElementById('qtyValue');

    thumbnails.forEach((thumb) => {
        thumb.addEventListener('click', function () {
            thumbnails.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.src;
        });
    });

    function addQty() {
        qtyValue.textContent = Number(qtyValue.textContent) + 1;
    }

    function minusQty() {
        const currentQty = Number(qtyValue.textContent);

        if (currentQty > 1) {
            qtyValue.textContent = currentQty - 1;
        }
    }

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const targetTab = this.dataset.tab;

            tabButtons.forEach((btn) => btn.classList.remove('active'));
            tabContents.forEach((content) => content.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });

    const reviewToggleBtn = document.getElementById('reviewToggleBtn');
    const reviewList = document.getElementById('reviewList');
    const reviewCountInfo = document.getElementById('reviewCountInfo');

    if (reviewToggleBtn && reviewList && reviewCountInfo) {
        reviewToggleBtn.addEventListener('click', function () {
            const isOpen = reviewList.classList.toggle('show-all');

            this.classList.toggle('active', isOpen);

            reviewCountInfo.textContent = isOpen
                ? 'Menampilkan dari 1-6 dari 1.2K hasil'
                : 'Menampilkan dari 1-3 dari 1.2K hasil';
        });
    }
</script>

</body>
</html>