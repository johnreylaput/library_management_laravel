<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            DB::statement("ALTER TABLE borrow_records RENAME TO borrow_records_old");
            DB::statement("
                CREATE TABLE borrow_records (
                    id integer primary key autoincrement not null,
                    member_id integer not null,
                    book_id integer,
                    borrowed_by integer,
                    borrow_date date not null,
                    due_date date not null,
                    status varchar not null default ('Borrowed'),
                    remarks text,
                    created_at datetime,
                    updated_at datetime,
                    journal_id integer,
                    thesis_id integer,
                    foreign key(\"borrowed_by\") references users(\"id\") on delete set null on update no action,
                    foreign key(\"book_id\") references books(\"id\") on delete cascade on update no action,
                    foreign key(\"member_id\") references members(\"id\") on delete cascade on update no action,
                    foreign key(\"journal_id\") references \"journals\"(\"id\") on delete set null,
                    foreign key(\"thesis_id\") references \"theses\"(\"id\") on delete set null
                )
            ");
            DB::statement("INSERT INTO borrow_records SELECT * FROM borrow_records_old");
            DB::statement("DROP TABLE borrow_records_old");
        } else {
            Schema::table('borrow_records', function (Blueprint $table) {
                $table->foreignId('book_id')->nullable()->constrained()->cascadeOnDelete()->change();
            });
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            DB::statement("ALTER TABLE borrow_records RENAME TO borrow_records_old");
            DB::statement("
                CREATE TABLE borrow_records (
                    id integer primary key autoincrement not null,
                    member_id integer not null,
                    book_id integer not null,
                    borrowed_by integer,
                    borrow_date date not null,
                    due_date date not null,
                    status varchar not null default ('Borrowed'),
                    remarks text,
                    created_at datetime,
                    updated_at datetime,
                    journal_id integer,
                    thesis_id integer,
                    foreign key(\"borrowed_by\") references users(\"id\") on delete set null on update no action,
                    foreign key(\"book_id\") references books(\"id\") on delete cascade on update no action,
                    foreign key(\"member_id\") references members(\"id\") on delete cascade on update no action,
                    foreign key(\"journal_id\") references \"journals\"(\"id\") on delete set null,
                    foreign key(\"thesis_id\") references \"theses\"(\"id\") on delete set null
                )
            ");
            DB::statement("INSERT INTO borrow_records SELECT * FROM borrow_records_old");
            DB::statement("DROP TABLE borrow_records_old");
        } else {
            Schema::table('borrow_records', function (Blueprint $table) {
                $table->foreignId('book_id')->constrained()->cascadeOnDelete()->change();
            });
        }
    }
};