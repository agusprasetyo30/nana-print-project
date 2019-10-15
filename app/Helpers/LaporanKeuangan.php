<?php
// untuk laporan keuangan

namespace App\Helpers;
use DB;

Class LaporanKeuangan
{
   // mengambil data itemOrderData Keseluruhan
   private static function itemOrderData($month = null, $year = null)
   {
      if ($month == null && $year == null) {
         $item_orders = DB::table('item_orders')
            ->select(DB::raw("sum(total_price) as total_price , status, MONTH(created_at) as month,
                              YEAR(created_at) as year"))
            ->groupBy('status' ,'month','year')
            ->having('status', 'FINISH')
            ->get();
      
         } else {
         $item_orders = DB::table('item_orders')
            ->select(DB::raw("sum(total_price) as total_price , status, MONTH(created_at) as month,
                              YEAR(created_at) as year"))
            ->groupBy('status' ,'month','year')
            ->having('status', 'FINISH')
            ->having('month', $month)
            ->having('year', $year)
            ->get();
      }
         
      return $item_orders;
   }

   public static function getItemOrderData($month = null, $year = null)
   {
      return self::itemOrderData($month, $year);
   }

   public static function getMonth($month = null, $year = null) {
      return self::itemOrderData($month, $year)->pluck('month');
   }

   public static function getYear($month = null, $year = null) {
      return self::itemOrderData($month, $year)->pluck('year');
   }

   public static function getStatus($month = null, $year = null) {
      return self::itemOrderData($month, $year)->pluck('status');
   }

   public static function getTotalPrice($month = null, $year = null) {
      return self::itemOrderData($month, $year)->pluck('total_price');
   }

   // mengambil data itemPrint Keseluruhan
   private static function itemPrintData($month = null, $year = null)
   {
      if ($month == null && $year == null) {
         $print_orders = DB::table('print_orders')
            ->select(DB::raw("sum(total_price) as total_price , status, MONTH(created_at) as month,
                              YEAR(created_at) as year, type",))
            ->groupBy('status' ,'month','year', 'type')
            ->having('status', 'FINISH')
            ->having('type', 'PRINT')
            ->get();
      
         } else {
         $print_orders = DB::table('print_orders')
            ->select(DB::raw("sum(total_price) as total_price , status, MONTH(created_at) as month,
                              YEAR(created_at) as year"))
            ->groupBy('status' ,'month','year', 'type')
            ->having('status', 'FINISH')
            ->having('month', $month)
            ->having('year', $year)
            ->having('type', 'PRINT')
            ->get();
      }

      return $print_orders;
   }

   public static function getPrintOrderData($month = null, $year = null)
   {
      return self::itemPrintData($month, $year);
   }

   // mengambil data itemPhoto Keseluruhan
   private static function itemPhotoData($month = null, $year = null)
   {
      if ($month == null && $year == null) {
         $photo_orders = DB::table('print_orders')
            ->select(DB::raw("sum(total_price) as total_price , status, MONTH(created_at) as month,
                              YEAR(created_at) as year, type",))
            ->groupBy('status' ,'month','year', 'type')
            ->having('status', 'FINISH')
            ->having('type', 'PHOTO')
            ->get();
      
         } else {
         $photo_orders = DB::table('print_orders')
            ->select(DB::raw("sum(total_price) as total_price , status, MONTH(created_at) as month,
                              YEAR(created_at) as year"))
            ->groupBy('status' ,'month','year', 'type')
            ->having('status', 'FINISH')
            ->having('type', 'PHOTO')
            ->having('month', $month)
            ->having('year', $year)
            ->get();
      }

      return $photo_orders;
   }

   public static function getPhotoOrderData($month = null, $year = null)
   {
      return self::itemPhotoData($month, $year);
   }

}

?>