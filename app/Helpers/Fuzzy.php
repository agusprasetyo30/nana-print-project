<?php
   namespace App\Helpers;
   use DB;

   Class Fuzzy 
   {
      // mencoba
      public $total_bayar = 50000;
      public $jumlah_transaksi = 6;


      // variabel total bayar
      private static $TOTAL_BAYAR_SEDIKIT_MIN = 30000;
      private static $TOTAL_BAYAR_SEDIKIT_MAX = 50000;
      private static $TOTAL_BAYAR_CUKUP_MIN = 40000;
      private static $TOTAL_BAYAR_CUKUP_MAX = 60000;
      private static $TOTAL_BAYAR_BANYAK_MIN = 50000;
      private static $TOTAL_BAYAR_BANYAK_MAX = 80000;

      // variabel jumlah transaksi
      private static $JUMLAH_TRANSAKSI_JARANG_MIN = 3;
      private static $JUMLAH_TRANSAKSI_JARANG_MAX = 7;
      private static $JUMLAH_TRANSAKSI_CUKUP_MIN = 5;
      private static $JUMLAH_TRANSAKSI_CUKUP_MAX = 10;
      private static $JUMLAH_TRANSAKSI_SERING_MIN = 7;
      private static $JUMLAH_TRANSAKSI_SERING_MAX = 12;
      
      // variabel diskon
      private static $DISKON_SEDIKIT_MIN = 0;
      private static $DISKON_SEDIKIT_MAX = 10;
      private static $DISKON_SEDANG_MIN = 10;
      private static $DISKON_SEDANG_MAX = 20;
      private static $DISKON_BANYAK_MIN = 20;
      private static $DISKON_BANYAK_MAX = 30;

      // Variabel rule yang digunakan


      /**
       * FUZZIFIKASI
       */

       // Total Bayar Sedikit
      public static function fuzzifikasi_total_bayar_sedikit($total_bayar)
      {
         if ($total_bayar <= self::$TOTAL_BAYAR_SEDIKIT_MIN) {
            $hasil = 1;
         
         } else if (($total_bayar >= 30000) && ($total_bayar <= 50000)) {
            $hasil = (self::$TOTAL_BAYAR_SEDIKIT_MAX - $total_bayar) / (self::$TOTAL_BAYAR_SEDIKIT_MAX - self::$TOTAL_BAYAR_SEDIKIT_MIN);

         } else if ($total_bayar >= 50000) {
            $hasil = 0;
         }

         return $hasil;
      }

      // Total Bayar Cukup
      public static function fuzzifikasi_total_bayar_cukup($total_bayar)
      {
         if (($total_bayar <= self::$TOTAL_BAYAR_CUKUP_MIN) || ($total_bayar >= self::$TOTAL_BAYAR_CUKUP_MAX)) {
            $hasil = 0;
         
         } else if (($total_bayar >= self::$TOTAL_BAYAR_CUKUP_MIN) && ($total_bayar <= 50000)) {
            $hasil = ($total_bayar - self::$TOTAL_BAYAR_CUKUP_MIN) / (50000 - self::$TOTAL_BAYAR_CUKUP_MIN);

         } else if ($total_bayar == 50000) {
            $hasil = 1;
         
         } else if (($total_bayar >= 50000) && ($total_bayar <= self::$TOTAL_BAYAR_CUKUP_MAX)) {
            $hasil = (self::$TOTAL_BAYAR_CUKUP_MAX - $total_bayar) / (self::$TOTAL_BAYAR_CUKUP_MAX) - 50000;
         } 

         return $hasil;
      }

      // Total Bayar Banyak
      public static function fuzzifikasi_total_bayar_banyak($total_bayar)
      {
         if ($total_bayar <= self::$TOTAL_BAYAR_BANYAK_MIN) {
            $hasil = 0;
         
         } else if (($total_bayar >= self::$TOTAL_BAYAR_BANYAK_MIN) && ($total_bayar <= self::$TOTAL_BAYAR_BANYAK_MAX)) {
            $hasil = ($total_bayar - self::$TOTAL_BAYAR_BANYAK_MIN) / (self::$TOTAL_BAYAR_BANYAK_MAX - 50000);

         } else if ($total_bayar >= self::$TOTAL_BAYAR_BANYAK_MAX) {
            $hasil = 1;
         
         }

         return $hasil;
      }


      // Jumlah transaksi Jarang
      public static function fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi)
      {
         if ($jumlah_transaksi <= self::$JUMLAH_TRANSAKSI_JARANG_MIN) {
            $hasil = 1;
         
         } else if (($jumlah_transaksi >= self::$JUMLAH_TRANSAKSI_JARANG_MIN) && ($jumlah_transaksi <= self::$JUMLAH_TRANSAKSI_JARANG_MAX)) {
            $hasil = (self::$JUMLAH_TRANSAKSI_JARANG_MAX - $jumlah_transaksi) / (self::$JUMLAH_TRANSAKSI_JARANG_MAX - self::$JUMLAH_TRANSAKSI_JARANG_MIN);

         } else if ($jumlah_transaksi >= self::$JUMLAH_TRANSAKSI_JARANG_MAX) {
            $hasil = 0;
         }

         return $hasil;
      }

      // Jumlah transaksi Cukup
      public static function fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi)
      {
         if (($jumlah_transaksi <= self::$JUMLAH_TRANSAKSI_CUKUP_MIN) || ($jumlah_transaksi >= self::$JUMLAH_TRANSAKSI_CUKUP_MAX)) {
            $hasil = 0;
         
         } else if (($jumlah_transaksi >= self::$JUMLAH_TRANSAKSI_CUKUP_MIN) && ($jumlah_transaksi <= 7)) {
            $hasil = ($jumlah_transaksi - self::$JUMLAH_TRANSAKSI_CUKUP_MIN) / (7 - self::$JUMLAH_TRANSAKSI_CUKUP_MIN);

         } else if ($jumlah_transaksi == 7) {
            $hasil = 1;
         
         } else if (($jumlah_transaksi >= 7) && ($jumlah_transaksi <= self::$JUMLAH_TRANSAKSI_CUKUP_MAX)) {
            $hasil = (self::$JUMLAH_TRANSAKSI_CUKUP_MAX - $jumlah_transaksi) / (self::$JUMLAH_TRANSAKSI_CUKUP_MAX) - 7;
         } 

         return $hasil;
      }

      // Total Bayar sering
      public static function fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi)
      {
         if ($jumlah_transaksi <= self::$JUMLAH_TRANSAKSI_SERING_MIN) {
            $hasil = 0;
         
         } else if (($jumlah_transaksi >= self::$JUMLAH_TRANSAKSI_SERING_MIN) && ($jumlah_transaksi <= self::$JUMLAH_TRANSAKSI_SERING_MAX)) {
            $hasil = ($jumlah_transaksi - 7) / (self::$JUMLAH_TRANSAKSI_SERING_MAX - 7);

         } else if ($jumlah_transaksi >= self::$TOTAL_BAYAR_BANYAK_MAX) {
            $hasil = 1;
         
         }

         return $hasil;
      }

      // IMPLIKASI DISKON BERDASARKAN RULE

      // IF Total Bayar Sedikit AND Jumlah Transaksi Jarang Then Diskon Sedikit
      public static function r1_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_sedikit($total_bayar), self::fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi));
      }

      // IF Total Bayar Sedikit AND Jumlah Transaksi Cukup Then Diskon Sedikit
      public static function r2_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_sedikit($total_bayar), self::fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi));
      }

      // IF Total Bayar Cukup AND Jumlah Transaksi Jarang Then Diskon Sedikit
      public static function r3_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_cukup($total_bayar), self::fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi));
      }

      // IF Total Bayar Sedikit AND Jumlah Transaksi Sering	Then Diskon Sedang
      public static function r4_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_sedikit($total_bayar), self::fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi));
      }

      // IF Total Bayar Cukup AND Jumlah Transaksi Cukup Then Diskon Sedang
      public static function r5_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_cukup($total_bayar), self::fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi));
      }

      // IF Total Bayar Banyak AND Jumlah Transaksi Jarang Then Diskon Sedang
      public static function r6_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_banyak($total_bayar), self::fuzzifikasi_jumlah_transaksi_jarang($jumlah_transaksi));
      }

      // IF Total Bayar Cukup AND Jumlah Transaksi Sering Then Diskon Banyak
      public static function r7_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_cukup($total_bayar), self::fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi));
      }

      // IF Total Bayar Banyak AND Jumlah Transaksi Cukup Then Diskon Banyak
      public static function r8_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_banyak($total_bayar), self::fuzzifikasi_jumlah_transaksi_cukup($jumlah_transaksi));
      }

      // IF Total Bayar Banyak AND Jumlah Transaksi Sering Then Diskon Banyak
      public static function r9_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         return min(self::fuzzifikasi_total_bayar_banyak($total_bayar), self::fuzzifikasi_jumlah_transaksi_sering($jumlah_transaksi));
      }

      /**
       * AGREGASI
       */

      // diskon sedikit
      public static function agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         $r1 = self::r1_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $r2 = self::r2_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $r3 = self::r3_diskon_sedikit($total_bayar, $jumlah_transaksi);

         return max($r1, $r2, $r3);
      }

      // diskon sedang
      public static function agregasi_diskon_sedang($total_bayar, $jumlah_transaksi)
      {
         $r1 = self::r4_diskon_sedang($total_bayar, $jumlah_transaksi);
         $r2 = self::r5_diskon_sedang($total_bayar, $jumlah_transaksi);
         $r3 = self::r6_diskon_sedang($total_bayar, $jumlah_transaksi);

         return max($r1, $r2, $r3);
      }


      // diskon banyak
      public static function agregasi_diskon_banyak($total_bayar, $jumlah_transaksi)
      {
         $r1 = self::r7_diskon_banyak($total_bayar, $jumlah_transaksi);
         $r2 = self::r8_diskon_banyak($total_bayar, $jumlah_transaksi);
         $r3 = self::r9_diskon_banyak($total_bayar, $jumlah_transaksi);

         return max($r1, $r2, $r3);
      }

      /**
       * MENCARI CORD X PADA DISKON
       */

      // Cord naik pada diskon sedikit
      public static function cord_naik_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         $agregasi_sedikit = self::agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $cord = $agregasi_sedikit - (self::$DISKON_SEDIKIT_MAX / 2);

         return $cord;
      }

      // Cord turun pada diskon sedikit
      public static function cord_turun_diskon_sedikit($total_bayar, $jumlah_transaksi)
      {
         $agregasi_sedikit = self::agregasi_diskon_sedikit($total_bayar, $jumlah_transaksi);
         $cord = self::$DISKON_SEDIKIT_MAX - ($agregasi_sedikit * (self::$DISKON_SEDIKIT_MAX / 2));

         return $cord;
      }
   }

?>