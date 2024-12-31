<x-layout title="Create and Show Classroom">
    <!-- Formulário para adicionar uma nova sala -->
    <div class="text-center">
        <h1 class="text-balance text-xl font-semibold tracking-tight text-gray-900 sm:text-xl">Adicionar Nova Sala</h1>
        </div>
    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf


        <div class="sm:col-span-3">
            <label for="nr_sala" class="block text-sm/6 font-medium text-gray-900 text-xl">Sala Nr</label>
            <div class="mt-2">
              <input type="text" name="nr_sala" id="nr_sala" autocomplete="given-name" value="{{ old('nr_sala') }}" required
       class="block w-full border-2 border-blue-500 rounded-md bg-white px-4 py-2 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:outline-none sm:text-sm">
            </div>
          </div>

        <!-- Exibição de erros de validação -->
        @error('nr_sala')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror

        <br>
        <div class="mt-6 flex items-center gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
          </div>
    </form>

    <!-- Exibir a lista de salas cadastradas -->
    <div class="text-center">
        <h1 class="text-balance text-xl font-semibold tracking-tight text-gray-900 sm:text-xl">Salas disponíveis</h1>
        </div>
    @if(session('classrooms'))
        @php $classrooms = session('classrooms'); @endphp
    @else
        @php $classrooms = App\Models\Classroom::all(); @endphp
    @endif

    <!-- Tabela para mostrar as salas -->
    <table class="min-w-full table-auto border-collapse mt-6">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Ord</th>
                <th class="px-4 py-2 border-b">Número da Sala</th>
                <th class="px-4 py-2 border-b">Acções</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classrooms as $classroom)
                <tr>
                    <td class="px-4 py-2 border-b text-center">{{ $loop->iteration  }}</td>
                    <td class="px-4 py-2 border-b text-center">{{ $classroom->nr_sala }}</td>
                    <td class="px-4 py-2 border-b text-center">
                        <!-- Formulário de exclusão com id único para cada sala -->
                        <form id="delete-sala{{ $classroom->id }}" action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-500" onclick="confirmDelete({{ $classroom->id }})">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete(classroomId){
            if(confirm("Tem certeza de que deseja excluir esta sala?")){
                // Envia o formulário de exclusão do id correspondente
                document.getElementById('delete-sala' + classroomId).submit();
            }
        }
    </script>
</x-layout>
