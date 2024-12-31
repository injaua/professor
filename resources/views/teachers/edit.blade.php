<x-layout title="Edit Teacher">
    <div class="container mx-auto mt-8">

        <!-- Mensagem de Erro Geral -->
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <strong>There were some errors with your submission:</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário de Edição -->
        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="space-y-4">
            @csrf <!-- Token de segurança -->
            @method('PUT') <!-- Método PUT para atualização -->

            <!-- Nome -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name"
                       class="block mt-2 w-full border-2 border-blue-500 rounded-md bg-white px-4 py-2 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:outline-none sm:text-sm"
                       value="{{ old('name', $teacher->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Disciplina -->
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Disciplina</label>
                <input type="text" name="subject" id="subject"
                       class="block mt-2 w-full border-2 border-blue-500 rounded-md bg-white px-4 py-2 text-base text-gray-900 outline-none placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500 focus:outline-none sm:text-sm"
                       value="{{ old('subject', $teacher->subject) }}" required>
                @error('subject')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Classroom -->
            <div>
                <label for="classroom" class="block text-sm font-medium text-gray-700">Classrooms</label>
                <select name="classroom[]" id="classroom"
                        class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" multiple required>
                    <option value="" disabled>Select classrooms</option>
                    @foreach ($classroom as $class)
                        <option value="{{ $class->id }}"
                                {{ in_array($class->id, old('classroom', $teacher->classrooms->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $class->nr_sala }}
                        </option>
                    @endforeach
                </select>
                @error('classroom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botão de Enviar -->
            <div>
                <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update Teacher
                </button>
            </div>
        </form>
    </div>
</x-layout>
