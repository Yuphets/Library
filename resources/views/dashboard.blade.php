<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->role === 'admin')
                {{-- Admin Dashboard – full statistics --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Books Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-800" style="border-top-color: #003A6B;">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 truncate">Total Books</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalBooks }}</p>
                                </div>
                                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                    <svg class="h-8 w-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-sm text-gray-600">Available: {{ $availableBooks }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Members Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-800" style="border-top-color: #003A6B;">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 truncate">Total Members</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $totalMembers }}</p>
                                </div>
                                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                    <svg class="h-8 w-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Loans Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-800" style="border-top-color: #003A6B;">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 truncate">Active Loans</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $activeLoans }}</p>
                                </div>
                                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                    <svg class="h-8 w-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-sm text-red-600">Overdue: {{ $overdueLoans }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Available Books Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-800" style="border-top-color: #003A6B;">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 truncate">Available Books</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $availableBooks }}</p>
                                </div>
                                <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                    <svg class="h-8 w-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions (Admin Only) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('books.index') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-800 font-medium py-2 px-4 rounded-lg text-center transition duration-150">
                                Manage Books
                            </a>
                            <a href="{{ route('members.index') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-800 font-medium py-2 px-4 rounded-lg text-center transition duration-150">
                                Manage Members
                            </a>
                            <a href="{{ route('loans.index') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-800 font-medium py-2 px-4 rounded-lg text-center transition duration-150">
                                Manage Loans
                            </a>
                            <a href="{{ route('reports.overdue.pdf') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-800 font-medium py-2 px-4 rounded-lg text-center transition duration-150">
                                Overdue Report
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Actions (Send Notifications) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Admin Actions</h3>
                        <form action="{{ route('overdue.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Send overdue notifications to all members with overdue books?')">
                                Send Overdue Notifications
                            </button>
                        </form>
                    </div>
                </div>
          @else
    {{-- Regular User Dashboard – Available Books List with Borrow Button --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-800" style="border-top-color: #003A6B;">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Available Books</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->isbn }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->publication_year }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->available_copies }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($book->available_copies > 0)
                                    <form action="{{ route('user.loans.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm" style="background-color: #003A6B;">
                                            Borrow
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Unavailable</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No books available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
        </div>
    </div>
</x-app-layout>