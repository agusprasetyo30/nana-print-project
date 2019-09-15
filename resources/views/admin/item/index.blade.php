@extends('admin.layouts.app')

@section('page-title', 'Barang')

@section('admin-role', 'admin')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Barang</a></li>
        <li class="active">Home</li>
    </ol>
@endsection

@section('content')
@if ($field)
    @for ($i = 0; $i < count($field); $i++)
         <ol>
            -> {{ $field[$i] }}
         </ol>
         <ol>
            => {{ $data[$i] }}
         </ol>
    @endfor
@endif

<div class="container">
    <form action="{{ route('items.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3" id="field_wrapper">
        <div>
            <input type="text" name="field_name[]" id="" placeholder="Inputan">
            <input type="file" name="data[]" id="">
            <a href="javascript:void(0);" title="Tambah" id="add_button">Tambah</a>
        </div>
        </div>
        <input type="submit" name="submit" value="SUBMIT">
    </form>
</div>

@push('js')
<script>
    $(document).ready(function(){
    var maxField = 10; // Input field increment limination
    var addButton = $('#add_button');
    var wrapper = $('#field_wrapper');
    var fieldHTML = '<div><input type="text" name="field_name[]"/>'; // Menambahkan inputan 
    var fieldFILE = '<input type="file" name="data[]"/><a href="javascript:void(0);" id="remove_button">Hapus</a></div>'; // Menambahkan inputan 
    var x = 1 //Initial fieal counter 1

    $(addButton).click(function() 
    {
        console.log("Tambah X = " + x);
        // check maximum number of input fields
        if (x < maxField) {
        x++;
        $(wrapper).append(fieldHTML + fieldFILE);
        }
    });

    $(wrapper).on('click', '#remove_button', function(e)
    {
        console.log("Kurang X = " + x);

        e.preventDefault();
        $(this).parent('div').remove() // remove field html
        x--;
    })

});
</script>
@endpush

@endsection
