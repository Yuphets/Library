<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Loan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('loans.update', $loan) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="book_id" class="block text-gray-700 text-sm font-bold mb-2">Book <span class="text-red-500">*</span></label>
                            <select name="book_id" id="book_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('book_id') border-red-500 @enderror" required>
                                <option value="">Select a book</option>
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id', $loan->book_id) == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} (Available: {{ $book->available_copies }})
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="member_id" class="block text-gray-700 text-sm font-bold mb-2">Member <span class="text-red-500">*</span></label>
                            <select name="member_id" id="member_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('member_id') border-red-500 @enderror" required>
                                <option value="">Select a member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id', $loan->member_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="borrowed_at" class="block text-gray-700 text-sm font-bold mb-2">Borrowed Date <span class="text-red-500">*</span></label>
                            <input type="date" name="borrowed_at" id="borrowed_at" value="{{ old('borrowed_at', $loan->borrowed_at->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('borrowed_at') border-red-500 @enderror" required>
                            @error('borrowed_at') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="due_at" class="block text-gray-700 text-sm font-bold mb-2">Due Date <span class="text-red-500">*</span></label>
                            <input type="date" name="due_at" id="due_at" value="{{ old('due_at', $loan->due_at->format('Y-m-d')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('due_at') border-red-500 @enderror" required>
                            @error('due_at') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="returned_at" class="block text-gray-700 text-sm font-bold mb-2">Returned Date</label>
                            <input type="date" name="returned_at" id="returned_at" value="{{ old('returned_at', $loan->returned_at ? $loan->returned_at->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('returned_at') border-red-500 @enderror">
                            @error('returned_at') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status <span class="text-red-500">*</span></label>
                            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror" required>
                                <option value="borrowed" {{ old('status', $loan->status) == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                <option value="returned" {{ old('status', $loan->status) == 'returned' ? 'selected' : '' }}>Returned</option>
                            </select>
                            @error('status') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="background-color: #003A6B;">
                                Update Loan
                            </button>
                            <a href="{{ route('loans.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800" style="color: #003A6B;">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>