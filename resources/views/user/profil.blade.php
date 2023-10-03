<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 ">

                    <form method="POST" action="{{ route('user.update') }}"
                        class="space-y-4 grid grid-cols-1 sm:grid-cols-2 gap-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Image Input with Custom Styling -->
                        <div class="col-span-2 flex justify-center items-center">
                            <div class="mb-4 relative">
                                <!-- Tambahkan ikon pensil atau ikon lainnya -->
                                <i onclick="triggerFileInput()"
                                    class="absolute text-[12px] right-0 bottom-0 mt-1 mr-1 fa fa-pencil aspect-square w-[30px] flex items-center justify-center rounded-full bg-white border-2 cursor-pointer"></i>
                                <img src="{{ Storage::url($userInfo->image) }}"  alt="Preview Image" id="imagePreview"
                                    class="w-32 h-32 object-cover rounded-full border-2 shadow-lg">
                                <!-- Sembunyikan input file asli -->
                                <input type="file" id="image" name="image" accept="image/*"
                                    onchange="previewImage(event)" class="hidden">
                            </div>
                        </div>

                        <!-- Name Input -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Position Input -->
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                            <input type="text" id="position" name="position" value="{{ $userInfo->position ?? '' }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Save Button -->
                        <div class="col-span-2">
                            <x-button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md font-semibold text-white focus:outline-none focus:ring-2 focus:ring-offset-2 ">
                                Save
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function triggerFileInput() {
        const fileInput = document.getElementById('image');
        fileInput.click();
    }

    // Fungsi untuk menampilkan pratinjau gambar
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            // Tampilkan gambar placeholder jika tidak ada gambar yang dipilih
            imagePreview.src = '{{ asset('placeholder-image.png') }}';
        }
    }
</script>
