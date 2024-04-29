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
                        <a class="nav-link active" href="/history">History</a>
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
    <h1 style="margin-left: 30px;">History</h1>
    <form action="{{ route('export.order.history') }}" method="GET">
        <button type="submit" class="btn btn-primary">Export Order History (CSV)</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Pesanan</th>
                <th>Total Harga</th>
                <th>Item Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderHistory as $history)
                <tr>
                    <td>{{ $history->order_id }}</td>
                    <td>Rp. {{ $history->total_price }}</td>
                    <td>
                        <ul>
                            @foreach (json_decode($history->items) as $item)
                                <li>{{ $item->nama }} - Jumlah: {{ $item->jumlah }} - Harga: Rp. {{ $item->harga }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>