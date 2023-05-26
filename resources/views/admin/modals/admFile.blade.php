<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5 text-sky-500" id="exampleModalLabel">Anexar Arquivo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('adm_attachment', ['id' => $administrative->id]) }}" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" name="administrative_collective_id" value="{{ $administrative->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                @csrf
                <div class="modal-body">
                    <x-file name="file" />

                    @error('file')
                        <span class="text-red-500 flex">{{ $message }}</span>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button" class="bg-green-500 p-2 text-white rounded hover:bg-green-600"
                        data-bs-dismiss="modal">Fechar</button>
                    <input type="submit" value="Anexar" class="bg-sky-500 p-2 text-white rounded hover:bg-sky-600">
                </div>
            </form>
        </div>
    </div>
</div>
