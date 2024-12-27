<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold mb-4">{{$message}}</p>

                    <form method="POST"
                          action="{{ isset($item) ? route('shopping-list.update', $item->id) : route('shopping-list.store') }}">

                        <!-- If updating, use the PUT method -->
                        @csrf
                        @if(Route::currentRouteName() === 'shopping-list.edit')
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Item
                                Description</label>
                            <input type="text" id="description" name="description"
                                   value="{{ old('description', isset($item) ? $item->description : '') }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm "
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" id="quantity" name="quantity"
                                   value="{{ old('quantity', isset($item) ? $item->quantity : '') }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm "
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="price"
                                   class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" id="price" name="price"
                                   value="{{ old('price', isset($item) ? $item->price : '') }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm "
                                   required>
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                                {{ isset($item) ? 'Update Item' : 'Add Item' }}
                            </button>

                            <a href="{{ route('shopping-list.index') }}"
                               class="px-4 py-2 text-gray-700 font-semibold rounded-md">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
