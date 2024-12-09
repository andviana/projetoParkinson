<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Profissional') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center m-6">
                    <h1 class="text-3xl font-bold"> Cadastro</h1>

                    <a href="{{ route('profissionals.index') }}" class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    <form action="{{ route('profissionals.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="pessoa_id" class="block text-gray-700 text-sm font-bold mb-2">Pessoa:</label>
                            <select name="pessoa_id" id="pessoa_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach ($pessoas as $pessoa)
                                    <option value="{{ $pessoa->id }}">{{ $pessoa->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="denominacao" class="block text-gray-700 text-sm font-bold mb-2">Denominação:</label>
                            <input type="text" name="denominacao" id="denominacao" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="especialidade" class="block text-gray-700 text-sm font-bold mb-2">Especialidade:</label>
                            <input type="text" name="especialidade" id="especialidade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="registro" class="block text-gray-700 text-sm font-bold mb-2">Registro:</label>
                            <input type="text" name="registro" id="registro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cadastrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
