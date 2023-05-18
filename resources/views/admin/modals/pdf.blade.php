<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5 text-sky-500" id="exampleModalLabel">PDF - {{ $attachments->id }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 300px; width: 100px;">
               <p>Tem certeza que deseja excluir esse anexo?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="bg-green-500 p-2 text-white rounded hover:bg-green-600"
                    data-bs-dismiss="modal">Fechar</button>
                <input type="submit" value="Excluir" class="bg-sky-500 p-2 text-white rounded hover:bg-sky-600">
            </div>
            </form>
        </div>
    </div>
</div>
