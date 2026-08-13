<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [
            ['publisher_name' => 'Penguin Random House', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'HarperCollins', 'address' => '195 Broadway, New York, NY', 'contact_number' => '212-207-7000'],
            ['publisher_name' => 'Simon & Schuster', 'address' => '1230 Avenue of the Americas, New York, NY', 'contact_number' => '212-698-7000'],
            ['publisher_name' => 'Macmillan Publishers', 'address' => '120 Broadway, New York, NY', 'contact_number' => '646-638-6000'],
            ['publisher_name' => 'Hachette Book Group', 'address' => '1290 Avenue of the Americas, New York, NY', 'contact_number' => '212-364-1100'],
            ['publisher_name' => 'Oxford University Press', 'address' => '198 Madison Avenue, New York, NY', 'contact_number' => '212-726-6000'],
            ['publisher_name' => 'Cambridge University Press', 'address' => '32 Avenue of the Americas, New York, NY', 'contact_number' => '212-337-5000'],
            ['publisher_name' => 'Wiley', 'address' => '111 River Street, Hoboken, NJ', 'contact_number' => '201-748-6000'],
            ['publisher_name' => 'McGraw-Hill Education', 'address' => '2525 NOL, New York, NY', 'contact_number' => '212-904-2000'],
            ['publisher_name' => 'Pearson Education', 'address' => '221 River Street, Hoboken, NJ', 'contact_number' => '201-236-7000'],
            ['publisher_name' => 'Scholastic Corporation', 'address' => '557 Broadway, New York, NY', 'contact_number' => '212-505-3000'],
            ['publisher_name' => 'Bloomsbury Publishing', 'address' => '1385 Broadway, New York, NY', 'contact_number' => '212-419-5300'],
            ['publisher_name' => 'Scribner', 'address' => '1230 Avenue of the Americas, New York, NY', 'contact_number' => '212-698-7000'],
            ['publisher_name' => 'Bantam Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Ace Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'DAW Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Tor Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Knopf', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Vintage Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'W.W. Norton', 'address' => '500 Fifth Avenue, New York, NY', 'contact_number' => '212-555-0100'],
            ['publisher_name' => 'Crown Publishing', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Riverhead Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'MIT Press', 'address' => 'One Rogers Street, Cambridge, MA', 'contact_number' => '617-625-8400'],
            ['publisher_name' => 'Harvard University Press', 'address' => '79 Garden Street, Cambridge, MA', 'contact_number' => '617-495-2600'],
            ['publisher_name' => 'University of Chicago Press', 'address' => '1427 E. 60th Street, Chicago, IL', 'contact_number' => '773-702-7700'],
            ['publisher_name' => 'Addison-Wesley', 'address' => '75 Arlington Street, Boston, MA', 'contact_number' => '617-848-7000'],
            ['publisher_name' => 'Prentice Hall', 'address' => '1 Lake Street, Upper Saddle River, NJ', 'contact_number' => '201-236-7000'],
            ['publisher_name' => 'Cengage Learning', 'address' => '200 Pier 4 Boulevard, Boston, MA', 'contact_number' => '617-289-7700'],
            ['publisher_name' => 'New World Library', 'address' => '14 Pamaron Way, Novato, CA', 'contact_number' => '415-884-2100'],
            ['publisher_name' => 'Basic Books', 'address' => '1290 Avenue of the Americas, New York, NY', 'contact_number' => '212-364-1100'],
            ['publisher_name' => 'Beacon Press', 'address' => '24 Beacon Street, Boston, MA', 'contact_number' => '617-742-2110'],
            ['publisher_name' => 'Phaidon Press', 'address' => '65 Bleecker Street, New York, NY', 'contact_number' => '212-759-0909'],
            ['publisher_name' => 'AoPS Inc', 'address' => '2846 Marburg Avenue, Columbus, OH', 'contact_number' => '614-447-7777'],
            ['publisher_name' => 'Chapman and Hall', 'address' => '2-6 Boundary Row, London, UK', 'contact_number' => '+44-20-7777-7000'],
            ['publisher_name' => 'Delacorte Press', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Grand Central Publishing', 'address' => '345 Hudson Street, New York, NY', 'contact_number' => '212-699-9000'],
            ['publisher_name' => 'Back Bay Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Presidio Press', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Liveright Publishing', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Pantheon Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'DC Comics', 'address' => '1700 Broadway, New York, NY', 'contact_number' => '212-656-1000'],
            ['publisher_name' => 'Vintage', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Farrar, Straus and Giroux', 'address' => '120 Broadway, New York, NY', 'contact_number' => '646-638-6000'],
            ['publisher_name' => 'Random House', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Liverpool University Press', 'address' => '4 Cambridge Street, Liverpool, UK', 'contact_number' => '+44-151-794-2233'],
            ['publisher_name' => 'Bloomsbury Academic', 'address' => '1385 Broadway, New York, NY', 'contact_number' => '212-419-5300'],
            ['publisher_name' => 'Da Capo Press', 'address' => '44 Cambridge Street, Boston, MA', 'contact_number' => '617-584-8388'],
            ['publisher_name' => 'Viking', 'address' => '1875 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Anchor Books', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'G.P. Putnam\'s Sons', 'address' => '345 Hudson Street, New York, NY', 'contact_number' => '212-699-9000'],
            ['publisher_name' => 'Doubleday', 'address' => '1745 Broadway, New York, NY', 'contact_number' => '212-366-2000'],
            ['publisher_name' => 'Richard Marek Publishers', 'address' => '200 Madison Avenue, New York, NY', 'contact_number' => '212-685-6400'],
            ['publisher_name' => 'Putnam', 'address' => '345 Hudson Street, New York, NY', 'contact_number' => '212-699-9000'],
            ['publisher_name' => 'Little, Brown', 'address' => '1290 Avenue of the Americas, New York, NY', 'contact_number' => '212-364-1100'],
            ['publisher_name' => 'Houghton Mifflin', 'address' => '215 Park Avenue South, New York, NY', 'contact_number' => '212-566-8200'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::firstOrCreate(
                ['publisher_name' => $publisher['publisher_name']],
                $publisher
            );
        }
    }
}
