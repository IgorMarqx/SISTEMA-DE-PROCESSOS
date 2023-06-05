<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header ">
            <h3 class="card-title">Meus Processos</h3>
        </div>

        <div class="card-body table-responsive p-0 m-0 w-full">

            <table class="table table-hover table-valign-middle mb-2">
                <thead>
                    <tr>
                        <th class="text-center">Nome do processo</th>
                        <th class="text-center">Status do processo</th>
                        <th class="text-center">Detalhes do processo</th>
                        <th class="text-center">Detalhes do processo</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"></td>
                        <x-status textCenter="text-center" color="bg-primary">
                            <i class="fa-solid fa-gavel text-xs mr-1"></i>
                            Andamento
                        </x-status>
                        <x-status textCenter="text-center" color="bg-success">
                            <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                            Atualizado
                        </x-status>

                        <td class="text-center">
                                <a href="">
                                    <i class="fa-solid fa-file-lines text-sm mr-1"></i>
                                    Detalhes
                                </a>
                            </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
