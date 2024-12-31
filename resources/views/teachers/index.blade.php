<x-layout title="Teacher">

    <br>
    <!-- Formulário de edicao com id único para cada professor -->
    <a href="{{ route('teachers.create') }}"
    class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-600">
    Adicionar Professor
 </a>


    <div class="text-center">
        <h1 class="text-balance text-3xl font-semibold tracking-tight text-gray-900 sm:text-3xl">Professores</h1>
        </div>
    @if(session('teachers'))
        @php $teachers = session('teachers'); @endphp
    @else
        @php $teachers = App\Models\Teacher::all(); @endphp
    @endif

    <!-- Tabela para mostrar as salas -->
    <table class="min-w-full table-auto border-collapse mt-6">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Ord</th>
                <th class="px-4 py-2 border-b">Nome do professor</th>
                <th class="px-4 py-2 border-b">Disciplina</th>
                <th class="px-4 py-2 border-b">Salas</th>
                <th class="px-4 py-2 border-b">Acções</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $teacher)
                <tr>
                    <td class="px-4 py-2 border-b text-center">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border-b text-center">{{ $teacher->name }}</td>
                    <td class="px-4 py-2 border-b text-center">{{ $teacher->subject }}</td>
                    <td class="px-4 py-2 border-b text-center">
                        @if($teacher->classrooms->isNotEmpty())
                            {{ $teacher->classrooms->pluck('nr_sala')->join(', ') }}
                        @else
                            <span class="text-gray-500">Nenhuma sala associada</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b text-center">
                         <!-- Link para editar o professor -->
                         <a href="{{ route('teachers.edit', $teacher->id) }}" class="text-green-500">Editar</a>
                        <!-- Formulário de exclusão com id único para cada sala -->
                        <form id="delete-prof{{ $teacher->id }}" action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-500" onclick="confirmDelete({{ $teacher->id }})">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete(teacherId){
            if(confirm("Tem certeza de que deseja excluir este professor?")){
                // Envia o formulário de exclusão do id correspondente
                document.getElementById('delete-prof' + teacherId).submit();
            }
        }
    </script>

    </x-layout>
