<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokoku - Toko Sayur & Sembako</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-leaf me-2"></i>Tokoku
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i> Keranjang
                        </a>
                    </li>
                    
                    <!-- Cek apakah user belum login -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <!-- Jika user sudah login -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Pesanan Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container Utama -->
    <div class="container">
        <div class="row">
            
            <!-- Sidebar Kategori -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white fw-bold">
                        Kategori Produk
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('home') }}" class="list-group-item list-group-item-action text-success fw-bold">
                            Semua Kategori
                        </a>
                        @foreach($categories as $category)
                            <a href="#" class="list-group-item list-group-item-action">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Grid Produk -->
            <div class="col-md-9">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <!-- Menampilkan gambar dummy dari placeholder -->
                                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x200?text=Sayur+Segar' }}" class="card-img-top" alt="{{ $product->name }}">
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate" title="{{ $product->name }}">{{ $product->name }}</h5>
                                    <span class="badge bg-secondary mb-2" style="width: fit-content;">
                                        {{ $product->category->name }}
                                    </span>
                                    
                                    <h5 class="text-success fw-bold mt-2 mb-3">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </h5>
                                    
                                    <!-- Tombol rata bawah -->
                                    <button class="btn btn-outline-success mt-auto w-100">
                                        <i class="fas fa-cart-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                Belum ada produk yang tersedia saat ini.
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white text-center py-4 mt-5 border-top">
        <p class="mb-0 text-muted">&copy; {{ date('Y') }} Tokoku. Dibuat untuk hasil panen terbaik.</p>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>