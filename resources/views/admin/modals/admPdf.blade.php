<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5 text-red-500" id="exampleModalLabel">Deletando
                    Processo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="text-red-500">Atenção!</span>
                <p class="text-red-500">Tem certeza que você deseja apagar esse Processo</p>
            </div>

            <form id="pdfForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-footer">
                    <button type="button" class="bg-green-500 p-2 text-white rounded hover:bg-green-600"
                        data-bs-dismiss="modal">Fechar</button>
                    <input type="submit" value="Excluir" class="bg-red-500 p-2 text-white rounded hover:bg-red-600">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function exibirModalExclusao(id) {
        $('#pdfModal').modal('show');

        var form = document.getElementById('pdfForm');
        var rota = "{{ route('adm_deletAttachment', ['id' => ':id']) }}";

        rota = rota.replace(':id', id);
        form.setAttribute('action', rota);
    }
</script>
