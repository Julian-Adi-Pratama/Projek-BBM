<?php
$transaksi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && $_POST['jumlah'] && $_POST['tipe'] && $_POST['metode_pembayaran'] && $_POST['uang']) {
    $liter = $_POST['jumlah'];
    $jenis = $_POST['tipe'];
    $uang = $_POST['uang'];

    class pertamino
    {
        protected $harga;
        public $jumlah;
        public $jenis;
        public $ppn;

        public function __construct($harga, $jumlah, $jenis, $ppn = 0.1)
        {
            $this->harga = $harga;
            $this->jumlah = $jumlah;
            $this->jenis = $jenis;
            $this->ppn = $ppn;
        }

        public function hitungTotal()
        {
            $hargaasli = $this->harga * $this->jumlah;
            $hargappn = $hargaasli * $this->ppn;
            $totalharga = $hargaasli + $hargappn;

            return $totalharga;

    } }

    class Beli extends pertamino
    {
        public function __construct($harga, $jumlah, $jenis)
        {
            parent::__construct($harga, $jumlah, $jenis);
        }

        public function buktiTransaksi($metodePembayaran)
        
        {
            return "<h1>Transaksi Anda</h1>"
                . "Anda Membeli Bahan Bakar Minyak Tipe {$this->jenis} <br>"
                . "Dengan Jumlah : {$this->jumlah} Liter<br>"
                . "Metode Pembayaran Anda Dengan : {$metodePembayaran}<br>"
                . "Total Yang Harus Anda Bayar : Rp. " . number_format($this->hitungTotal(), 2) . "<br>";
            
                
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jumlah'], $_POST['tipe'], $_POST['metode_pembayaran'])) {
        $pilihan = $_POST['tipe'];
        $jumlah = intval($_POST['jumlah']);
        $metodePembayaran = $_POST['metode_pembayaran'];

        $beli = new Beli(
            ($pilihan === 'Pertamax Racing' ?15420  :
            ($pilihan === 'Pertamax Turbo' ? 16130 :
            ($pilihan === 'Pertamax' ? 18310 :
            ($pilihan === 'Pertalite' ? 16510 : 0)
                    )
                )
        ),
            $jumlah,
            $pilihan
        );

        $transaksi = $beli->buktiTransaksi($metodePembayaran);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertamino</title>
    <link rel="stylesheet" href="tukangbensin.css">
</head>

<body>
    <div class="programbensin">
        <?php echo $transaksi; ?>
        <h1>Selamat Datang</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="jumlah">Masukkan Jumlah Liter:</label>
            <input type="number" name="jumlah" id="jumlah" required>
            <br><br>
            <label for="tipe">Pilih Tipe Bahan Bakar:</label>
            <select name="tipe" id="tipe" required>
                <option value="">Pilih Tipe</option>
                <option value="Pertamax Racing">Pertamax Racing</option>
                <option value="Pertamax Turbo">Pertamax Turbo</option>
                <option value="Pertamax">Pertamax</option>
                <option value="Pertalite">Pertalite</option>
            </select>
            <br><br>
            <label for="metode_pembayaran">Pilih Metode Pembayaran:</label><br>
            <select name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="">Pilih Metode Pembayaran</option>
                <option value="Tunai">Tunai</option>
                <option value="OVO">OVO</option>
                <option value="Dana">Dana</option>
                <option value="BNI">BNI</option>
                <option value="GoPay">GoPay</option>
            </select>
            <br><br>
            <label for="uang">Masukkan Jumlah Uang:</label>
            <input type="number" name="uang" id="uang" required>
            <br><br>
            <button type="submit" name="submit">Proses Transaksi</button>
        </form>
    </div>
</body>

</html>