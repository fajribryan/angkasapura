<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Angkasa Pura Resto</title>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboardadmin">Angkasa Pura Resto</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/history">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/listadmin">User</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black;font-family: Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px; margin-left:4px;">
                  {{ auth()->user()->nama }}
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"  style="color:rgb(0, 0, 0);font-family: Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px;">Logout </button>
                      </form>
                    </li>
                  </ul>
                </div>  
            
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
            @if (!$order->completed)
                <form action="{{ route('orders.complete', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Tandai Selesai</button>
                </form>
            @else
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Pesanan</button>
                </form>
            @endif
        </div>
        <hr>
    @endforeach
</body>
