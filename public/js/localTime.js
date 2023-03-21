// LOCALTIME
let a;
let time;
setInterval(() => {
    a = new Date();
    time = `${a.getHours() < 10 ? "0" + a.getHours() : a.getHours()}:${ // MENGAMBIL JAM, JIKA DETIK KURANG DARI 10 MAKA TAMBAHKAN 0 DIDEPANNYA
        a.getMinutes() < 10 ? "0" + a.getMinutes() : a.getMinutes() // MENGAMBIL MENIT, JIKA DETIK KURANG DARI 10 MAKA TAMBAHKAN 0 DIDEPANNYA
    }:${a.getSeconds() < 10 ? "0" + a.getSeconds() : a.getSeconds()}`; // MENGAMBIL DETIK, JIKA DETIK KURANG DARI 10 MAKA TAMBAHKAN 0 DIDEPANNYA
    document.getElementById("time").innerHTML = time;
}, 1000); // AKAN MEREFRESH SETIAP 1 DETIK

// 2012-12-12 12:12
