<div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
            <div class="modal-footer">
                <button type="button" class="bg-green-500 p-2 text-white rounded hover:bg-green-600"
                    data-bs-dismiss="modal">Fechar</button>
                <a href="{{ route('finish', ['id' => $proccesses->id]) }}" data-bs-toggle="modal"
                    data-bs-target="#finishModal" class="bg-red-500 p-2 text-white rounded hover:bg-red-600">
                    Excluir
                </a>
            </div>
        </div>
    </div>
</div>
