// // contoh perulangan for #1
// for (var i = 0; i < 5; i++) {
//     console.log(i);
// }

// // contoh perulangan for #2
// var output = "";
// for (var i = 10; i > 0; i -= 2) {
//     output += i + " ";
// }
// console.log(output);

// // contoh perulangan for - in object #1
// const platform = { situs: "Gamelab", ekstensi: "ID", id: 99 };
// let output = "";
// for (let key in platform) {
//     output += platform[key];
// }
// console.log(output);

// // contoh perulangan for - in object #2
// const platform = { id: 12, id2: 25, id3: 52 };
// let output = "";
// for (let key in platform) {
//     output += platform[key];
// }
// console.log(output);

// // contoh perulangan for - in array
// const angka = [1, 2, 3, 4, 5];
// let output = "";
// for (let index in angka) {
//     output += angka[index] + " _ ";
// }
// console.log(output);

// // contoh perulangan for - of array
// const angka = [1, 2, 3, 4, 5];
// let output = "";
// for (let a of angka) {
//     output += a + " _ ";
// }
// console.log(output);

// // contoh perulangan for - of untuk string
// let platform = "Gamelab Indonesia";
// let output = "";
// for (let p of platform) {
//     output += p + " ";
// }
// console.log(output);

// // contoh perulangan while
// var i = 0;
// var output = "";
// while (i < 10) {
//     output += i + " ";
//     i++;
// }
// console.log(output);

// // contoh perulangan do while
// var i = 0;
// var output = "";
// do {
//     output += i + " ";
//     i++;
// } while (i > 10);
// console.log(output);

// // membandingkan for dan while
// const brands = ["Educa", "Gamelab", "Marbel"];
// // contoh menggunakan for
// let i = 0;
// let text = "";
// for (; brands[i];) {
//     text += brands[i];
//     i++;
// }
// console.log(text);
// // contoh menggunakan while
// let a = 0;
// let text2 = "";
// while (brands[a]) {
//     text += brands[a];
//     a++;
// }
// console.log(text2);

// // contoh penggunaan nested loop #1
// var text = "";
// for (var x = 0; x < 3; x++) {
//     for (var y = 0; y < 5; y++) {
//         text += "*";
//     }
//     text += "\n";
// }
// console.log(text);

// // contoh penggunaan nested loop #2
// var text = "";
// for (var x = 0; x < 5; x++) {
//     for (var y = 0; y <= x; y++) {
//         text += "*";
//     }
//     text += "\n";
// }
// console.log(text);