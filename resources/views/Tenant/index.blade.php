<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tenants') }}
            </h2>
            <x-btn-link href="{{ route('tenants.create') }}">Add Tenant</x-btn-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <table class="w-full my-5">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Domains</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($tenants as $tenant)
                            <tr>
                                <td class="border px-4 py-2"> {{$tenant->name}} </td>
                                <td class="border px-4 py-2"> {{$tenant->email}} </td>
                                <td class="border px-4 py-2">
                                    @foreach ($tenant->domains as $domain)
                                    <a href="http://{{ $domain->domain }}:8000" target="_blank" class="text-blue-600 underline">
                                        {{ $domain->domain }}
                                    </a>{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </td>
        

                                <td class="border px-4 py-2">

                                    <a class="bg-yellow-500 text-white px-4 py-2 rounded-md">Edit</a>

                                    <form class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-md">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>