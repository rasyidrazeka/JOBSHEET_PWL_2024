// contoh penggunaan console log
console.log("I Love GameLab.id");

// contoh tipe data number
var umur = 30;
var jml_mobil = 4;
var phi = 3.14;

// contoh tipe data string
var nama = "Andi Taru";
var alamat = "Kota Salatiga";
var pendidikan = "Wharton University";
var perusahaan = "Educa Studio";

// contoh penggunaan array
var brands = ["Educa", "Gamelab", "Marbel"];
var buah = ["apel", "pisang", "jeruk"];
var angka = [1, 2, 3, 4, 5];
var gabungan = ["Gamelab", 123, true, ["Gamelab Indonesia", "Educa Studio"]];

// contoh penggunaan tipe data object
var player = {
    playerName: "Gamelab",
    scores: 0,
    bestScore: 185
};

// contoh membuat variabel baru dengan nilainya
var playerName = "Gamelab.ID";
var playerScores = 100;

// contoh membuat variabel tanpa nilai
var playerName;
var playerScores;

// var bisa melakukan deklarasi ulang seperti contoh dibawah ini
var player = "Gamelab.ID";
var player = 100;

// var dapat digunakan di luar scope/lingkup lokal
var playerName = "Gamelab.ID";
playerName = "Educa Studio";

// let hanya bisa dideklarasikan 1 saja
let player = "Gamelab.ID";
let player = 100; // terjadi error

// let tidak dapat digunakan di luar scope/lingkup lokal
let playerName = "Gamelab.ID";
playerName = "Educa Studio"; // terjadi error

// const tidak dapat diganti nilai awalnya
const playerName = "Gamelab.ID";
playerName = "Educa Studio"; // terjadi error

// const hanya dapat diakses di dalam blok tempat mereka dideklarasikan
const playerName = "Gamelab.ID";
playerName = "Educa Studio"; // terjadi error

// tidak error karena pakai var
playerName = "Gamelab.ID";
var playerName;
// error karena pakai let
playerName = "Gamelab.ID";
let playerName = "Educa Studio";
// error karena pakai const
playerName = "Gamelab.ID";
const playerName = "Educa Studio";

// contoh penggunaan operator assignment
var playerName = "Andi Taru";
var playerScores = 0;
playerName = "Gamelab.ID";
playerScores = 100;
playerScores += 10;
console.log(playerName);
console.log(playerScores);

// contoh penggunaan operator aritmatika
var x = 10;
var y = 5;
var z = x + y;
// nilai z = 15
var a = 11;
var b = 5;
var c = a % b;
// nilai c = 1

// operator + dapat digunakan untuk menambahkan string
var firstName = "Andi";
var lastName = "Taru";
var fullName = firstName + " " + lastName;
console.log(fullName);

// operator += juga dapat digunakan untuk menambahkan string
var myName = "Andi";
myName += " Taru";
console.log(myName);

// operator diatas juga dapat untuk menambahkan atau menggabungkan string dan number
let a = 4 + 6;
console.log(a); // nilai a = 10
let b = "4" + 6;
console.log(b); // nilai b = "46"
let c = "Gamelab" + 46;
console.log(c); // nilai c = "Gamelab46"

// contoh penggunaan operator perbandingan
var a = 0;
var b = 10;
var c = "0";
console.log(a == b); // false
console.log(a == c); // true
console.log(a === c); // false
console.log(a === b); // false
console.log(a == b ? "a == b" : "a != b"); // a != b

// contoh penggunaan operator tipe
var a = 100;
var b = "Gamelab.ID";
var c = {};
var d = true;
var e = ["Apel", "Bengkoang"];
console.log(typeof (a)); // number
console.log(typeof (b)); // string
console.log(typeof (c)); // object
console.log(typeof (d)); // boolean
console.log(typeof (e)); // object
console.log(e instanceof Array); // true

// contoh penggunaan operator bitwise
console.log(0 & 0); // 0
console.log(0 & 1); // 0
console.log(1 & 1); // 1
console.log(0 | 0); // 0
console.log(0 | 1); // 1
console.log(1 | 1); // 1
