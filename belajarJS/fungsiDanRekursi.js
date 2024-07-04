// // contoh fungsi paling sederhana
// function jalan() {
//     console.log("Mobil berjalan");
// }
// // pemanggilan pertama
// jalan();
// // pemanggilan kedua
// jalan();
// // pemanggilan ketiga
// jalan();

// // contoh fungsi dengan parameter dan return
// function toCelcius(fahrenheit) {
//     return (5 / 9) * (fahrenheit - 32);
// }
// console.log("10 fahrenheit = " + toCelcius(10) + " celcius");
// console.log("27 fahrenheit = " + toCelcius(27) + " celcius");

// // contoh rekursi untuk counting down
// function konterMenurun(angkaAwal) {
//     console.log(angkaAwal);
//     let angkaBerikutnya = angkaAwal - 1;
//     if (angkaBerikutnya > 0) {
//         konterMenurun(angkaBerikutnya);
//     } else {
//         console.log("Selesai");
//     }
// }
// konterMenurun(3);

// // contoh rekursi untuk jumlah digit
// function jumlahDigit(angkaAwal) {
//     let angkaBerikutnya = angkaAwal - 1;
//     if (angkaBerikutnya > 0) {
//         return angkaAwal + jumlahDigit(angkaBerikutnya);
//     }
//     return 1;
// }
// console.log(jumlahDigit(5));

// contoh penggunaan fungsi di Gamelab.ID
function getDataKelas(id) {
    const kelas = {
        id: 0,
        nama: "",
        jmlPeserta: 0,
        jmlPesertaLulus: 0,
        jmlPesertaOnGoing: 0,
        jmlPesertaTidakLulus: 0,
    };
    const arrayJmlPeserta = [100, 200, 300];
    const arrayJmlPesertaLulus = [10, 20, 30];
    const arrayJmlPesertaOnGoing = [20, 40, 60];
    const arrayJmlPesertaTidakLulus = [70, 140, 210];

    kelas.id = id;
    kelas.jmlPeserta = arrayJmlPeserta[id - 1];
    kelas.jmlPesertaLulus = arrayJmlPesertaLulus[id - 1];
    kelas.jmlPesertaOnGoing = arrayJmlPesertaOnGoing[id - 1];
    kelas.jmlPesertaTidakLulus = arrayJmlPesertaTidakLulus[id - 1];
    switch (id) {
        case 1:
            kelas.nama = "Pemrograman Dasar";
            break;
        case 2:
            kelas.nama = "Pemrograman Berorientasi Objek";
            break;
        case 3:
            kelas.nama = "Pemrograman Game";
            break;
        default:
            kelas.nama = "Tidak diketahui";
            break;
    }
    return kelas;
}
let kelas = getDataKelas(1);
console.log("ID = " + kelas.id);
console.log("Nama = " + kelas.nama);
console.log("Jumlah Peserta = " + kelas.jmlPeserta);
console.log("Jumlah Peserta Lulus = " + kelas.jmlPesertaLulus);
console.log("Jumlah Peserta OnGoing = " + kelas.jmlPesertaOnGoing);
console.log("Jumlah Peserta Tidak Lulus = " + kelas.jmlPesertaTidakLulus);