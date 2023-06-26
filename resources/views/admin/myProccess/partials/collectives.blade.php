<div class="col-lg-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Judicial Coletivo</h3>
        </div>

        <div class="table-responsive">
            @if ($judicialCollective->isEmpty())
                <div class="p-2 flex justify-center items-center">
                    <p class="text-md m-0 text-sky-500 font-bold">Você não possui nenhum processo !</p>
                </div>
            @else
                <table class="table table-hover table-valign-middle">
                    <tr>
                        <th class="text-center">Processo N°</th>
                        <th class="text-center">Classe Judicial</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ações</th>
                    </tr>

                    @foreach ($judicialCollective as $judicial)
                        <tr>
                            <td class="text-center">{{ $judicial->id }}</td>
                            <td class="flex justify-center items-center">
                                <p class="text-center truncate overflow-ellipsis w-[10rem] m-0">{{ $judicial->name }}</p>
                            </td>
                            @if ($judicial->progress_collective == 1)
                                <x-status textCenter="text-center" color="bg-primary">
                                    <i class="fa-solid fa-gavel text-xs mr-1"></i>
                                    Andamento
                                </x-status>
                            @else
                            @endif
                            <td class="text-center"></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>

    </div>
</div>

<div class="col-lg-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Administrativo Coletivo</h3>
        </div>

        <div class="table-responsive">
            @if ($administrativeCollective->isEmpty())
                <div class="p-2 flex justify-center items-center">
                    <p class="text-md m-0 text-sky-500 font-bold">Você não possui nenhum processo !</p>
                </div>
            @else
                <table class="table table-hover table-valign-middle">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            @endif
        </div>

    </div>
</div>
