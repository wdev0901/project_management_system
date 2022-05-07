<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        @if (count($projects) < 1)
                            <h3 class="text-lg w-full text-center">There are no tasks</h3>
                        @else
                        <div class="flex">
                            <label for="project" class="w-1/4 px-6 py-3">Select your Project</label>
                            <select name="project_id" id="project_id" onchange="applyFilter()" class="w-1/2 flex-1 block rounded-md sm:text-sm border-gray-300">
                                <option value=""></option>
                                @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                </div>
                @if (!count($projects) < 1)
                <div class="p-6 bg-white border-b border-gray-200 task-list">
                    <div class="flex flex-col">
                        <div class="flex-grow overflow-auto">
                            <table class="relative w-full border table-fixed">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Task Name</th>
                                        <th class="px-6 py-3 w-1/2 text-gray-900 bg-gray-100">Priority</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y" id="task_list">
                                </tbody>
                            </table>
                        </div>
                        <h3 class="text-lg w-full text-center py-3 nothing">There are no tasks</h3>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    var csrf_val = "{{ csrf_token() }}";
    var url = "{{ route('filter') }}";
</script>