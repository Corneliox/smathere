# Dokumen Komprehensif: Analisis, Rasionalisasi Desain, dan Panduan Operasional Tema Web SMA Theresiana

**Dokumen Revisi & Perluasan**  
*Laporan ini menyajikan paparan mendalam mengenai transformasi website, filosofi di balik setiap keputusan desain antarmuka, serta petunjuk teknis pengelolaan sistem harian.*

---

## Bagian I: Latar Belakang dan Evolusi Tampilan

Perkembangan teknologi informasi menuntut institusi pendidikan untuk tidak sekadar memiliki eksistensi di dunia maya, melainkan juga menghadirkan pengalaman digital yang imersif dan representatif. Keputusan untuk bertransformasi dari struktur tema bawaan yang kaku (berbasis desain blog personal) menuju arsitektur antarmuka khusus "SMA-Theresiana" bukanlah sebuah langkah kosmetik belaka. Ini adalah pergeseran paradigma komunikasi visual.

Pada awalnya, sistem menggunakan kerangka dasar yang lebih berorientasi pada penyajian teks linear layaknya jurnal pribadi. Namun, sebuah institusi sekelas SMA Theresiana membutuhkan etalase digital yang mampu memancarkan wibawa, keterbukaan, sekaligus inovasi. Oleh karena itu, perombakan besar-besaran diimplementasikan.

*[REKOMENDASI FIGURE 1: Masukkan tangkapan layar (screenshot) perbandingan *Before-After*. Sebelah kiri menampilkan desain lama yang kaku, sebelah kanan menampilkan desain baru yang modern dengan Hero Section yang membentang penuh.]*

Kita tidak sekadar mengganti warna atau menempelkan logo baru. Setiap elemen yang kini Anda lihat di layar telah melalui proses pemikiran mengenai bagaimana calon siswa, orang tua, dan alumni akan berinteraksi dengan halaman tersebut.

---

## Bagian II: Gerbang Utama (Panduan Akses Sistem)

Sebelum kita menyelam lebih jauh ke dalam estetika dan manajemen konten, hal yang paling mendasar adalah memahami bagaimana cara memegang kendali atas platform ini. Sebagai administrator utama, Anda memiliki dua pintu gerbang krusial yang wajib dijaga kerahasiaannya.

### 1. Akses Ruang Kendali Konten (WordPress Admin Panel)
WordPress adalah mesin utama yang menggerakkan publikasi Anda. Di sinilah Anda akan menulis berita, mengubah gambar, dan mengatur menu.

*[REKOMENDASI FIGURE 2: Masukkan gambar halaman login WordPress standar yang menampilkan form isian *Username* dan *Password* dengan latar belakang putih atau logo sekolah di atasnya.]*

Untuk memasuki ruang kendali ini, prosedurnya sangat lugas:
- Buka peramban (browser) Anda dan ketikkan alamat website sekolah, lalu tambahkan `/wp-admin` di belakangnya (contoh: `smatheresiana.sch.id/wp-admin`).
- Anda akan disambut oleh layar otentikasi.
- Silakan masukkan **Alamat Email** atau **Nama Pengguna (Username)** yang telah didaftarkan.
- Di kolom bawahnya, ketikkan **Kata Sandi (Password)** Anda secara hati-hati.
- Tekan tombol masuk atau tekan *Enter*. 

Jika kredensial yang Anda masukkan valid, Anda akan langsung dibawa ke *Dashboard* utama. Di sinilah semua keajaiban bermula.

### 2. Akses Dapur Pacu Server (cPanel)
Berbeda dengan WordPress yang mengurus "tampilan depan", cPanel adalah ruang mesin sesungguhnya. Di sini Anda mengatur hal-hal teknis seperti kapasitas penyimpanan, *database*, pengaturan domain, hingga pembuatan akun email institusi resmi (seperti *info@smatheresiana.sch.id*).

*[REKOMENDASI FIGURE 3: Masukkan gambar halaman login cPanel dengan warna khas oranye/biru gelap, menampilkan kolom kredensial server.]*

Langkah masuknya:
- Kunjungi tautan cPanel yang biasanya dikirimkan oleh penyedia layanan hosting Anda (seringkali berupa alamat IP atau domain dengan port khusus seperti `:2083`).
- Masukkan **Username cPanel** yang unik (bukan email).
- Ketikkan **Password cPanel** Anda.
- Klik login. Mengingat sifatnya yang sangat krusial, sangat disarankan untuk tidak membagikan akses cPanel ini kepada staf yang tidak memiliki latar belakang IT atau tanpa otorisasi penuh.

---

## Bagian III: Mengupas Tuntas Psikologi dan Filosofi Desain (UI/UX)

