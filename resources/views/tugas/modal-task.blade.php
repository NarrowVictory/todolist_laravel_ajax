<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Update Todo List
                </h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="judul">
                        Judul
                    </label>
                    <input type="hidden" name="id_tugas" id="id_tugas">
                    <input class="form-control" id="detail-judul" name="judul" placeholder="Masukan judul List" type="text">
                    </input>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="deskripsi">
                        Deskripsi
                    </label>
                    <textarea class="form-control" id="detail-deskripsi" name="deskripsi">
                    </textarea>
                </div>
                <div>
                    <hr/>
                </div>
                <div class="row">
                    <div class="col-10 text-end">
                        <label class="visually-hidden" for="list">
                            Tambah List
                        </label>
                        <input class="form-control" id="list" name="list" placeholder="Tambah List" type="text">
                        </input>
                    </div>
                    <div class="col-2 text-end">
                        <button onclick="tambahList()" class="btn btn-success" type="button">
                            <i class="fa fa-plus">
                            </i>
                            Tambah
                        </button>
                    </div>
                </div>
                <div>
                    <hr/>
                </div>
                <ul class="list-group" id="list-check">
                    
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                    Close
                </button>
                <button id="update" onclick="ubah()" class="btn btn-primary" type="button">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>