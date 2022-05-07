<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('tasks.create') ? __('Create a New') : __('Edit') }} {{ __('Task') }}
        </h2>
    </x-slot>

    <div class="py-12 xs:px-4">
        <div class="max-w-3xl mx-auto px-4 lg:px-8">
            <form action="{{ request()->routeIs('tasks.create') ? route('tasks.store') : route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @if (!request()->routeIs('tasks.create'))
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="border-t border-b border-gray-300 py-8">
                    <div class="md:w-2/3 w-full mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700">
                            Task Title
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" name="title" id="title" value="{{ $task->title }}"
                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                placeholder="Task Title">
                        </div>
                    </div>
                    <div class="md:w-2/3 w-full mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700">
                            Task Priority
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="number" min="1" name="priority" id="priority" value="{{ $task->priority }}"
                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                placeholder="Task priority">
                        </div>
                    </div>
                    <div class="md:w-2/3 w-full mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700">
                            Project Category
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select name="project_id" id="project_id" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                <option value=""></option>
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}" @if($task->project_id == $project->id) selected @endif>{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-6 sm:mt-4">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ request()->routeIs('tasks.create') ? __('Create') : __('Save') }} {{ __('Project') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
