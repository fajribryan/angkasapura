<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Angkasa Pura Resto</title>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Angkasa Pura Resto</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/keranjang" style="font-size: 16px;">Keranjang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pesanan" style="font-size: 16px;">Pesanan</a>
                </li>
            </ul>
            <div class="dropdown">
            <a class="navbar-brand" href="/login" style="font-size:16px;">Login</a>
            <a class="navbar-brand" href="/register" style="font-size:16px;">Register</a>
        </div>
    </nav>
    <style>
        .menu-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .menu-item {
            flex: 0 0 calc(25% - 20px); /* Atur lebar card dengan margin antara card */
            max-width: calc(25% - 20px); /* Atur lebar maksimum card */
            box-sizing: border-box;
            margin-right: 20px; /* Atur margin kanan antara card */
            margin-bottom: 20px; /* Atur margin bawah untuk memisahkan card */
            padding: 10px;
        }

        @media (max-width: 992px) {
            .menu-item {
                flex: 0 0 calc(33.33% - 20px); /* Mengubah lebar card pada layar medium */
                max-width: calc(33.33% - 20px);
            }
        }

        @media (max-width: 768px) {
            .menu-item {
                flex: 0 0 calc(50% - 20px); /* Mengubah lebar card pada layar kecil */
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .menu-item {
                flex: 0 0 calc(100% - 20px); /* Mengubah lebar card pada layar sangat kecil */
                max-width: calc(100% - 20px);
                margin-right: 0; /* Hapus margin kanan pada layar sangat kecil */
            }
        }

        .card-img-top {
            width: 100%;
            height: 200px; /* Atur tinggi gambar sesuai kebutuhan */
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1 style="margin-left: 30px;">Isi Keranjang</h1>
    <div class="row mt-5">
        <div class="col-12">
            <div class="menu-container">
                @foreach($keranjang as $item)
                    <div class="menu-item">
                            <div class="card mb-3">
                                @if (array_key_exists('fotomenu', $item))
                                    <img src="{{ asset('images/' . $item['fotomenu']) }}" class="card-img-top" alt="...">
                                @else
                                    <p>Gambar tidak tersedia</p>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item['nama'] }} | Rp. {{ $item['harga'] }}</h5>
                                    <p>Jumlah: {{ $item['jumlah'] }}</p>
                                    <form action="{{ route('keranjang.tambah', $item['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </form>
                                    <form action="{{ route('keranjang.kurangi', $item['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Kurangi</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 text-center">
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Checkout</button>
            </form>
        </div>
    </div>
</body>