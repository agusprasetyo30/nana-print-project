<?php
   namespace App\Helpers;
   use DB;

   Class Fuzzy 
   {
      // mencoba
      // public $total_bayar = 50000;
      // public $jumlah_transaksi = 6;


      // variabel total bayar
      private $TOTAL_BAYAR_SEDIKIT_MIN = 30000, $TOTAL_BAYAR_SEDIKIT_MAX = 50000, $TOTAL_BAYAR_CUKUP_MIN = 40000,
                     $TOTAL_BAYAR_CUKUP_MAX = 60000, $TOTAL_BAYAR_BANYAK_MIN = 50000, $TOTAL_BAYAR_BANYAK_MAX = 80000;

      // variabel jumlah transaksi
      private $JUMLAH_TRANSAKSI_JARANG_MIN = 3, $JUMLAH_TRANSAKSI_JARANG_MAX = 7, $JUMLAH_TRANSAKSI_CUKUP_MIN = 5,
                     $JUMLAH_TRANSAKSI_CUKUP_MAX = 10, $JUMLAH_TRANSAKSI_SERING_MIN = 7, $JUMLAH_TRANSAKSI_SERING_MAX = 12;
      
      // variabel diskon
      private $DISKON_SEDIKIT_MIN = 0, $DISKON_SEDIKIT_MAX = 10, $DISKON_SEDANG_MIN = 10,
                     $DISKON_SEDANG_MAX = 20, $DISKON_BANYAK_MIN = 20, $DISKON_BANYAK_MAX = 30;

      /**
       * FUZZIFIKASI
       */

       // Total Bayar Sedikit
      public function fuzzifikasi_total_bayar_sedikit($total_bayar)
      {
         if ($total_bayar <= $this->TOTAL_BAYAR_SEDIKIT_MIN) {
            $hasil = 1;
         
         } else if (($total_bayar >= 30000) && ($total_bayar <= 50000)) {
            $hasil = ($this->TOTAL_BAYAR_SEDIKIT_MAX - $total_bayar) / ($this->TOTAL_BAYAR_SEDIKIT_MAX - $this->TOTAL_BAYAR_SEDIKIT_MIN);

         } else if ($total_bayar >= 50000) {
            $hasil = 0;
         }

         return $hasil;
      }


      // Total Bayar Cukup
      public function fuzzifikasi_total_bayar_cukup($total_bayar)
      {
         if (($total_bayar <= $this->TOTAL_BAYAR_CUKUP_MIN) || ($total_bayar >= $this->TOTAL_BAYAR_CUKUP_MAX)) {
            $hasil = 0;
         
         } else if (($total_bayar >= $this->TOTAL_BAYAR_CUKUP_MIN) && ($total_bayar <= 50000)) {
            $hasil = ($total_bayar - $this->TOTAL_BAYAR_CUKUP_MIN) / ($this->TOTAL_BAYAR_SEDIKIT_MAX - $this->TOTAL_BAYAR_CUKUP_MIN);

         } else if ($total_bayar == 50000) {
            $hasil = 1;
         
         } else if (($total_bayar >= 50000) && ($total_bayar <= $this->TOTAL_BAYAR_CUKUP_MAX)) {
            $hasil = ($this->TOTAL_BAYAR_CUKUP_MAX - $total_bayar) / ($this->TOTAL_BAYAR_CUKUP_MAX - $this->TOTAL_BAYAR_SEDIKIT_MAX);
         } 

         return $hasil;
      }


      // Total Bayar Banyak
      private function fuzzifikasi_total_bayar_banyak($total_bayar)
      {
         if ($total_bayar <= $this->TOTAL_BAYAR_BANYAK_MIN) {
            $hasil = 0;
         
         } else if (($total_bayar >= $this->TOTAL_BAYAR_BANYAK_MIN) && ($total_bayar <= $this->TOTAL_BAYAR_BANYAK_MAX)) {
            $hasil = ($total_bayar - $this->TOTAL_BAYAR_BANYAK_MIN) / ($this->TOTAL_BAYAR_BANYAK_MAX - 50000);

         } else if ($total_bayar >= $this->TOTAL_BAYAR_BANYAK_MAX) {
            $hasil = 1;
         
         }

         return $hasil;
      }

      // TODO
      // Jumlah transaksi Jarang
      public function fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi)
      {
         if ($jumlah_transaksi <= $this->JUMLAH_TRANSAKSI_JARANG_MIN) {
            $hasil = 1;
         
         } else if (($jumlah_transaksi >= $this->JUMLAH_TRANSAKSI_JARANG_MIN) && ($jumlah_transaksi <= $this->JUMLAH_TRANSAKSI_JARANG_MAX)) {
            $hasil = ($this->JUMLAH_TRANSAKSI_JARANG_MAX - $jumlah_transaksi) / ($this->JUMLAH_TRANSAKSI_JARANG_MAX - $this->JUMLAH_TRANSAKSI_JARANG_MIN);

         } else if ($jumlah_transaksi >= $this->JUMLAH_TRANSAKSI_JARANG_MAX) {
            $hasil = 0;
         }

         return $hasil;
      }

      // Jumlah transaksi Cukup
      private function fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi)
      {
         if (($jumlah_transaksi <= $this->JUMLAH_TRANSAKSI_CUKUP_MIN) || ($jumlah_transaksi >= $this->JUMLAH_TRANSAKSI_CUKUP_MAX)) {
            $hasil = 0;
         
         } else if (($jumlah_transaksi >= $this->JUMLAH_TRANSAKSI_CUKUP_MIN) && ($jumlah_transaksi <= 7)) {
            $hasil = ($jumlah_transaksi - $this->JUMLAH_TRANSAKSI_CUKUP_MIN) / (7 - $this->JUMLAH_TRANSAKSI_CUKUP_MIN);

         } else if ($jumlah_transaksi == 7) {
            $hasil = 1;
         
         } else if (($jumlah_transaksi >= 7) && ($jumlah_transaksi <= $this->JUMLAH_TRANSAKSI_CUKUP_MAX)) {
            $hasil = ($this->JUMLAH_TRANSAKSI_CUKUP_MAX - $jumlah_transaksi) / ($this->JUMLAH_TRANSAKSI_CUKUP_MAX) - 7;
         } 

         return $hasil;
      }

      // Total Bayar sering
      private function fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi)
      {
         if ($jumlah_transaksi <= $this->JUMLAH_TRANSAKSI_SERING_MIN) {
            $hasil = 0;
         
         } else if (($jumlah_transaksi >= $this->JUMLAH_TRANSAKSI_SERING_MIN) && ($jumlah_transaksi <= $this->JUMLAH_TRANSAKSI_SERING_MAX)) {
            $hasil = ($jumlah_transaksi - 7) / ($this->JUMLAH_TRANSAKSI_SERING_MAX - 7);

         } else if ($jumlah_transaksi >= $this->TOTAL_BAYAR_BANYAK_MAX) {
            $hasil = 1;
         
         }

         return $hasil;
      }

      // IMPLIKASI DISKON BERDASARKAN RULE

      // IF Total Bayar Sedikit AND Jumlah Transaksi Jarang Then Diskon Sedikit
      private function r1_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_sedikit($total_bayar), $this->fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi));
      }

      // IF Total Bayar Sedikit AND Jumlah Transaksi Cukup Then Diskon Sedikit
      private function r2_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_sedikit($total_bayar), $this->fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi));
      }

      // IF Total Bayar Cukup AND Jumlah Transaksi Jarang Then Diskon Sedikit
      private function r3_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_cukup($total_bayar), $this->fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi));
      }

      // IF Total Bayar Sedikit AND Jumlah Transaksi Sering	Then Diskon Sedang
      private function r4_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_sedikit($total_bayar), $this->fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi));
      }

      // IF Total Bayar Cukup AND Jumlah Transaksi Cukup Then Diskon Sedang
      private function r5_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_cukup($total_bayar), $this->fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi));
      }

      // IF Total Bayar Banyak AND Jumlah Transaksi Jarang Then Diskon Sedang
      private function r6_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_banyak($total_bayar), $this->fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi));
      }

      // IF Total Bayar Cukup AND Jumlah Transaksi Sering Then Diskon Banyak
      private function r7_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_cukup($total_bayar), $this->fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi));
      }

      // IF Total Bayar Banyak AND Jumlah Transaksi Cukup Then Diskon Banyak
      private function r8_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_banyak($total_bayar), $this->fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi));
      }

      // IF Total Bayar Banyak AND Jumlah Transaksi Sering Then Diskon Banyak
      private function r9_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         return min($this->fuzzifikasi_total_bayar_banyak($total_bayar), $this->fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi));
      }

      /**
       * AGREGASI
       */

      // diskon sedikit
      private function agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         $r1 = $this->r1_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $r2 = $this->r2_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $r3 = $this->r3_diskon_sedikit($total_bayar, $jumlah_transaksi);

         return max($r1, $r2, $r3);
      }

      // diskon sedang
      private function agregasi_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $r1 = $this->r4_diskon_sedang($total_bayar, $jumlah_transaksi);
         $r2 = $this->r5_diskon_sedang($total_bayar, $jumlah_transaksi);
         $r3 = $this->r6_diskon_sedang($total_bayar, $jumlah_transaksi);

         return max($r1, $r2, $r3);
      }


      // diskon banyak
      private function agregasi_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         $r1 = $this->r7_diskon_banyak($total_bayar, $jumlah_transaksi);
         $r2 = $this->r8_diskon_banyak($total_bayar, $jumlah_transaksi);
         $r3 = $this->r9_diskon_banyak($total_bayar, $jumlah_transaksi);

         return max($r1, $r2, $r3);
      }

      /**
       * MENCARI CORD X PADA DISKON
       */

      // Cord naik pada diskon sedikit
      private function cord_naik_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         $agregasi_sedikit = $this->agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $cord = $agregasi_sedikit * ($this->DISKON_SEDIKIT_MAX / 2);

         return $cord;
      }

      // Cord turun pada diskon sedikit
      private function cord_turun_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         $agregasi_sedikit = $this->agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $cord = $this->DISKON_SEDIKIT_MAX - ($agregasi_sedikit * ($this->DISKON_SEDIKIT_MAX / 2));

         return $cord;
      }

      // Cord turun pada diskon sedang
      private function cord_naik_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $agregasi_sedang = $this->agregasi_diskon_sedang($total_bayar, $jumlah_transaksi);
         $cord = $this->DISKON_SEDANG_MIN + ($agregasi_sedang * (($this->DISKON_SEDANG_MAX/($this->DISKON_SEDANG_MAX/$this->DISKON_SEDANG_MIN)) - ($this->DISKON_SEDANG_MIN/($this->DISKON_SEDANG_MAX/$this->DISKON_SEDANG_MIN))));
         
         return $cord;
      }
      
      // Cord naik pada diskon sedang
      private function cord_turun_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $agregasi_sedang = $this->agregasi_diskon_sedang($total_bayar, $jumlah_transaksi);
         $cord = $this->DISKON_SEDANG_MAX - ($agregasi_sedang * (($this->DISKON_SEDANG_MAX/($this->DISKON_SEDANG_MAX/$this->DISKON_SEDANG_MIN)) - ($this->DISKON_SEDANG_MIN/($this->DISKON_SEDANG_MAX/$this->DISKON_SEDANG_MIN))));
         
         return $cord;
      }
      
      // Cord naik pada diskon banyak
      private function cord_naik_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         $agregasi_banyak = $this->agregasi_diskon_banyak($total_bayar, $jumlah_transaksi);
         $cord = $this->DISKON_BANYAK_MIN - ($agregasi_banyak * (($this->DISKON_BANYAK_MAX/($this->DISKON_BANYAK_MAX/$this->DISKON_BANYAK_MIN)) - ($this->DISKON_BANYAK_MAX/($this->DISKON_BANYAK_MAX/$this->DISKON_BANYAK_MIN))));
         
         return $cord;
      }

      // Cord turun pada diskon banyak
      private function cord_turun_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         $agregasi_banyak = $this->agregasi_diskon_banyak($total_bayar, $jumlah_transaksi);
         $cord = $this->DISKON_BANYAK_MAX + ($agregasi_banyak * (($this->DISKON_BANYAK_MAX/($this->DISKON_BANYAK_MAX/$this->DISKON_BANYAK_MIN)) - ($this->DISKON_BANYAK_MAX/($this->DISKON_BANYAK_MAX/$this->DISKON_BANYAK_MIN))));
         
         return $cord;
      }



      /**
       * DEFFUZIFIKASI
       */

      // HITUNG LUAS
      
      // luas A1
      private function a1_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $cordNaik = $this->cord_naik_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $agregasi = $this->agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);

         $luas = (($cordNaik-$this->DISKON_SEDIKIT_MIN) * $agregasi) / 2;
         
         return $luas;
      }

      // luas A2
      private function a2_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $cordNaik = $this->cord_naik_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $cordTurun = $this->cord_turun_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $agregasi = $this->agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);

         $luas = ($cordTurun - $cordNaik) * $agregasi;
         
         return $luas;
      }

      // luas A3
      private function a3_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $cordTurun = $this->cord_turun_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $agregasi = $this->agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);

         $luas = (($this->DISKON_SEDIKIT_MAX-$cordTurun) * $agregasi) / 2;
         
         return $luas;
      }

      // luas A4
      private function a4_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $cordNaik = $this->cord_naik_diskon_sedang($total_bayar, $jumlah_transaksi);
         $agregasi = $this->agregasi_diskon_sedang($total_bayar, $jumlah_transaksi);

         $luas = (($cordNaik-$this->DISKON_SEDANG_MIN) * $agregasi) / 2;
         
         return $luas;
      }

      // luas A5
      private function a5_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $cordNaik = $this->cord_naik_diskon_sedang($total_bayar, $jumlah_transaksi);
         $cordTurun = $this->cord_turun_diskon_sedang($total_bayar, $jumlah_transaksi);
         $agregasi = $this->agregasi_diskon_sedang($total_bayar, $jumlah_transaksi);

         $luas = ($cordTurun - $cordNaik) * $agregasi;
         
         return $luas;
      }

      // luas A6
      private function a6_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $cordTurun = $this->cord_turun_diskon_sedang($total_bayar, $jumlah_transaksi);
         $agregasi = $this->agregasi_diskon_sedang($total_bayar, $jumlah_transaksi);

         $luas = (($this->DISKON_SEDANG_MAX - $cordTurun) * $agregasi) / 2;
         
         return $luas;
      }

      // Total keseluruhan luas diskon sedang
      private function total_luas_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $a1 = $this->a1_luas_diskon_sedang($total_bayar, $jumlah_transaksi);
         $a2 = $this->a2_luas_diskon_sedang($total_bayar, $jumlah_transaksi);
         $a3 = $this->a3_luas_diskon_sedang($total_bayar, $jumlah_transaksi);
         $a4 = $this->a4_luas_diskon_sedang($total_bayar, $jumlah_transaksi);
         $a5 = $this->a5_luas_diskon_sedang($total_bayar, $jumlah_transaksi);
         $a6 = $this->a6_luas_diskon_sedang($total_bayar, $jumlah_transaksi);


         $arr = array($a1, $a2, $a3, $a4, $a5, $a6);

         return array_sum($arr);
      }

      /**
       * HITUNG INTEGRAL PERSAMAAN
       */

       // m1 integral 
      private function m1_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $zAtas = $this->cord_naik_diskon_sedikit($total_bayar, $jumlah_transaksi);

         $integral = (pow($zAtas, 3)/15) - (pow($this->DISKON_SEDIKIT_MIN, 3) / 15);

         return $integral;
      }

      // m2 integral 
      private function m2_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $zBawah = $this->cord_naik_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $zAtas = $this->cord_turun_diskon_sedikit($total_bayar, $jumlah_transaksi);

         $integral = (pow($zAtas, 2)/8) - (pow($zBawah, 2) / 8);

         return $integral;
      }

      // m3 integral 
      private function m3_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $zAtas = $this->DISKON_SEDIKIT_MAX;
         $zBawah = $this->cord_turun_diskon_sedikit($total_bayar, $jumlah_transaksi);

         $integral = ( -(($zAtas-15)*(pow($zAtas, 2))) / 15 ) - ( -(($zBawah-15)*(pow($zBawah, 2))) / 15 );

         return $integral;
      }
      
      // m4 integral 
      private function m4_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $zAtas = $this->cord_naik_diskon_sedang($total_bayar, $jumlah_transaksi);
         $zBawah = $this->DISKON_SEDIKIT_MAX;

         $integral = (($zAtas-15)*(pow($zAtas, 2))/15) - (($zBawah-15)*(pow($zBawah, 2))/15);

         return $integral;
      }

      // m5 integral 
      private function m5_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $zAtas = $this->cord_turun_diskon_sedang($total_bayar, $jumlah_transaksi);
         $zBawah = $this->cord_naik_diskon_sedang($total_bayar, $jumlah_transaksi);

         $integral = (pow($zAtas, 2)/4) - (pow($zBawah, 2)/4);

         return $integral;
      }

      // m6 integral 
      private function m6_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $zAtas = $this->DISKON_SEDANG_MAX;
         $zBawah = $this->cord_turun_diskon_sedang($total_bayar, $jumlah_transaksi);

         $integral = (-(($zAtas-30)*(pow($zAtas, 2)))/15) - (-(($zBawah-30)*(pow($zBawah, 2)))/15);

         return $integral;
      }

      // Total keseluruhan luas diskon sedang
      private function total_integral_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $m1 = $this->m1_integral_diskon_sedang($total_bayar, $jumlah_transaksi);
         $m2 = $this->m2_integral_diskon_sedang($total_bayar, $jumlah_transaksi);
         $m3 = $this->m3_integral_diskon_sedang($total_bayar, $jumlah_transaksi);
         $m4 = $this->m4_integral_diskon_sedang($total_bayar, $jumlah_transaksi);
         $m5 = $this->m5_integral_diskon_sedang($total_bayar, $jumlah_transaksi);
         $m6 = $this->m6_integral_diskon_sedang($total_bayar, $jumlah_transaksi);

         $arr = array($m1, $m2, $m3, $m4, $m5, $m6);

         return array_sum($arr);
      }

      /**
       * HITUNG DISKON SEDANG
       */

      public function hitung_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $total_integral = $this->total_integral_diskon_sedang($total_bayar, $jumlah_transaksi);
         $total_luas = $this->total_luas_diskon_sedang($total_bayar, $jumlah_transaksi);

         $hitung = $total_integral/$total_luas;
         
         // dd(
         //    $this->m1_integral_diskon_sedang($total_bayar, $jumlah_transaksi),
         //    $this->m2_integral_diskon_sedang($total_bayar, $jumlah_transaksi),
         //    $this->m3_integral_diskon_sedang($total_bayar, $jumlah_transaksi),
         //    $this->m4_integral_diskon_sedang($total_bayar, $jumlah_transaksi),
         //    $this->m5_integral_diskon_sedang($total_bayar, $jumlah_transaksi),
         //    $this->m6_integral_diskon_sedang($total_bayar, $jumlah_transaksi),
         //    $hitung
         // );

         return $hitung;
      }
   }

?>