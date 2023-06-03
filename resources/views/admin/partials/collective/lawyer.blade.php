<div class="flex w-full p-4 gap-3 md:flex-col sm:flex-col xs:flex-col ">
    <div class="flex-1">
        <div class="border-b-2 border-gray-200">
            <i class="fa-solid fa-circle-check text-sm text-green-500 mr-1"></i>
            <span class="text-bold">Polo Ativo</span>
        </div>

        <div class="text-bold">
            {{ strtoupper($user->name) }} - CPF: {{ $user->cpf }} (AUTOR)
        </div>

        <div class="pl-2">
            @if ($data[0] == null)
            @else
                <p class="m-0"><i class="fa-solid fa-user-tie text-sm"></i>
                    {{ strtoupper($data[0]) }} - OAB: {{ $lawyer['lawyer_1'] }} - (ADVOGADO)
                </p>
            @endif

            @if ($data[1] == null)
            @else
                <p class="m-0"><i class="fa-solid fa-user-tie text-sm"></i>
                    {{ strtoupper($data[1]) }} - OAB: {{ $lawyer['lawyer_2'] }} - (ADVOGADO)
                </p>
            @endif

            @if ($data[2] == null)
            @else
                <p class="m-0"><i class="fa-solid fa-user-tie text-sm"></i>
                    {{ strtoupper($data[2]) }} - OAB: {{ $lawyer['lawyer_3'] }} - (ADVOGADO)
                </p>
            @endif

            @if ($data[3] == null)
            @else
                <p class="m-0"><i class="fa-solid fa-user-tie text-sm"></i>
                    {{ strtoupper($data[3]) }} - OAB: {{ $lawyer['lawyer_4'] }} - (ADVOGADO)
                </p>
            @endif
        </div>
    </div>

    <div class="flex-1">
        <div class="border-b-2 border-gray-200">
            <i class="fa-solid fa-circle-xmark text-sm text-red-500"></i>
            <span>Polo Passivo</span>
        </div>

        <div class="text-bold">
            @foreach ($defendants as $defendant)
                {{ strtoupper($defendant->defendant) }} - CNPJ: {{ $defendant->cnpj }} (REU)
            @endforeach
        </div>
    </div>
</div>
