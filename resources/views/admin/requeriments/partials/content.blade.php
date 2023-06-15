<div class="flex w-full p-4 gap-3 md:flex-col sm:flex-col xs:flex-col ">
    <div class="flex-1">
        <div class="border-b-2 border-gray-200">
            <i class="fa-solid fa-circle-check text-sm text-green-500 mr-1"></i>
            <span class="text-bold">Requerimento de N°: {{ $requeriment->oficio_num }}</span>
        </div>
        <div class="">
            <h6 class="m-0 p-0 text-bold">Destinatário:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($requeriment->destinatario) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Cargo:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($requeriment->office) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Assunto:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($requeriment->subject) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Autuação:</h6>
            <div class="pl-2 mb-2">
                {{ date('d/m/Y H:i', strtotime($requeriment->created_at)) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Última Distribuição:</h6>
            <div class="pl-2 mb-2">
                {{ date('d/m/Y H:i', strtotime($requeriment->updated_at)) }}
            </div>

        </div>
    </div>

    <div class="flex-1">
        <div class="border-b-2 border-gray-200">
            <i class="fa-solid fa-circle-xmark text-sm text-red-500"></i>
            <span>Coordenadores</span>
        </div>

        <div class="">
            <h6 class="m-0 p-0 text-bold">Coordenador 1:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($requeriment->coord_1) }} -
                {{ ucfirst($requeriment->coord_office_1) }}
            </div>

            @if ($requeriment->coord_2 == null)
            @else
                <h6 class="m-0 p-0 text-bold">Coordenador 2:</h6>
                <div class="pl-2 mb-2">
                    {{ ucfirst($requeriment->coord_2) }} -
                    {{ ucfirst($requeriment->coord_office_2) }}
                </div>
            @endif

            @if ($requeriment->coord_3 == null)
            @else
                <h6 class="m-0 p-0 text-bold">Coordenador 3:</h6>
                <div class="pl-2 mb-2">
                    {{ ucfirst($requeriment->coord_3) }} -
                    {{ ucfirst($requeriment->coord_office_3) }}
                </div>
            @endif

        </div>
    </div>
</div>
