<?php

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $divisions = factory(Scheduler\Division::class, 5)->create();

        $min1 = date('2016-10-13');
        $startH = date('2016-10-14');
        $endH = date('2016-10-16');

        DB::table('divisions')->insert([
            'name' => 'Tim Inti',
            'shortname' => 'TI',
            'description' => 'Layanilah seorang akan yang lain, sesuai dengan karunia yang telah diperoleh tiap-tiap orang sebagai pengurus yang baik dari kasih karunia Allah.',
        ]);

        DB::table('divisions')->insert([
            'name' => 'Acara',
            'shortname' => 'Acara',
            'description' => 'Kita tahu sekarang, bahwa Allah turut bekerja dalam segala sesuatu untuk mendatangkan kebaikan bagi mereka yang mengasihi Dia, yaitu bagi mereka yang terpanggil sesuai dengan rencana Allah.',
        ]);

        DB::table('divisions')->insert([
            'name' => 'Humas, Publikasi, Dokumentasi, dan Kreatif',
            'shortname' => 'HPDK',
            'description' => '“Pergilah, berdirilah di Bait Allah dan beritakanlah seluruh firman hidup itu kepada orang banyak.”',
        ]);

        DB::table('divisions')->insert([
            'name' => 'Dana Usaha',
            'shortname' => 'Danus',
            'description' => 'Dan Allahku akan memenuhi segala keperluanmu menurut kekayaan dan kemuliaanNya dalam Kristus Yesus',
        ]);

        DB::table('divisions')->insert([
            'name' => 'Perlengkapan, Akomodasi dan Transportasi',
            'shortname' => 'Perlap-Akomtrans',
            'description' => 'Dan Allahku akan memenuhi segala keperluanmu menurut kekayaan dan kemuliaanNya dalam Kristus Yesus',
        ]);

        DB::table('divisions')->insert([
            'name' => 'Doa, Pemerhati, dan Kesehatan',
            'shortname' => 'DPK',
            'description' => 'Karena Allah, yang kulayani dengan segenap hatiku dalam pemberitaan Injil Anak-Nya, adalah saksiku, bahwa dalam doaku aku selalu mengingat kamu.',
        ]);

        DB::table('divisions')->insert([
            'name' => 'Sekretaris, dan Bendahara',
            'shortname' => 'Sekben',
            'description' => 'Karena Allah, yang kulayani dengan segenap hatiku dalam pemberitaan Injil Anak-Nya, adalah saksiku, bahwa dalam doaku aku selalu mengingat kamu.',
        ]);

        $acara_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'Acara')
                        ->first()
                        ->id;

        DB::table('prokers')->insert([
            [
                'name' => 'Ayat dan Tema',
                'description' => 'Menentukan Ayat dan Tema',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-01'),
                'end_date'  => date('2016-07-01'),
            ],
            [
                'name' => 'Alur Acara',
                'description' => 'Menentukan alur acara',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-12'),
                'end_date'  => date('2016-07-12'),
            ],
            [
                'name' => 'Rundown Acara',
                'description' => 'Membuat Rundown acara',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-12'),
                'end_date'  => date('2016-07-12'),
            ],
            [
                'name' => 'Pelayan Mimbar',
                'description' => 'Menentukan pelayan mimbar RKF 2016',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-22'),
                'end_date'  => date('2016-07-22'),
            ],
            [
                'name' => 'PKS',
                'description' => 'Menentukan Pemimpin Kelompok Sharing',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-22'),
                'end_date'  => date('2016-07-22'),
            ],
            [
                'name' => 'Sharing Pelayan',
                'description' => 'Mensharingkan pelayan mimbar RKF 2016',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-24'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'Sharing PKS',
                'description' => 'Mensharingkan PKS RKF 2016',
                'division_id' => $acara_id,
                'start_date'  => date('2016-07-24'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'Persiapan Outbond',
                'description' => 'Mempersiapkan acara outbond',
                'division_id' => $acara_id,
                'start_date'  => date('2016-08-12'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'Pembagian Kamar dan Kelompok Sharing',
                'description' => 'Mengatur pembagian kamar dan kelompok sharing',
                'division_id' => $acara_id,
                'start_date'  => date('2016-08-12'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'PHP Pelayan',
                'description' => 'Melaksanakan PHP pelayan mimbar',
                'division_id' => $acara_id,
                'start_date'  => date('2016-09-01'),
                'end_date'  => date('2016-09-01'),
            ],
            [
                'name' => 'PHP PKS',
                'description' => 'Melaksanakan PHP PKS dan sharing bahan',
                'division_id' => $acara_id,
                'start_date'  => date('2016-09-06'),
                'end_date'  => date('2016-09-06'),
            ],
            [
                'name' => 'CO dan GR',
                'description' => 'Mengatur jadwal dan mengawasi CO & GR',
                'division_id' => $acara_id,
                'start_date'  => date('2016-09-05'),
                'end_date'  => date('2016-10-13'),
            ],
            [
                'name' => 'Konten Buku Acara',
                'description' => 'Menyelesaikan konten buku acara',
                'division_id' => $acara_id,
                'start_date'  => date('2016-09-15'),
                'end_date'  => date('2016-09-15'),
            ],
            [
                'name' => 'Follow-Up Pembicara',
                'description' => 'Mengontak dan mengingatkan pembicara',
                'division_id' => $acara_id,
                'start_date'  => date('2016-09-29'),
                'end_date'  => date('2016-09-29'),
            ],
            [
                'name' => 'Survey Tempat',
                'description' => 'Melakukan survey tempat',
                'division_id' => $acara_id,
                'start_date'  => date('2016-08-12'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'Pembicara',
                'description' => 'Menentukan Pembicara RKF',
                'division_id' => $acara_id,
                'start_date'  => date('2016-08-12'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'Detail ke Pembicara',
                'description' => 'Mensharingkan tema, dan alur kepada pembicara',
                'division_id' => $acara_id,
                'start_date'  => date('2016-08-19'),
                'end_date'  => date('2016-08-19'),
            ],
        ]);


        $danus_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'Danus')
                        ->first()
                        ->id;

        DB::table('prokers')->insert([
            [
                'name' => 'Rencana Pencarian Dana',
                'description' => 'Menetapkan rencana pencarian dana',
                'division_id' => $danus_id,
                'start_date'  => date('2016-06-17'),
                'end_date'  => date('2016-06-17'),
            ],
        ]);

        $doperk_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'DPK')
                        ->first()
                        ->id;

        DB::table('prokers')->insert([
            [
                'name' => 'Rencana Doa dan Puasa',
                'description' => 'Menetapkan rencana jadwal doa dan puasa panitia',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-06-17'),
                'end_date'  => date('2016-06-17'),
            ],
            [
                'name' => 'Janji Iman',
                'description' => 'Melaksanakan pengumpulan janji iman',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-09-29'),
                'end_date'  => date('2016-09-29'),
            ],
            [
                'name' => 'Renungan Pleno',
                'description' => 'Menyampaikan Renungan setiap pleno',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-06-18'),
                'end_date'  => $min1,
            ],
            [
                'name' => 'MiniPerdo Pleno',
                'description' => 'Memimpin mini-perdo setiap pleno',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-06-18'),
                'end_date'  => $min1,
            ],
            [
                'name' => 'Menara Doa',
                'description' => 'Menentukan jadwal menara doa persiapan sebelum hari H',
                'division_id' => $doperk_id,
                'start_date'  => $min1,
                'end_date'  => $min1,
            ],
            [
                'name' => 'Persiapan Obat',
                'description' => 'Mempersiapkan kebutuhan kesehatan untuk hari H',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-09-29'),
                'end_date'  => date('2016-09-29'),
            ],
            [
                'name' => 'Renungan',
                'description' => 'Mempersiapkan renungan untuk hari H',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-09-01'),
                'end_date'  => date('2016-09-01'),
            ],
            [
                'name' => 'Berdoa',
                'description' => 'Mendoakan dan mengawasi kesehatan panitia dan pelayan masa aktif',
                'division_id' => $doperk_id,
                'start_date'  => date('2016-06-18'),
                'end_date'  => $min1,
            ],
        ]);

        $hpdk_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'hpdk')
                        ->first()
                        ->id;

        DB::table('prokers')->insert([
            [
                'name' => 'Rencana Publikasi',
                'description' => 'Menetapkan rencana publikasi',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-06-17'),
                'end_date'  => date('2016-06-17'),
            ],
            [
                'name' => 'Data Alumni',
                'description' => 'Mencari dan mengumpulkan data alumni PO Fasilkom yang akan dihubungi',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-07-01'),
                'end_date'  => date('2016-07-01'),
            ],
            [
                'name' => 'Desain Tema',
                'description' => 'Melakukan desain tema untuk berbagai media',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-07-03'),
                'end_date'  => date('2016-07-22'),
            ],
            [
                'name' => 'Publikasi',
                'description' => 'Melaksanakan publikasi di media yang sudah ditentukan',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-07-24'),
                'end_date'  => $min1,
            ],
            [
                'name' => 'Fiksasi Poster dan Spanduk',
                'description' => 'Menyelesaikan desain poster dan spanduk',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-08-26'),
                'end_date'  => date('2016-08-26'),
            ],
            [
                'name' => 'Proposal Alumni',
                'description' => 'Mendistribusikan proposal kepada alumni',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-08-26'),
                'end_date'  => date('2016-09-15'),
            ],
            [
                'name' => 'Proposal Dosen',
                'description' => 'Mendistribusikan porposal kepada dosen',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-09-03'),
                'end_date'  => date('2016-09-15'),
            ],
            [
                'name' => 'Mendesain Photo Booth',
                'description' => 'Melakukan desain photo booth',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-09-15'),
                'end_date'  => date('2016-09-15'),
            ],
            [
                'name' => 'Desain Buku Acara dan NameTag',
                'description' => 'Melakukan desain buku acara dan NameTag',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-09-15'),
                'end_date'  => date('2016-09-15'),
            ],
            [
                'name' => 'Finalisasi Buku Acara dan NameTag',
                'description' => 'Menyelesaikan buku acara dan NameTag untuk dicetak',
                'division_id' => $hpdk_id,
                'start_date'  => date('2016-09-22'),
                'end_date'  => date('2016-09-22'),
            ],
            [
                'name' => 'Dokumentasi',
                'description' => 'Dokumentasi hari H',
                'division_id' => $hpdk_id,
                'start_date'  => $startH,
                'end_date'  => $endH,
            ],
        ]);

        $perlap_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'Perlap-Akomtrans')
                        ->first()
                        ->id;

        DB::table('prokers')->insert([
            [
                'name' => 'Peminjaman Ruangan Rapat',
                'description' => 'Melakukan peminjaman ruangan untuk rapat pleno dan teknis',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-06-25'),
                'end_date'  => date('2016-06-25'),
            ],
            [
                'name' => 'List Villa',
                'description' => 'Mencari dan Mengumpulkan informasi villa yang mungkin digunakan',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-07-01'),
                'end_date'  => date('2016-07-01'),
            ],
            [
                'name' => 'Deal Villa',
                'description' => 'Mengadakan kesepakatan dan pembayaran untuk villa yang akan dipakai',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-08-12'),
                'end_date'  => date('2016-08-12'),
            ],
            [
                'name' => 'Transportasi',
                'description' => 'Mengurus dan menetapkan Transportasi untuk hari H',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-09-01'),
                'end_date'  => date('2016-09-01'),
            ],
            [
                'name' => 'Peminjaman Ruangan CO dan GR',
                'description' => 'Melakukan peminjaman ruangan untuk CO dan GR',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-09-05'),
                'end_date'  => date('2016-09-13'),
            ],
            [
                'name' => 'Mencetak Poster Spanduk',
                'description' => 'Mencetak Poster dan Spanduk',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-09-29'),
                'end_date'  => date('2016-09-29'),
            ],
            [
                'name' => 'Mencetak Buku Acara dan NameTag',
                'description' => 'Mencetak Buku Acara dan NameTag',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-09-29'),
                'end_date'  => date('2016-09-29'),
            ],
            [
                'name' => 'Survey Tempat',
                'description' => 'Melakukan survey tempat',
                'division_id' => $perlap_id,
                'start_date'  => date('2016-08-12'),
                'end_date'  => date('2016-08-12'),
            ],
        ]);


        $ti_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'TI')
                        ->first()
                        ->id;

        DB::table('prokers')->insert([
            [
                'name' => 'Pleno 1',
                'description' => 'PHP Panitia',
                'division_id' => $ti_id,
                'start_date'  => date('2016-06-08'),
                'end_date'  => date('2016-06-08'),
            ],
            [
                'name' => 'Pleno 1',
                'description' => 'Rapat Pleno 1',
                'division_id' => $ti_id,
                'start_date'  => date('2016-06-18'),
                'end_date'  => date('2016-06-18'),
            ],
            [
                'name' => 'Pleno 2',
                'description' => 'Rapat Pleno 2',
                'division_id' => $ti_id,
                'start_date'  => date('2016-07-02'),
                'end_date'  => date('2016-07-02'),
            ],
            [
                'name' => 'Pleno 3',
                'description' => 'Rapat Pleno 3',
                'division_id' => $ti_id,
                'start_date'  => date('2016-07-23'),
                'end_date'  => date('2016-07-23'),
            ],
            [
                'name' => 'Pleno 4',
                'description' => 'Rapat Pleno 4',
                'division_id' => $ti_id,
                'start_date'  => date('2016-08-13'),
                'end_date'  => date('2016-08-13'),
            ],
            [
                'name' => 'Pleno 5',
                'description' => 'Rapat Pleno 5',
                'division_id' => $ti_id,
                'start_date'  => date('2016-08-27'),
                'end_date'  => date('2016-08-27'),
            ],
            [
                'name' => 'Pleno 6',
                'description' => 'Rapat Pleno 6',
                'division_id' => $ti_id,
                'start_date'  => date('2016-09-02'),
                'end_date'  => date('2016-09-02'),
            ],
            [
                'name' => 'Pleno 7',
                'description' => 'Rapat Pleno 7',
                'division_id' => $ti_id,
                'start_date'  => date('2016-09-16'),
                'end_date'  => date('2016-09-16'),
            ],
            [
                'name' => 'Pleno 8',
                'description' => 'Rapat Pleno 8',
                'division_id' => $ti_id,
                'start_date'  => date('2016-09-30'),
                'end_date'  => date('2016-09-30'),
            ],
            [
                'name' => 'Pleno Teknis',
                'description' => 'Rapat Teknis',
                'division_id' => $ti_id,
                'start_date'  => date('2016-10-13'),
                'end_date'  => date('2016-10-13'),
            ],
            [
                'name' => 'RKF',
                'description' => 'Retret Keluarga Fasilkom',
                'division_id' => $ti_id,
                'start_date'  => date('2016-10-14'),
                'end_date'  => date('2016-10-16'),
            ],
        ]);

        $sekben_id = DB::table('divisions')
                        ->select('id')
                        ->where('shortname', 'Sekben')
                        ->first()
                        ->id;


        DB::table('members')->insert([
            [   'name' => 'Adam Jordan',
                'division_id' => $ti_id,
            ],
            [   'name' => 'Mischelle Meilisa',
                'division_id' => $ti_id,
            ],
            [   'name' => 'Laydianti',
                'division_id' => $sekben_id,
            ],
            [   'name' => 'Adinda Nadinta',
                'division_id' => $acara_id,
            ],
            [   'name' => 'Chyntia Julia',
                'division_id' => $acara_id,
            ],
            [   'name' => 'Jonathan',
                'division_id' => $acara_id,
            ],
            [   'name' => 'Citra Glory',
                'division_id' => $acara_id,
            ],
            [   'name' => 'William',
                'division_id' => $acara_id,
            ],
            [   'name' => 'Janice',
                'division_id' => $hpdk_id,
            ],
            [   'name' => 'Julio Jaya',
                'division_id' => $hpdk_id,
            ],
            [   'name' => 'Bintang Glenn',
                'division_id' => $hpdk_id,
            ],
            [   'name' => 'George Albert',
                'division_id' => $hpdk_id,
            ],
            [   'name' => 'Jefly',
                'division_id' => $danus_id,
            ],
            [   'name' => 'Jahns Christian Albert',
                'division_id' => $danus_id,
            ],
            [   'name' => 'Agnes Bina Krisanti',
                'division_id' => $danus_id,
            ],
            [   'name' => 'Jessica Susanto',
                'division_id' => $danus_id,
            ],
            [   'name' => 'Geraldo William',
                'division_id' => $danus_id,
            ],
            [   'name' => 'Riscel Eliel Florence',
                'division_id' => $doperk_id,
            ],
            [   'name' => 'Eri Elfizon Marbun',
                'division_id' => $doperk_id,
            ],
            [   'name' => 'Claudia Teresa',
                'division_id' => $doperk_id,
            ],
            [   'name' => 'Glenn Raynald',
                'division_id' => $perlap_id,
            ],
            [   'name' => 'Joachim',
                'division_id' => $perlap_id,
            ],
            [   'name' => 'Alvin Reza',
                'division_id' => $perlap_id,
            ],
            [   'name' => 'Alberto',
                'division_id' => $perlap_id,
            ],
            [   'name' => 'Samuel Yang',
                'division_id' => $perlap_id,
            ],
        ]);

    }
}
