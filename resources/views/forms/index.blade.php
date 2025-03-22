<div class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-500 text-white text-lg font-semibold px-6 py-4">Forms</div>

        <div class="p-6">
            @if ($forms->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                    No forms found
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-lg shadow-sm">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="px-4 py-3 text-left">Form Name</th>
                                <th class="px-4 py-3 text-left">First Name</th>
                                <th class="px-4 py-3 text-left">Last Name</th>
                                <th class="px-4 py-3 text-left">Email</th>
                                <th class="px-4 py-3 text-left">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forms as $form)
                                <tr class="border-t border-gray-300 hover:bg-gray-100">
                                    <td class="px-4 py-3">{{ $form->form_name }}</td>
                                    <td class="px-4 py-3">{{ $form->first_name }}</td>
                                    <td class="px-4 py-3">{{ $form->last_name }}</td>
                                    <td class="px-4 py-3">{{ $form->email }}</td>
                                    <td class="px-4 py-3">{{ $form->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
