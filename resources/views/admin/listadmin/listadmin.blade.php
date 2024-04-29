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
                        <a class="nav-link active" href="/listadmin">User</a>
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
    
    <table class="table">
        <thead>
            <tr>
              <th scope="col" style="text-align: center;">No</th>
              <th scope="col" style="text-align: center;">Nama</th>
              <th scope="col" style="text-align: center;">Username</th>
              <th scope="col" style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $i)    
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td style="text-align: center;">{{ $i->nama }}</td> <!-- Memanggil kolom 'nama' dari tabel 'users' -->
                <td style="text-align: center;">{{ $i->username }}</td> <!-- Memanggil kolom 'nama' dari tabel 'users' -->
                <td style="text-align: center;">
                    <button type="button" class="btn btn-primary">
                        <a href="/edituser/{{ $i->id }}" style="color:white;">
                            Edit
                        </a>
                    </button> |
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{$i->id}}">
                        Delete
                    </button>
                </td> <!-- Memanggil kolom 'nama' dari tabel 'users' -->
                <div class="modal fade" id="confirmDelete{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel{{$i->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteLabel{{$i->id}}">Konfirmasi Penghapusan</h5>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('/deleteuser/'.$i->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
