@extends('admin.layouts.app')

@section('page-title', 'Laporan Keuangan')

@section('admin-role', 'admin')

@section('breadcrumb')
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-money"></i> Laporan Keuangan</a></li>
      <li class="active">Home</li>
   </ol>
@endsection

@section('content')
<div class="row ">
   <div class="col-xs-12">
      <div class="box">
         <div class="box-header">
         <hr>
         <div class="float-left text-left">
            <form action="{{ route('money-report.index') }}">
               <label for="month">Periode</label>
               <div class="form-inline mb-3 contain">
                  <select name="month" id="month" class="form-control" required>
                        <option value="">Pilih bulan</option>
                        <option value="1" {{ Request::get('month') == 1 ? 'selected' : '' }}>Januari</option>
                        <option value="2" {{ Request::get('month') == 2 ? 'selected' : '' }}>Pebruari</option>
                        <option value="3" {{ Request::get('month') == 3 ? 'selected' : '' }}>Maret</option>
                        <option value="4" {{ Request::get('month') == 4 ? 'selected' : '' }}>April</option>
                        <option value="5" {{ Request::get('month') == 5 ? 'selected' : '' }}>Mei</option>
                        <option value="6" {{ Request::get('month') == 6 ? 'selected' : '' }}>Juni</option>
                        <option value="7" {{ Request::get('month') == 7 ? 'selected' : '' }}>Juli</option>
                        <option value="8" {{ Request::get('month') == 8 ? 'selected' : '' }}>Agustus</option>
                        <option value="9" {{ Request::get('month') == 9 ? 'selected' : '' }}>September</option>
                        <option value="10" {{ Request::get('month') == 10 ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ Request::get('month') == 11 ? 'selected' : '' }}>Nopember</option>
                        <option value="12" {{ Request::get('month') == 12 ? 'selected' : '' }}>Desember</option>
                  </select>

                  <select name="year" id="month" class="form-control" required>
                        <option value="">Pilih tahun</option>
                        <option value="2019" {{ Request::get('year') == 2019 ? 'selected' : '' }}>2019</option>
                        <option value="2020" {{ Request::get('year') == 2020 ? 'selected' : '' }}>2020</option>
                        <option value="2021" {{ Request::get('year') == 2021 ? 'selected' : '' }}>2021</option>
                        <option value="2022" {{ Request::get('year') == 2022 ? 'selected' : '' }}>2022</option>
                        <option value="2023" {{ Request::get('year') == 2023 ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ Request::get('year') == 2024 ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ Request::get('year') == 2025 ? 'selected' : '' }}>2025</option>
                  </select>
                  <div class="btn-group-sm inline ml-2 text-center">
                        <button type="submit" class="btn btn-info btn-sm">
                           Cari
                        </button>
                        <a href="{{ route('money-report.index') }}" class="btn btn-success btn-sm">
                           Tampilkan semua
                        </a>
                  </div>
               </div>
            </form>
         </div>
         </div>
         <div class="box-body table-responsive">
               <table class="table table-striped table-hover table-bordered table-align-middle text-center">
                  <thead>
                     <tr>
                        <th style="vertical-align: middle" width="10px">#</th>
                        <th style="vertical-align: middle" width="150px">Periode</th>
                        <th style="vertical-align: middle" width="300px">Penjualan ATK</th>
                        <th style="vertical-align: middle" width="300px">Transaksi Print</th>
                        <th style="vertical-align: middle" width="150px">Transaksi Foto</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($order_item as $key => $data)
                        <tr>
                           <td>{{ $number++ }}. </td>
                           <td>
                              {{ convertBulan($data->month) . ' ' . $data->year }}
                           </td>
                           <td>
                              {{ empty($data->total_price) ? "=" : toRupiah($data->total_price) }}
                           </td>
                           <td>
                              {{ empty($print_order_data[$key]->total_price) ? "-" : toRupiah($print_order_data[$key]->total_price) }}
                           </td>
                           <td>
                              {{ empty($photo_order_data[$key]->total_price) ? "-" : toRupiah($photo_order_data[$key]->total_price) }}                              
                           </td>
                        </tr>
                     @endforeach
                     @empty($data)
                        <tr>
                           <td colspan="5">
                              Data yang anda cari tidak ditemukan
                           </td>
                        </tr>
                     @endempty
                  </tbody>
                  <tfoot>
                     <tr>
                        <td colspan="10">
                              {{-- Pagination --}}
                              {{-- {{$users->appends(Request::all())->links()}} --}}
                        </td>
                     </tr>
                  </tfoot>
               </table>
            </div>
         </div>
      </div>
   </div>
@push('js')

@endpush

@endsection
