<div class="col-lg-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Judicial Individual</h3>
        </div>

        <div class="table-responsive">
            @if ($judicialIndividual->isEmpty())
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

<div class="col-lg-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Administrativo Individual</h3>
        </div>

        <div class="table-responsive">
            @if ($administrativeIndividual->isEmpty())
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
