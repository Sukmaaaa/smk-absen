function waktu() {
    // ARRAY HARI
    var haris = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    // ARRAY BULAN
    var bulans = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];
    // MEMBUAT VARIABEL SEBAGAI TANGGAL
    var tanggals = new Date();

    var hari = haris[tanggals.getDay()]; // MENGAMBIL HARI
    var tanggal = tanggals.getDate(); // MENGAMBIL TANGGAL
    var bulan = bulans[tanggals.getMonth()]; // MENGAMBIL BULAN
    var tahun = tanggals.getFullYear(); // MENGAMBIL TAHUN

    var fullDate = hari + ", " + tanggal + " " + bulan + " " + tahun; // MEMBUAT 1 VARIABEL YANG MEMUAT SELURUH VARIABEL YANG ADA

    // console.log(fullDate);

    document.getElementById("tanggal").innerHTML = fullDate; // MENCARI ELEMENT DENGAN ID TANGGAL UNTUK DIMASUKKAN VALUENYA
}

waktu(); // EKSEKUSI WAKTU

setInterval(waktu, 1000); // MEMBUAT FUNGSI WAKTU TERUPDATE SETIAP 1 DETIK