Setiap keputusan visual yang kita ambil selama proses *redesign* memiliki landasan psikologis dan fungsional. Mari kita bedah satu per satu mengapa website SMA Theresiana kini terlihat seperti yang Anda lihat sekarang.

### Estetika Transparansi pada Bilah Navigasi (Transparent Navbar)
Pernahkah Anda menyadari mengapa saat pertama kali website dibuka, bilah menu di bagian paling atas tidak memiliki warna latar yang pekat, melainkan transparan dan menyatu dengan gambar utama?

Pendekatan *transparent navbar* ini bukan tanpa alasan. Dalam desain antarmuka modern, transparansi digunakan untuk mendobrak batasan visual. Jika kita menggunakan warna solid (misalnya blok warna hitam atau biru tebal) di bagian paling atas, hal itu akan menciptakan "tembok" yang memotong garis pandang pengunjung. Dengan membuatnya transparan, gambar *Hero Section* (yang mungkin berisi foto megah gedung sekolah atau wajah ceria siswa-siswi) dapat membentang secara paripurna hingga ke ujung layar atas.

*[REKOMENDASI FIGURE 4: Tampilkan screenshot bagian Header website di mana logo dan teks menu terlihat jelas melayang (floating) di atas gambar latar belakang yang indah, menyoroti ketiadaan garis batas bawah navbar.]*

Hal ini menciptakan kesan imersif. Pengunjung langsung "terserap" ke dalam dunia SMA Theresiana begitu halaman selesai dimuat. Begitu pengunjung mulai menggulir (scroll) layar ke bawah, barulah *navbar* tersebut akan memunculkan warna latar yang solid agar teks menu tetap terbaca saat melewati konten dengan warna yang bervariasi. Transisi ini mencerminkan dinamisme dan teknologi yang kekinian.

### Psikologi Geometri: Mengapa Bentuknya "Membulat" (Rounded Corners)?
Jika Anda teliti, elemen-elemen seperti tombol (*buttons*), kotak artikel, kartu profil, hingga kolom pencarian tidak lagi memiliki ujung yang bersudut tajam 90 derajat. Kita menerapkan radius sudut (*border-radius*) sehingga ujungnya membulat. Mengapa demikian?

Sudut tajam secara psikologis sering diasosiasikan dengan sesuatu yang kaku, formalitas birokrasi yang dingin, atau bahkan bahaya (seperti ujung mata pisau). Sebaliknya, bentuk dengan sudut membulat (*rounded*) memancarkan kesan ramah, inklusif, modern, dan aman. 

*[REKOMENDASI FIGURE 5: Tampilkan perbandingan *close-up* (di-zoom) antara tombol konvensional yang bersudut tajam dan tombol baru website yang memiliki lengkungan lembut di sudut-sudutnya.]*

SMA Theresiana adalah institusi pendidikan yang merangkul generasi muda. Calon siswa (Generasi Z dan Alpha) tumbuh dengan perangkat seluler dan aplikasi modern (seperti iOS dan Android) yang menjadikan desain *rounded* sebagai standar industri antarmuka. Dengan mengadopsi bentuk ini, website sekolah secara tidak sadar berkomunikasi dengan bahasa visual yang sudah sangat familiar dan nyaman bagi target audiens utamanya. Website tidak lagi terasa seperti papan pengumuman instansi pemerintah yang kaku, melainkan ruang interaksi digital yang *welcoming*.

### Pemilihan Palet Warna dan Signifikansinya
Warna bukan hanya sekadar pemanis, ia adalah pembawa pesan tanpa suara. Skema warna yang kita terapkan dirancang untuk mewakili nilai-nilai sekolah. Warna dasar yang dipilih menggabungkan nuansa yang menyimbolkan profesionalitas akademik, kepercayaan, namun tetap diselingi aksen warna yang merepresentasikan semangat masa muda.

Warna utama digunakan untuk elemen struktural guna menjaga teks agar sangat mudah dibaca (*high readability*). Sementara itu, warna-warna sekunder atau *aksen* disuntikkan secara strategis pada elemen yang membutuhkan perhatian khusus pengunjung, seperti tombol "Daftar Sekarang", tautan penting, atau pengumuman genting. Kontras yang tercipta dipandu oleh prinsip *accessibility* agar pengunjung dengan gangguan penglihatan ringan tetap dapat berselancar tanpa kesulitan.

---

## Bagian IV: Kebebasan Kustomisasi Warna Tanpa Batas di Tangan Anda

Meskipun kita telah menetapkan desain dasar yang kuat, kita menyadari bahwa institusi itu hidup dan dinamis. Akan ada masanya sekolah merayakan hari jadi dengan tema warna tertentu, atau mungkin menyelaraskan warna web dengan kampanye sosial tertentu.

Untuk itulah arsitektur tema ini dirancang secara modular pada sektor pewarnaan. Anda tidak terkunci pada satu palet warna mati!

