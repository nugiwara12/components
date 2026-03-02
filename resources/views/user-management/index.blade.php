<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="w-full p-4">
            <x-user-management.table />
        </div>
    </div>
</x-app-layout>