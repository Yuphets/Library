<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '9780061120084',
                'publication_year' => 1960,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '9780451524935',
                'publication_year' => 1949,
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'publication_year' => 1925,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'isbn' => '9780141439518',
                'publication_year' => 1813,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'isbn' => '9780316769488',
                'publication_year' => 1951,
            ],
            [
                'title' => 'Animal Farm',
                'author' => 'George Orwell',
                'isbn' => '9780451526342',
                'publication_year' => 1945,
            ],
            [
                'title' => 'Lord of the Flies',
                'author' => 'William Golding',
                'isbn' => '9780399501487',
                'publication_year' => 1954,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'isbn' => '9780547928227',
                'publication_year' => 1937,
            ],
            [
                'title' => 'Fahrenheit 451',
                'author' => 'Ray Bradbury',
                'isbn' => '9781451673319',
                'publication_year' => 1953,
            ],
            [
                'title' => 'Moby-Dick',
                'author' => 'Herman Melville',
                'isbn' => '9780142437247',
                'publication_year' => 1851,
            ],
            [
                'title' => 'War and Peace',
                'author' => 'Leo Tolstoy',
                'isbn' => '9781400079988',
                'publication_year' => 1869,
            ],
            [
                'title' => 'The Odyssey',
                'author' => 'Homer',
                'isbn' => '9780140268867',
                'publication_year' => -800, // approximate
            ],
            [
                'title' => 'Crime and Punishment',
                'author' => 'Fyodor Dostoevsky',
                'isbn' => '9780486415871',
                'publication_year' => 1866,
            ],
            [
                'title' => 'The Brothers Karamazov',
                'author' => 'Fyodor Dostoevsky',
                'isbn' => '9780374528379',
                'publication_year' => 1880,
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'isbn' => '9780060850524',
                'publication_year' => 1932,
            ],
            [
                'title' => 'The Divine Comedy',
                'author' => 'Dante Alighieri',
                'isbn' => '9780142437223',
                'publication_year' => 1320,
            ],
            [
                'title' => 'Wuthering Heights',
                'author' => 'Emily Brontë',
                'isbn' => '9780141439556',
                'publication_year' => 1847,
            ],
            [
                'title' => 'The Iliad',
                'author' => 'Homer',
                'isbn' => '9780140275360',
                'publication_year' => -750,
            ],
            [
                'title' => 'The Picture of Dorian Gray',
                'author' => 'Oscar Wilde',
                'isbn' => '9780141439570',
                'publication_year' => 1890,
            ],
            [
                'title' => 'The Adventures of Huckleberry Finn',
                'author' => 'Mark Twain',
                'isbn' => '9780142437179',
                'publication_year' => 1884,
            ],
        ];

        foreach ($books as $bookData) {
            $totalCopies = rand(2, 10); // random copies between 2 and 10
            Book::create([
                'title' => $bookData['title'],
                'author' => $bookData['author'],
                'isbn' => $bookData['isbn'],
                'publication_year' => $bookData['publication_year'] > 0 ? $bookData['publication_year'] : null,
                'total_copies' => $totalCopies,
                'available_copies' => $totalCopies,
            ]);
        }
    }
}