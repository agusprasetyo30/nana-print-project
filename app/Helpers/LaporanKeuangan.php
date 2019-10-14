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



}

?>