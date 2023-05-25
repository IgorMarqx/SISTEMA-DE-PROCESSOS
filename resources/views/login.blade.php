@extends('layout.app')

@section('title', 'SINDJUF - LOGIN')

@section('content')
    <div class="h-[38rem] w-screen flex justify-center items-center">

        <div class="w-[26rem] md:m-3 xs:m-4">
            <div class="mb-8 mr-6 flex flex-col justify-center items-center xs:mr-0">
                <img class="w-[12rem] mr-10 mb-8 " src="assets/img/logoSind.png" alt="">
                <h3 class="font-bold text-xl md:text-[1rem] xs:text-[1rem]"><span class="text-red-500">SGP</span> - Sistema de
                    Gestão Processual</h3>
            </div>

            <div>
                <form action="{{ route('login_action') }}" method="POST">
                    @csrf
                    <div>

                        <label for="email">
                            E-mail <span class="text-red-500">*</span>
                        </label>

                        <input id="email" type="text"
                            class="form-control w-full rounded px-2 py-1.5 outline-none border border-solid
                             border-slate-300 focus:border focus:border-red-300 transition ease-in-out
                             duration-600  @error('email') @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Informe seu e-mail" autofocus>

                        @error('email')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="mt-5">
                        <label for="password">
                            Senha <span class="text-red-500">*</span>
                        </label>

                        <div class="flex">
                            <input id="password" type="password"
                                class="form-control w-full rounded-s-md px-2 py-1.5
                                 outline-none border border-solid border-slate-300 focus:border
                                 focus:border-red-300 transition ease-in-out duration-600
                                 @error('password') @enderror"
                                name="password" placeholder="Informe sua senha" autofocus>


                            <span
                                class="form-control w-10 rounded-e form-control p-1
                                 outline-none border border-solid border-slate-300 flex items-center justify-center">
                                <img onclick="eyeClick()" id="eye" src="assets/img/eye-open.svg" width="20px"
                                    alt="eye">
                            </span>
                        </div>
                        @error('password')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex">
                        <button type="submit"
                            class="w-full rounded-md text-white p-2 mt-5 bg-red-500 hover:bg-red-600 bg-red-500
                            transition ease-in-out duration-600">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
