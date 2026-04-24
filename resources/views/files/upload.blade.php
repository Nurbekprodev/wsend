<x-app-layout>


    <div class="flex justify-center items-center py-4 mt-10">

        <div class="w-[400px]  border border-white/10 rounded-xl p-4 bg-white/50">

            <h2 class="text-sm font-bold text-black text-center mb-4">
                Upload File
            </h2>

            <form action="/upload" method="POST" enctype="multipart/form-data" class="space-y-3 ">
                @csrf

                <input 
                    type="file" 
                    name="file"
                    class="w-full text-black text-xs"
                >

                <button 
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-60 text-white text-sm font-bold py-1.5 rounded-lg"
                >
                    Upload
                </button>

            </form>
        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p class="text-red-500 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif
         
        @if (session('success'))
            <div>
                <p class="text-green-800 text-sm">
                    {{ session('success') }}
                </p>
            </div>
        @endif

    </div>

</x-app-layout>