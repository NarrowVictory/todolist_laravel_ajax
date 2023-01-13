<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-light text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Tambah Todo List
                </h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label" for="judul">
                        Judul
                    </label>
                    <input class="form-control" id="judul" name="judul" placeholder="Masukan judul List" type="text">
                    </input>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="deskripsi">
                        Deskripsi
                    </label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3">
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">
                    Close
                </button>
                <button onclick="tambah()" id="tambah" class="btn btn-primary" type="button">
                    Tambah
                </button>
            </div>
        </div>
    </div>
</div>