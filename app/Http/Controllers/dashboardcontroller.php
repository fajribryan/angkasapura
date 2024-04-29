<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\User;
use App\Models\OrderHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class dashboardcontroller extends Controller
{
    public function index()
    {
        $menus = menu::all();
        return view('user/dashboard', compact('menus'));
    }
    public function addMenu(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan.');
        }

        // Dapatkan keranjang dari session
        $keranjang = Session::get('keranjang', []);

        // Periksa apakah menu sudah ada dalam keranjang
        if (array_key_exists($id, $keranjang)) {
            // Jika sudah ada, tambahkan jumlah pesanan
            $keranjang[$id]['jumlah'] += 1;
        } else {
            // Jika belum ada, tambahkan menu ke dalam keranjang
            $keranjang[$id] = [
                'id' => $menu->id,
                'nama' => $menu->nama,
                'harga' => $menu->hargamenu,
                'fotomenu' => $menu->fotomenu,
                'jumlah' => 1, // Inisialisasi jumlah pesanan
            ];
        }

        // Simpan kembali session keranjang
        Session::put('keranjang', $keranjang);

        return redirect('/')->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }
    public function kurangi($id)
    {
        $keranjang = Session::get('keranjang', []);

        if (array_key_exists($id, $keranjang)) {
            // Kurangi jumlah pesanan
            $keranjang[$id]['jumlah']--;

            // Jika jumlah pesanan menjadi 0, hapus item dari keranjang
            if ($keranjang[$id]['jumlah'] <= 0) {
                unset($keranjang[$id]);
            }

            // Simpan kembali session keranjang setelah mengurangi jumlah
            Session::put('keranjang', $keranjang);
        }

        return redirect()->back()->with('success', 'Jumlah pesanan berhasil dikurangi.');
    }
    public function tambah($id)
    {
        $keranjang = Session::get('keranjang', []);

        if (array_key_exists($id, $keranjang)) {
            // Tambahkan jumlah pesanan
            $keranjang[$id]['jumlah']++;
        }

        // Simpan kembali session keranjang setelah menambah jumlah
        Session::put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Jumlah pesanan berhasil ditambah.');
    }
    public function keranjang()
    {
        $keranjang = Session::get('keranjang', []);
    
        return view('/user/keranjang', compact('keranjang'));
    }
    public function dashboardadmin()
    {
        $orders = Order::all();
        return view('admin/dashboard',  compact('orders'));
    }

    public function menu()
    {
        $menus = menu::all();

        return view('admin/menu/menu', compact('menus'));
    }
    public function tambahmenu()
    {
        return view('admin/menu/tambahmenu');
    }
    
    public function storemenu(Request $request)
    {       
        $request->validate([
            'nama' => 'required',
            'detailmenu' => 'required',
            'hargamenu' => 'required|numeric',
            'fotomenu' => 'required|image|mimes:jpeg,png,jpg,gif|max:2000'
        ]);
        // dd($request->all());
        if ($request->hasFile('fotomenu')) {            
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('fotomenu')->getClientOriginalName());
            $request->file('fotomenu')->move(public_path('images'), $filename);
    
            // Pastikan model 'menu' sudah diimpor di atas
            menu::create([
                'nama' => $request->nama,
                'detailmenu' => $request->detailmenu,
                'hargamenu' => $request->hargamenu,
                'fotomenu' => $filename
            ]);
    
            return redirect('/menu');
        } else {
            return redirect('/tambahmenu');
        }
       
    }
    public function editmenu($id)
    {
        $menus = menu::find($id);

        return view('admin/menu/editmenu', compact('menus'));
    }
    public function updatemenu(Request $request, $id)
    {
        $menus = menu::findOrFail($id);

        $menus->nama = $request->input('nama');
        $menus->detailmenu = $request->input('detailmenu');
        $menus->hargamenu = $request->input('hargamenu');
        
        if ($request->hasFile('fotomenu')) {
            // Hapus foto lama (opsional)
            if ($menus->fotomenu) {
                Storage::delete('public/images/' . $menus->fotomenu);
            }
    
            // Simpan foto baru
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('fotomenu')->getClientOriginalName());
            $request->file('fotomenu')->move(public_path('images'), $filename);
            $menus->fotomenu = $filename;
        }

        $menus->save();

        return redirect('/menu')->with('success', 'Menu berhasil diperbarui!');
    }
    public function deletemenu($id)
    {
        $menus = menu::findOrFail($id);

        // Hapus user
        $menus->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }
    public function listadmin()
    {
        $user = User::all();
        
        return view('/admin/listadmin/listadmin', compact('user'));
    }
    public function edituser($id)
    {
        $user = User::find($id);
        
        return view('/admin/listadmin/edituser', compact('user'));
    }
    public function updateuser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        
        $user->save();

        return redirect('/listadmin')->with('success', 'User berhasil diperbarui!');
    }
    public function deleteuser($id)
    {
        $user = User::findOrFail($id);

        // Hapus user
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
    public function checkout(Request $request)
    {
        // Ambil informasi dari keranjang (misalnya dari session atau input request)
    $keranjang = $request->session()->get('keranjang'); // Contoh untuk pengambilan data dari session

    // Lakukan validasi data keranjang (pastikan tidak kosong, valid, dll.)

    // Simpan informasi pesanan ke dalam database atau tempat penyimpanan yang sesuai
    $order = new Order();

    // Siapkan array untuk menyimpan informasi item yang akan disimpan
    $orderItems = [];

    // Hitung total harga pesanan (berdasarkan data di keranjang) dan siapkan informasi item
    $totalPrice = 0;
    foreach ($keranjang as $item) {
        $totalPrice += $item['harga'] * $item['jumlah'];

        // Simpan informasi dasar item (nama, jumlah, harga) ke dalam array
        $orderItems[] = [
            'nama' => $item['nama'],
            'jumlah' => $item['jumlah'],
            'harga' => $item['harga']
        ];
    }

    // Simpan informasi item dalam format JSON ke dalam kolom 'items' pada order
    $order->items = json_encode($orderItems);

    // Simpan total harga pesanan ke dalam kolom 'total_price' pada order
    $order->total_price = $totalPrice;

    // Simpan order ke dalam database
    $order->save();

    // Bersihkan keranjang belanja setelah checkout (jika menggunakan session)
    $request->session()->forget('keranjang');

    // Redirect atau kirimkan respon sesuai kebutuhan
    return redirect('/pesanan')->with('success', 'Pesanan berhasil diproses!');
    }
    public function pesanan()
    {
        $orders = Order::all();
        return view('/user/pesanan', compact('orders'));
    }
    public function complete(Order $order)
    {
        // Memulai transaksi database
        DB::transaction(function () use ($order) {
            $itemsArray = json_decode($order->items, true);

            // Tandai pesanan sebagai selesai di dalam tabel OrderHistory
            OrderHistory::create([
                'order_id' => $order->id,
                'items' => json_encode($itemsArray), // Simpan detail item dalam format JSON
                'total_price' => $order->total_price,
                'completed' => true // Tandai bahwa pesanan sudah selesai
            ]);

            // Hapus pesanan dari tabel Order
            $order->delete();
        });

        // Redirect ke halaman daftar pesanan
        return redirect('/dashboardadmin')->with('success', 'Pesanan telah ditandai sebagai selesai dan dihapus dari daftar.');
    }
    public function history()
    {
        $orderHistory = OrderHistory::all();
        return view('/admin/history/history' , compact('orderHistory'));
    }
    public function exportOrderHistory()
    {
        $orderHistory = OrderHistory::all(); // Ambil semua data history pesanan

        $filename = 'order_history_' . now()->format('YmdHis') . '.csv';  // Nama file CSV dengan timestamp
        $filePath = storage_path('exports/' . $filename); // Path untuk menyimpan file CSV di storage

        $handle = fopen($filePath, 'w'); // Buka file untuk menulis

        // Tulis header CSV
        fputcsv($handle, ['Nomor Pesanan', 'Total Harga', 'Item Pesanan'], ';');

        // Tulis data setiap history pesanan ke dalam file CSV
        foreach ($orderHistory as $history) {
            $items = json_decode($history->items);

            // Konversi item pesanan ke dalam format yang sesuai untuk ditulis ke CSV
            $itemLines = [];
            foreach ($items as $item) {
                $itemLines[] = "$item->nama (Jumlah: $item->jumlah, Harga: Rp. $item->harga)";
            }
            $itemString = implode('; ', $itemLines);

            // Tulis baris data history pesanan ke dalam file CSV
            fputcsv($handle, [$history->order_id, $history->total_price, $itemString], ';');
        }

        fclose($handle); // Tutup file CSV setelah selesai menulis

        // Kembalikan file CSV untuk diunduh
        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }
}
