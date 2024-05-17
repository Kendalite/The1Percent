@extends('layouts.admin')

@section('content')
    <div class="flex flex-col gap-6 justify-between pb-8 max-w-8xl mx-auto">
        <div class="flex items-center justify-end">
            <a href="{{ route('admin.question.create') }}" class="new-button rounded-normal py-2 px-3">
                Ajouter une question
            </a>
        </div>
        <!-- Message de l'équipe -->
        <section class="bg-white w-full rounded-normal py-8 px-8 relative">
            <div class="rounded-normal text-white">
                <p class="font-semibold">Toutes les ressources</p>
            </div>
            <div class="rounded-normal">
                <div
                    class="min-w-full overflow-x-auto rounded border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <!-- Table -->
                    <table class="min-w-full whitespace-nowrap align-middle text-sm">
                        <!-- Table Header -->
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                <th
                                    class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                    Titre
                                </th>
                                <th
                                    class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                    Auteur
                                </th>
                                <th
                                    class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                    Catégorie
                                </th>
                                <th
                                    class="bg-gray-100/75 px-3 py-4 text-left font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                    Statistiques
                                </th>
                                <th
                                    class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($aoItems) > 0)
                                @foreach ($aoItems as $ressource)
                                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                        <td class="p-3 text-left">
                                            <p class="font-medium">{{ $ressource->question_title }}</p>
                                        </td>
                                        <td class="p-3">
                                            <p class="font-medium">{{ $ressource->question_level }}</p>
                                        </td>
                                        <td class="p-3">
                                            <p class="font-medium">{{ $ressource->question_level }}</p>
                                        </td>
                                        <td class="p-3">
                                            <p class="font-medium">{{ $ressource->visit }}</p>
                                        </td>
                                        <td class="p-3 text-center">
                                            <a href="{{ route('admin.ressources.view', $ressource->id) }}"
                                                class="rounded-normal text-white text-sm font-semibold py-1 px-3">
                                                Modifier
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                                    <td class="p-3 text-left">
                                        <p class="font-medium">Vous n'avez pas encore de questions</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @if ( $aoItems->hasPages() )
            <div class="mt-5">
                {{ $aoItems->links() }}
            </div>
        @endif
    </div>
@endsection
