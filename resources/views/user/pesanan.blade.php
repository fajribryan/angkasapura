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
                    <a class="nav-link active" href="/pesanan" style="font-size: 16px;">Pesanan</a>
                </li>
            </ul>
            <div class="dropdown">
            <a class="navbar-brand" href="/login" style="font-size:16px;">Login</a>
            <a class="navbar-brand" href="/register" style="font-size:16px;">Register</a>
        </div>
    </nav>
</head>
<body>
    <h1 style="margin-left: 30px;">Pesanan</h1>
    @foreach($orders as $order)
        <div>
            <h3>Nomor Pesanan: {{ $order->id }}</h3>
            <p>Total Harga: Rp. {{ $order->total_price }}</p>
            <h4>Item Pesanan:</h4>
            <ul>
                @foreach(json_decode($order->items) as $item)
                    <li>{{ $item->nama }} - Jumlah: {{ $item->jumlah }} - Harga: Rp. {{ $item->harga }}</li>
                @endforeach
            </ul>
        </div>
        <hr>
    @endforeach
</body>