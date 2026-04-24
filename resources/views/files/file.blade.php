<x-app-layout>
    <div  class="flex justify-center min-h-screen items-center">
        <div class="flex justify-center gap-4 items-center">
            <h2>{{ $file->original_name }}</h2>

            <a 
                href="/download/{{ $file->token }}"
                class=" bg-blue-500 text-white text-sm font-bold rounded p-2 hover:opacity-75" >
                Download
            </a>       
        </div>
    </div>

</x-app-layout>