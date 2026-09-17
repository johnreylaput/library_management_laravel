<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $authors = Author::all()->keyBy('author_name');

        $books = [
            ['title' => '1984', 'author' => 'George Orwell', 'edition' => '1st', 'year' => '1949', 'subject' => 'Fiction', 'publication' => 'Foreign'],
            ['title' => 'Brave New World', 'author' => 'Aldous Huxley', 'edition' => '1st', 'year' => '1932', 'subject' => 'Fiction', 'publication' => 'Foreign'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'edition' => 'Revised', 'year' => '1813', 'subject' => 'Fiction', 'publication' => 'Foreign'],
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'edition' => 'Reprint', 'year' => '1925', 'subject' => 'Fiction', 'publication' => 'Foreign'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'edition' => '50th Anniversary', 'year' => '1960', 'subject' => 'Fiction', 'publication' => 'Foreign'],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'edition' => 'Back Bay', 'year' => '1951', 'subject' => 'Fiction', 'publication' => 'Foreign'],
            ['title' => 'Dune', 'author' => 'Frank Herbert', 'edition' => 'Revised', 'year' => '1965', 'subject' => 'Science Fiction', 'publication' => 'Foreign'],
            ['title' => 'Foundation', 'author' => 'Isaac Asimov', 'edition' => '1st', 'year' => '1951', 'subject' => 'Science Fiction', 'publication' => 'Foreign'],
            ['title' => 'Neuromancer', 'author' => 'William Gibson', 'edition' => '1st', 'year' => '1984', 'subject' => 'Science Fiction', 'publication' => 'Foreign'],
            ['title' => 'Snow Crash', 'author' => 'Neal Stephenson', 'edition' => '1st', 'year' => '1992', 'subject' => 'Science Fiction', 'publication' => 'Foreign'],
            ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'edition' => '75th Anniversary', 'year' => '1937', 'subject' => 'Fantasy', 'publication' => 'Foreign'],
            ['title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'edition' => '50th Anniversary', 'year' => '1954', 'subject' => 'Fantasy', 'publication' => 'Foreign'],
            ['title' => 'A Game of Thrones', 'author' => 'George R.R. Martin', 'edition' => '1st', 'year' => '1996', 'subject' => 'Fantasy', 'publication' => 'Foreign'],
            ['title' => 'The Name of the Wind', 'author' => 'Patrick Rothfuss', 'edition' => '1st', 'year' => '2007', 'subject' => 'Fantasy', 'publication' => 'Foreign'],
            ['title' => 'The Way of Kings', 'author' => 'Brandon Sanderson', 'edition' => '1st', 'year' => '2010', 'subject' => 'Fantasy', 'publication' => 'Foreign'],
            ['title' => 'The Murder of Roger Ackroyd', 'author' => 'Agatha Christie', 'edition' => 'Revised', 'year' => '1926', 'subject' => 'Mystery', 'publication' => 'Foreign'],
            ['title' => 'The Hound of the Baskervilles', 'author' => 'Arthur Conan Doyle', 'edition' => 'Revised', 'year' => '1902', 'subject' => 'Mystery', 'publication' => 'Foreign'],
            ['title' => 'The Big Sleep', 'author' => 'Raymond Chandler', 'edition' => 'Reprint', 'year' => '1939', 'subject' => 'Mystery', 'publication' => 'Foreign'],
            ['title' => 'Gone Girl', 'author' => 'Gillian Flynn', 'edition' => '1st', 'year' => '2012', 'subject' => 'Mystery', 'publication' => 'Foreign'],
            ['title' => 'The Da Vinci Code', 'author' => 'Dan Brown', 'edition' => 'Special Illustrated', 'year' => '2003', 'subject' => 'Thriller', 'publication' => 'Foreign'],
            ['title' => 'The Firm', 'author' => 'John Grisham', 'edition' => '1st', 'year' => '1991', 'subject' => 'Thriller', 'publication' => 'Foreign'],
            ['title' => 'The Bourne Identity', 'author' => 'Robert Ludlum', 'edition' => '1st', 'year' => '1980', 'subject' => 'Thriller', 'publication' => 'Foreign'],
            ['title' => 'Jane Eyre', 'author' => 'Charlotte Brontë', 'edition' => 'Revised', 'year' => '1847', 'subject' => 'Romance', 'publication' => 'Foreign'],
            ['title' => 'Wuthering Heights', 'author' => 'Emily Brontë', 'edition' => 'Revised', 'year' => '1847', 'subject' => 'Romance', 'publication' => 'Foreign'],
            ['title' => 'Frankenstein', 'author' => 'Mary Shelley', 'edition' => 'Revised', 'year' => '1818', 'subject' => 'Horror', 'publication' => 'Foreign'],
            ['title' => 'Dracula', 'author' => 'Bram Stoker', 'edition' => 'Revised', 'year' => '1897', 'subject' => 'Horror', 'publication' => 'Foreign'],
            ['title' => 'A Brief History of Time', 'author' => 'Stephen Hawking', 'edition' => 'Reprint', 'year' => '1988', 'subject' => 'Science', 'publication' => 'Foreign'],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'edition' => 'Reprint', 'year' => '2011', 'subject' => 'History', 'publication' => 'Foreign'],
            ['title' => 'The Diary of a Young Girl', 'author' => 'Anne Frank', 'edition' => 'Revised', 'year' => '1947', 'subject' => 'Biography', 'publication' => 'Foreign'],
            ['title' => 'The 7 Habits of Highly Effective People', 'author' => 'Stephen Covey', 'edition' => 'Reprint', 'year' => '1989', 'subject' => 'Self-Help', 'publication' => 'Foreign'],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'edition' => '1st', 'year' => '2008', 'subject' => 'Technology', 'publication' => 'Foreign'],
            ['title' => 'Hamlet', 'author' => 'William Shakespeare', 'edition' => 'Revised', 'year' => '1603', 'subject' => 'Drama', 'publication' => 'Foreign'],
            ['title' => 'The Waste Land', 'author' => 'T.S. Eliot', 'edition' => 'Revised', 'year' => '1922', 'subject' => 'Poetry', 'publication' => 'Foreign'],
            ['title' => 'In Patagonia', 'author' => 'Bruce Chatwin', 'edition' => 'Reprint', 'year' => '1977', 'subject' => 'Travel', 'publication' => 'Foreign'],
            ['title' => 'The Wealth of Nations', 'author' => 'Adam Smith', 'edition' => 'Revised', 'year' => '1776', 'subject' => 'Economics', 'publication' => 'Foreign'],
            ['title' => 'Meditations', 'author' => 'Marcus Aurelius', 'edition' => 'Revised', 'year' => '180', 'subject' => 'Philosophy', 'publication' => 'Foreign'],
            ['title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'edition' => 'Reprint', 'year' => '2011', 'subject' => 'Psychology', 'publication' => 'Foreign'],
            ['title' => 'The Story of Art', 'author' => 'E.H. Gombrich', 'edition' => '16th Revised', 'year' => '1950', 'subject' => 'Art', 'publication' => 'Foreign'],
        ];

        foreach ($books as $bookData) {
            $author = $authors->get($bookData['author']);

            if ($author) {
                Book::firstOrCreate(
                    ['title' => $bookData['title'], 'author' => $bookData['author']],
                    [
                        'edition' => $bookData['edition'],
                        'year' => $bookData['year'],
                        'subject' => $bookData['subject'],
                        'publication' => $bookData['publication'],
                    ]
                );
            }
        }
    }
}