@php
    $viewMap = [
        'shopping-list.index' => 'shopping-list-views.index',
        'shopping-list.create' => 'shopping-list-views.form',
        'shopping-list.edit' => 'shopping-list-views.form',
    ];
@endphp

<x-app-layout>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold">Here is your shopping list.</p>
                    @include($viewMap[Route::currentRouteName()] ?? '')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
