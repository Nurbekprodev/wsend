<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if(session('success'))
                    {{ session('success') }}
                @endif
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-2">
                    @foreach($files as $file)
                        <div class="flex gap-2">
                            <div>
                                {{ $file->original_name }}
                                <a 
                                    class="bg-blue-500 text-white text-sm font-bold rounded p-2 hover:opacity-75" 
                                    href="/file/{{ $file->token }}">
                                    Share
                                </a>
                            </div>

                            <div>
                                <form action="/file/{{ $file->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600" >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
