// LOCALTIME
let a;
let time;
setInterval(() => {
    a = new Date();
    time = `${a.getHours() < 10 ? "0" + a.getHours() : a.getHours()}:${
        a.getMinutes() < 10 ? "0" + a.getMinutes() : a.getMinutes()
    }:${a.getSeconds() < 10 ? "0" + a.getSeconds() : a.getSeconds()}`;
    document.getElementById("time").innerHTML = time;
}, 1000);

// 2012-12-12 12:12

// VALUE
// const d = new Date();
// const valueLocalTime = `${d.getFullYear()}-${
//     d.getMonth() < 10 ? "0" + d.getMonth() : d.getMonth()
// }-${d.getDay() < 10 ? "0" + d.getDay() : d.getDay()} ${
//     d.getHours() < 10 ? "0" + d.getHours() : d.getHours()
// }:${d.getMinutes() < 10 ? "0" + d.getMinutes() : d.getMinutes()}`;

// document.getElementById("inputLocalTime").value = valueLocalTime;
