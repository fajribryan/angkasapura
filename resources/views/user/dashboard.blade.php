<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Angkasa Pura Resto</title>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Angkasa Pura Resto</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/keranjang" style="font-size: 16px;">Keranjang</a>
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
                flex: 0 0 25%;
                max-width: 25%;
                box-sizing: border-box;
                padding: 0 10px;
                margin-bottom: 20px;
            }

            @media (max-width: 992px) {
                .menu-item {
                    flex: 0 0 50%;
                    max-width: 50%;
                }
            }

            @media (max-width: 576px) {
                .menu-item {
                    flex: 0 0 100%;
                    max-width: 100%;
                }
            }

            .card-img-top {
                width: 100%;
                height: 200px; /* Atur tinggi sesuai kebutuhan */
                object-fit: cover;
            }
    </style>
</head>

<body>
    <div class="row mt-5">
        <div class="col-12">
            <div class="menu-container">
                @foreach ($menus as $index => $menu)
                    <div class="menu-item">
                        <div class="card mb-3">
                            <img src="{{ asset('images/' . $menu->fotomenu) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->nama }}</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $menu->id }}">
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal-{{ $menu->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $menu->nama }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('images/' . $menu->fotomenu) }}" alt="" style="max-width: 100%; max-height: 300px; object-fit: contain; margin-bottom: 20px;">
                                    <h5>{{ $menu->detailmenu }}</h5>
                                    <h3>Rp. {{ $menu->hargamenu }}</h3>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <form action="{{ route('add.menu', ['id' => $menu->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            Tambah Menu
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (($index + 1) % 4 == 0)
                        <div class="w-100"></div> <!-- Pindah ke baris baru setelah 4 menu -->
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</body>
