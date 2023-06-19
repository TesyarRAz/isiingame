<form id="modal-edit" class="modal fade" autocomplete="off" method="POST">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>x</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_kategori" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        window.action_edit = function(id) {
            let modal = $("#modal-edit");
            let url_target = `<?= site_url('admin/kategori/edit') ?>/${id}`;
            $.getJSON(url_target, function(data) {
                modal.find("input,textarea,select").val(function(index, value) {
                    if (this.type == 'checkbox' || this.type == 'radio') {
                        return value;
                    }
                    return ['_method', '_token'].includes(this.name) ? value : (data[this.name]);
                }).each(function() {
                    if (this.type == 'checkbox' || this.type == 'radio') {
                        console.log(data[this.name]);
                        $(this).prop('checked', Boolean(data[this.name]));
                    }
                    
                }).trigger("input");
                modal.attr('action', url_target);
                modal.modal();
            });
        }
    })
</script>