*[REKOMENDASI FIGURE 6: Masukkan gambar panel "Customizer" WordPress di sisi kiri layar yang sedang menampilkan opsi "Colors", menunjukkan berbagai kotak pemilih warna (color picker) yang bebas digeser-geser.]*

 Melalui panel admin, sistem menyediakan opsi untuk mengganti *Color Palette* sesuka hati. 
1. Cukup arahkan kursor ke menu **Tampilan > Sesuaikan (Customize)**.
2. Cari bagian **Warna (Colors)**.
3. Di sana Anda akan menemukan *color picker* (pemilih warna) visual. Anda bisa mengklik dan memilih jutaan spektrum warna yang ada.
4. Apa yang terjadi saat Anda menggantinya? Secara instan, seluruh elemen aksen di website—mulai dari warna tombol saat disorot mouse (*hover*), garis bawah tautan, hingga elemen dekoratif—akan secara otomatis beradaptasi mengikuti warna baru yang Anda pilih. 

Hal ini memberikan kekuatan penuh bagi pihak humas sekolah untuk mengatur identitas visual tanpa harus menyewa desainer atau *programmer* setiap kali ingin mengubah nuansa website.

---

## Bagian V: Arsitektur Navigasi dan Manajemen Menu

Website sebesar apa pun akan menjadi tidak berguna jika pengunjungnya tersesat. Oleh karena itu, kita memposisikan struktur menu navigasi layaknya rambu penunjuk jalan di sebuah kampus fisik. Menu ditempatkan secara strategis, dengan kategorisasi yang intuitif: Profil, Akademik, Kesiswaan, PPDB, dan Kontak.

Namun, struktur organisasi sekolah bisa saja berubah. Anda mungkin perlu menambahkan halaman baru untuk fasilitas lab yang baru dibangun, atau menghapus program ekstrakurikuler yang sudah tidak aktif.

### Cara Menghapus Menu yang Sudah Tidak Diperlukan
Kadang kala kebersihan antarmuka lebih baik daripada terlalu banyak informasi. Jika Anda ingin menghapus sebuah tautan dari menu atas:
- Pastikan Anda sudah login ke area Admin.
- Tuju **Tampilan > Menu**.
- Temukan blok menu yang ingin Anda singkirkan. Di sebelah kanan nama menu tersebut, terdapat tanda panah kecil ke bawah. Klik tanda tersebut.
- Sebuah panel akan terbuka ke bawah. Di bagian kiri bawah panel itu, terdapat tulisan berwarna merah berbunyi **Singkirkan (Remove)**.
- Klik tulisan tersebut, dan *voila*, item tersebut akan menghilang dari daftar. Jangan lupa klik **Simpan Menu**.

*[REKOMENDASI FIGURE 7: Tangkapan layar yang menyoroti tanda panah *dropdown* pada item menu aktif di Dashboard, dengan lingkaran merah pada tombol "Singkirkan" atau "Remove".]*

### Cara Menambahkan Rute Navigasi Baru (Menambah Menu)
Sebaliknya, jika sekolah meluncurkan portal alumni baru, Anda pasti ingin menambahkannya ke menu.
- Masih di halaman yang sama (**Tampilan > Menu**).
- Di sisi sebelah kiri layar, Anda akan melihat kolom-kolom seperti *Halaman, Pos, Tautan Tersuai (Custom Links), dan Kategori*.
- Centang halaman yang sudah Anda buat sebelumnya, lalu tekan tombol **Tambahkan ke Menu**.
- Blok menu baru tersebut akan muncul di urutan paling bawah pada struktur menu di sebelah kanan.
- Bagian terbaiknya adalah: Anda bisa *mengklik, menahan, lalu menggeser* (drag and drop) blok tersebut ke atas atau ke bawah untuk menentukan urutannya. 
- Ingin membuat menu *dropdown* (menu bercabang)? Geser saja blok tersebut sedikit ke arah kanan di bawah menu utamanya. Sistem akan otomatis mengenalinya sebagai sub-item.

*[REKOMENDASI FIGURE 8: Gambar animasi atau urutan foto yang menunjukkan sebuah blok menu ditarik (drag) dan diletakkan sedikit menjorok ke dalam (indent) untuk membentuk sub-menu.]*

---

## Bagian VI: Anatomi Komponen Lainnya

Selain Hero Section dan Menu yang telah kita bahas panjang lebar, komponen pendukung lainnya juga tidak luput dari perhatian.

**Sektor Artikel dan Jurnalistik (Post Area):**
Kita mengadopsi format *grid* bergaya kartu (*card-based UI*) untuk daftar berita. Kembali lagi, elemen *rounded* diaplikasikan di sini. Desain kartu mengotakkan informasi menjadi potongan-potongan yang mudah dicerna secara kognitif. Setiap kartu berita memiliki bayangan tipis (*drop shadow*) yang memberikan efek elevasi 3D. Ini bukan sekadar gaya-gayaan; bayangan tersebut memberi tahu otak pengguna bahwa elemen tersebut bisa di-klik dan merupakan objek terpisah dari latar belakang.

