<div class="flex w-full p-4 gap-3 md:flex-col sm:flex-col xs:flex-col ">
    <div class="flex-1">
        <div class="border-b-2 border-gray-200">
            <i class="fa-solid fa-circle-check text-sm text-green-500 mr-1"></i>
            <span class="text-bold"></span>
        </div>
        <div class="">
            <h6 class="m-0 p-0 text-bold">Nome do Autor:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($user->name) }}
            </div>

            <h6 class="m-0 p-0 text-bold">E-mail do Autor:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($user->email) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Autuação:</h6>
            <div class="pl-2 mb-2">
                @if ($user->created_at == null)
                    <span class="text-red-500">Data não informada</span>
                @else
                    {{ date('d/m/Y H:i', strtotime($user->created_at)) }}
                @endif
            </div>
        </div>
    </div>
    <div class="flex-1">
        <div class="border-b-2 border-gray-200">
            <i class="fa-solid fa-circle-xmark text-sm text-red-500"></i>
            <span></span>
        </div>

        <div class="">
            <h6 class="m-0 p-0 text-bold">Orgão:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($user->organ) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Cargo:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($user->office) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Lotação:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($user->capacity) }}
            </div>

            <h6 class="m-0 p-0 text-bold">Telefone:</h6>
            <div class="pl-2 mb-2">
                {{ ucfirst($user->telephone) }}
            </div>

        </div>
    </div>
</div>
