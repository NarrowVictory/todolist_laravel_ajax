@extends('layout.layout')

@push('css')
<style type="text/css">
    .card :hover{
    background-color: #8AFF8A;
    cursor: pointer;
    color: black;
}
</style>
@endpush()

@section('content')
<div class="input-group my-4">
    <input aria-describedby="button-addon2" aria-label="Recipient's username" class="form-control" id="key" placeholder="Cari Tugas" type="text">
        <button class="btn btn-success" data-bs-target="#exampleModal" data-bs-toggle="modal" id="button-addon2" type="button">
            Tambah List
        </button>
    </input>
</div>
<div class="list" id="container-list">
</div>
@includeIf('tugas.modal')
@includeIf('tugas.modal-task')
@endsection

@push('js')
<script src="http://code.jquery.com/jquery-1.11.0.min.js">
</script>
<script>
    dataTugas();
function dataTugas(){
    $.ajax({
        type:'GET',
        url:'{{ route('tugas.data') }}',
        dataType:'json',
        success: function(response){
            $('#container-list').html("");
            if (response.length != 0) {
                $.each(response, function(key, item){
                    let s = item.status == 1 ? 'bg-secondary text-white' : '';
                    $('#container-list').append(`
                    <div class="card mb-2 ${s}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>
                                        ${ item.judul }
                                    </h6>
                                        ${ item.deskripsi }
                                </div>
                                <div class="col-md-6 text-end">
                                    <div aria-label="Basic example" class="btn-group" role="group">
                                        <button onclick="status(${item.id_tugas})" class="btn btn-success btn-sm" type="button">
                                            <i class="fa-solid fa-check">
                                            </i>
                                        </button>
                                        <button class="btn btn-warning btn-sm" data-bs-target="#detail" id="edit" onclick="show(${item.id_tugas})" data-bs-toggle="modal" type="button">
                                            <i class="fa-solid fa-pen-to-square">
                                            </i>
                                        </button>
                                        <button onclick="hapus(${item.id_tugas})" class="btn btn-danger btn-sm" type="button">
                                            <i class="fa-solid fa-trash">
                                            </i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                })
            }
        }
    })
}

function dataDetail(id_tugas){
    $.ajax({
        type:'GET',
        url: "{{ url('/todolist') }}/" + id_tugas,
        dataType:'json',
        success: function(response){
            $('#list-check').html("");
            if (response.detail_tugas.length != 0) {
                $.each(response.detail_tugas, function(key, item){
                    let s = item.status == 1 ? 'checked' : '';
                    $('#list-check').append(`
                    <li class="list-group-item bg-dark text-white">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input value="${item.id_detail_tugas}" ${s} class="form-check-input position-static" id="blankCheckbox" onclick="statusList(${item.id_detail_tugas}, ${item.id_tugas})" type="checkbox" value="option1">
                                        <label class="form-check-label" for="">
                                            ${item.detail_tugas}
                                        </label>
                                    </input>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <a onclick="hapusDetail(${item.id_detail_tugas}, ${item.id_tugas})" class="text-decoration-none text-danger" href="javascript::void">
                                    <i class="fa fa-minus">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </li>
                    `);
                })
            }
        }
    })
}

function tambah(){
    let judul = $("#judul").val();
    let deskripsi = $("#deskripsi").val();

    var data = {
        'judul': judul,
        'deskripsi': deskripsi
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "{{ route('tugas.store') }}",
        data: data,
        dataType: "json",
        success: function (response){
            if (response.status == 200) {
                $("#judul").val("");
                $("#deskripsi").val("");
                $(".modal").removeClass("show");
                $(".modal").css('display', 'none');
                $(".modal-backdrop").remove();
                $("body").removeAttr('class');
                $("body").removeAttr('style');
                $("#tambah").attr('onclick', 'tambah()');
                dataTugas();
            }
        }
    })
}

function status(id_tugas){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: "{{ url('/todolistStatus') }}/" + id_tugas,
        dataType: "json",
        success: function (response){
            if (response.status == 200) {
                dataTugas();
            }
        }
    })

}

function hapus(id_tugas){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: "DELETE",
        url: "{{ url('/todolist') }}/" + id_tugas,
        dataType: "json",
        success: function (response){
            if (response.status == 200) {
                dataTugas();
            }
        }
    })
}

function show(id_tugas){
    $.ajax({
        type: "GET",
        url: "{{ url('/todolist') }}/" + id_tugas,
        dataType: "json",
        success: function(response){
            $("#id_tugas").val(response.id_tugas)
            $("#detail-judul").val(response.judul)
            $("#detail-deskripsi").val(response.deskripsi)
            $('#list-check').html("")

            if (response.detail_tugas.length != 0) {
                dataDetail(response.id_tugas);
            }else{
                $('#list-check').append(`
                    <div class="alert alert-danger text-center">
                    <h5>Belum ada detail list</h5>
                    </div>
                `)
            }
        }
    })
}

function ubah(){
    let id = $("#id_tugas").val();
    let judul = $("#detail-judul").val();
    let deskripsi = $("#detail-deskripsi").val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: "{{ url('/todolist') }}/" + id,
        data : {
            id_tugas:id,judul:judul,deskripsi:deskripsi
        },
        dataType: "json",
         success: function (response){
            if (response.status == 200) {
                $("#judul").val("");
                $("#deskripsi").val("");
                $(".modal").removeClass("show");
                $(".modal").css('display', 'none');
                $(".modal-backdrop").remove();
                $("body").removeAttr('class');
                $("body").removeAttr('style');
                $("#update").attr('onclick', 'ubah()');
                dataTugas();
            }
        }
    })


}

function statusList(id_detail_tugas, id_tugas){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: "{{ url('/detail-tugas') }}/" + id_detail_tugas,
        dataType: "json",
        success: function(response){
            if (response.status == 200) {
                dataDetail(id_tugas);
                dataTugas();
            }
        },

    })
}

function tambahList(){
    let list = $('#list').val();
    let id_tugas = $('#id_tugas').val();

     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

     var data = {
        "detail_tugas" : list,
        "id_tugas" : id_tugas,
     }

    $.ajax({
        type: "POST",
        url: "{{ route('detail.store') }}",
        data: data,
        dataType: "json",
        success: function (response){
            if (response.status == 200) {
                $('#list').val("");
                dataDetail(id_tugas);
            }
        }
    })
}

function hapusDetail(id_detail_tugas,id_tugas){
 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

 $.ajax({
        type: "DELETE",
        url: "{{ url('/detail-tugas') }}/" + id_detail_tugas,
        dataType: "json",
        success: function (response){
            if (response.status == 200) {
                dataDetail(id_tugas);
            }
        }
    })
}

$('#key').on('keyup', function(){
let key = $(this).val();
$.ajax({
        type:'GET',
        url:'{{ route('tugas.data') }}',
        data: {key:key},
        dataType:'json',
        success: function(response){
            $('#container-list').html("");
            if (response.length != 0) {
                $.each(response, function(key, item){
                    let s = item.status == 1 ? 'bg-secondary text-white' : '';
                    $('#container-list').append(`
                    <div class="card mb-2 ${s}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>
                                        ${ item.judul }
                                    </h6>
                                        ${ item.deskripsi }
                                </div>
                                <div class="col-md-6 text-end">
                                    <div aria-label="Basic example" class="btn-group" role="group">
                                        <button onclick="status(${item.id_tugas})" class="btn btn-success btn-sm" type="button">
                                            <i class="fa-solid fa-check">
                                            </i>
                                        </button>
                                        <button class="btn btn-warning btn-sm" data-bs-target="#detail" onclick="show(${item.id_tugas})" data-bs-toggle="modal" type="button">
                                            <i class="fa-solid fa-pen-to-square">
                                            </i>
                                        </button>
                                        <button onclick="hapus(${item.id_tugas})" class="btn btn-danger btn-sm" type="button">
                                            <i class="fa-solid fa-trash">
                                            </i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                })
            }else if(response.length == 0){
                $('#container-list').append(`
                    <div class="alert alert-danger text-center">
                    <h5>Data Tidak Ditemukan</h5>
                    </div>
                `);
            }else{
                dataTugas();
            }
        }
    })
});
</script>
@endpush()
