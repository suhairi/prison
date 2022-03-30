<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products Registration
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Session::has('success'))
                            <p class="alert alert-success" bgcolor="green"><font color="green">{{ Session::get('success') }}</font></p>

                    @endif
                </div>
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('admin.registerproducts') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Product Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-label for="price" :value="__('Price')" />

                            <x-input id="price" class="block mt-1 w-full" type="number" step=0.01 name="price" :value="old('price')" required />
                        </div>
                        
                        <div class="mt-4">
                            <x-button class="flex items-center justify-end mt-4" type=submit>
                                    Register Product
                            </x-button>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
