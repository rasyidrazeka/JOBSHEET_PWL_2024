// contoh penggunaan if #1
var nama = "Rasyid Razeka"; // sesuai dengan kondisi if, maka perintah if akan dijalankan
if (nama == "Rasyid Razeka") {
    // jika sesuai, perintah dibawah akan dilaksanakan
    console.log(nama + " Logged In");
}

// contoh penggunaan if #2
var score = 0; //  tidak sesuai dengan kondisi if, maka perintah if tidak akan dijalankan
if (score == 100) {
    // jika sesuai, perintah dibawah akan dijalankan
    console.log("Victory");
}

// contoh penggunaan if #3
var umur = 30; // tidak sesuai dengan kondisi if
var mobil = 4; // sesuai dengan kondisi if
if (umur == 50 || mobil == 4) {
    // akan ditampilkan karena salah satu dari kedua kondisi if bersifat true
    console.log("Umurmu 50 atau Mobilmu 4");
}

// contoh penggunaan if #4
var kamera = 2; // tidak sesuai dengan kondisi if
var laptop = 1; // sesuai dengan kondisi if
if (kamera == 3 && laptop == 1) {
    // tidak akan dijalankan karena kedua kondisi if tersebut seharusnya bersifat true
    console.log("Memiliki 3 kamera dan 1 laptop");
}

// contoh penggunaan if else #1
var suhu = 33; // sesuai dengan kondisi if
if (suhu == 33) {
    // perintah akan dijalankan jika kondisi if sesuai dengan valuenya
    console.log("Suhu panas");
} else {
    // perintah akan dijalankan jika kondisi if tidak sesuai dengan valuenya
    console.log("Suhu tidak panas");
}

// contoh penggunaan if else #2
var suhu2 = 20; // sesuai dengan kondisi if
if (suhu2 == 33) {
    // perintah akan dijalankan jika kondisi if sesuai dengan valuenya
    console.log("Suhu panas");
} else {
    // perintah akan dijalankan jika kondisi if tidak sesuai dengan valuenya
    console.log("Suhu tidak panas");
}

// contoh penggunaan if - else if - else #1
var jumlahRoda = 2;
if (jumlahRoda == 2) {
    console.log("Sepeda");
} else if (jumlahRoda == 3) {
    console.log("Bajaj");
} else {
    console.log("Bukan sepeda maupun bajaj");
}

// contoh penggunaan if - else if - else #2
var jumlahRoda2 = 5;
if (jumlahRoda2 == 2) {
    console.log("Sepeda");
} else if (jumlahRoda2 == 3) {
    console.log("Bajaj");
} else {
    console.log("Bukan sepeda maupun bajaj");
}

// contoh penggunaan nested if
var roda = 0;
var tipe = 0;
var txtRoda = "";
var txtTipe = "";
roda = 4; // sesuai dengan kondisi if ke-2 pada roda
tipe = 1; // tidak sesuai dengan kondisi if pada tipe
if (roda == 2) { //  tidak sesuai dengan value maka tidak akan dijalankan
    txtRoda = "Sepeda";
    if (tipe == 0) {
        txtTipe = "Anak";
    } else {
        txtTipe = "Dewasa";
    }
} else if (roda == 4) { // sesuai dengan value maka akan dijalankan
    txtRoda = "Mobil";
    if (tipe == 0) { // tidak sesuai dengan value maka akan di skip
        txtTipe = "Manual";
    } else { // sesuai dengan value maka akan dijalankan
        txtTipe = "Matic";
    }
} else {
    txtRoda = "Unknown";
}
console.log(txtRoda + " " + txtTipe);

// contoh penggunaan switch case #1
var namaHari = "";
switch (new Date().getDay()) {
    case 0:
        namaHari = "Minggu";
        break;
    case 1:
        namaHari = "Senin";
        break;
    case 2:
        namaHari = "Selasa";
        break;
    case 3:
        namaHari = "Rabu";
        break;
    case 4:
        namaHari = "Kamis";
        break;
    case 5:
        namaHari = "Jumat";
        break;
    case 6:
        namaHari = "Sabtu";
        break;
}
console.log(namaHari);

// contoh penggunaan switch case #2
var idPlatform = 0;
var namaPlatform = "";
switch (idPlatform) {
    case 1:
        namaPlatform = "Android";
        break;
    case 1:
        namaPlatform = "IOS";
        break;
    case 2:
        namaPlatform = "Web";
        break;
    default:
        namaPlatform = "Tidak diketahui";
        break;
}
console.log(namaPlatform);

// contoh penggunaan switch case #3
var x = 2;
var y = 4;
switch (y % x) {
    case 0:
        console.log("Sisa hasil bagi = 0");
        break;
    case 1:
        console.log("Sisa hasil bagi = 1");
        break;
    default:
        console.log("Sisa hasil bagi bukan 0 maupun 1");
        break;
}