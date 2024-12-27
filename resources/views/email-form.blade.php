<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">Send Email</h2>
                    <form action="{{ route('email.send', ['id' => $id]) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="recipient" class="block text-sm font-medium text-gray-700">Recipient
                                Email</label>
                            <input
                                type="email"
                                id="recipient"
                                name="recipient"
                                class="mt-1 p-2 w-full rounded-md border-gray-300"
                                placeholder="Enter recipient's email address"
                                required
                            />
                        </div>
                        <div class="flex justify-end">
                            <button
                                type="submit"
                                class="flex justify-end bg-white text-blue-600 border border-blue-600 px-2 py-1 rounded-md hover:bg-blue-600 hover:text-white transition duration-100">
                                Send Email
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