*[REKOMENDASI FIGURE 9: Potongan gambar yang menampilkan deretan artikel berita sekolah dalam format kartu (card layout), memperlihatkan foto thumbnail, judul tebal, dan bayangan halus di sekeliling kartu.]*

**Ruang Pelengkap (Sidebar):**
Bilah sisi ini dijaga kebersihannya. Terlalu banyak *widget* di bilah sisi seringkali memicu *banner blindness* (kondisi di mana mata secara tidak sadar mengabaikan elemen karena dianggap sebagai iklan/sampah). Kita hanya menempatkan elemen fundamental seperti kalender, pencarian cepat, dan daftar pos terbaru yang paling krusial.

**Fondasi Dasar (Footer):**
Footer dirancang menjadi wadah komprehensif penutup informasi. Menggunakan warna yang kontras dengan area konten utama, footer berfungsi secara visual sebagai titik henti (*stopping point*) yang memberitahu pembaca bahwa mereka telah mencapai dasar halaman. Di sini disematkan informasi vital yang sering dicari secara cepat: alamat navigasi peta, nomor darurat administrasi, dan tautan ke profil media sosial.

---

## Bagian VII: Rangkuman Rekomendasi Titik Penempatan Gambar (Figure)

Untuk memperkaya dokumen laporan cetak atau digital Anda, berikut adalah daftar inventaris *Figure* yang sangat disarankan untuk Anda sisipkan pada bagian-bagian yang telah ditandai di atas. Ini akan secara dramatis meningkatkan pemahaman teknis bagi pembaca laporan ini kelak:

1. **Figure 1**: Komparasi visual *split-screen* antara desain Ashe lama vs desain SMA-Theresiana baru.
2. **Figure 2**: Halaman login `wp-admin` yang bersih dan jelas.
3. **Figure 3**: Antarmuka login cPanel dengan detail port yang benar.
4. **Figure 4**: *Close up* bagian ujung atas website yang menampakkan efek kaca/transparan dari menu utama yang menyatu dengan latar belakang foto gedung.
5. **Figure 5**: Perbandingan bentuk UI kotak tajam dengan bentuk UI *rounded corner* dengan radius lengkungan.
6. **Figure 6**: Tangkapan layar panel opsi tema (Customizer) yang sedang difokuskan pada bagian *Color Picker* (palet warna visual).
7. **Figure 7**: Proses menghapus menu di *backend* WordPress.
8. **Figure 8**: Simulasi *Drag and Drop* saat mengatur hirarki menu (parent dan child menu).
9. **Figure 9**: Tampilan susunan grid tata letak artikel/berita yang berjejer rapi.

---

## Bagian VIII: Lembar Kredensial Akses dan Dukungan Teknis

Bagian penutup ini difungsikan sebagai lembar rahasia yang wajib Anda lengkapi. Cetak dokumen ini, isi bagian rumpang dengan tulisan tangan untuk menghindari kebocoran data digital, lalu simpan di brankas tata usaha atau ruangan kepala sekolah.

### Kredensial Portal Administrator (WordPress)
- **Tautan Masuk** : `........................................................`
- **Email Pengelola** : `........................................................`
- **Kata Sandi Rahasia**: `........................................................`

### Kredensial Kontrol Server Hosting (cPanel)
- **Tautan Masuk** : `........................................................`
- **Username Sistem** : `........................................................`
- **Kata Sandi Sistem**: `........................................................`

> [!WARNING]
> Kehilangan akses cPanel dapat berakibat fatal pada kepemilikan domain dan file inti website. Selalu lakukan pencadangan (*backup*) secara periodik.

### Saluran Komunikasi Bantuan Teknis Terpadu
Transformasi digital tidak berhenti pada hari peluncuran. Jika suatu hari nanti sistem mengalami malfungsi, konfigurasi *plugin* yang bentrok, halaman *blank* (layar putih), atau sekadar butuh panduan restrukturisasi desain lebih lanjut untuk tema SMA-Theresiana ini, jalur komunikasi prioritas selalu terbuka untuk Anda:

- **Surat Elektronik (Email)**: cornelioabdimash@gmail.com
- **Pesan Instan / Panggilan Telepon (WhatsApp)**: +62 815-4240-0072

Setiap pelaporan kendala (bug/error) diharapkan menyertakan tangkapan layar kejadian agar tim teknis dapat merumuskan diagnosa dan memberikan eskalasi perbaikan dengan tingkat respons yang lebih cepat dan efisien.
