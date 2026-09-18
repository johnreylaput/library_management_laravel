<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $existing = Schema::getColumns('theses');
        $names = array_column($existing, 'name');

        Schema::table('theses', function (Blueprint $table) use ($names) {
            if (in_array('author_id', $names)) {
                $table->dropForeign(['author_id']);
            }
            if (in_array('publisher_id', $names)) {
                $table->dropForeign(['publisher_id']);
            }
            if (in_array('category_id', $names)) {
                $table->dropForeign(['category_id']);
            }
        });

        Schema::table('theses', function (Blueprint $table) use ($names) {
            $cols = ['title', 'institution', 'pages', 'author_id', 'publisher_id', 'link', 'description', 'database_collection', 'availability', 'category_id'];
            foreach ($cols as $c) {
                if (in_array($c, $names)) {
                    $table->dropColumn($c);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('institution')->nullable()->after('research');
            $table->string('pages', 50)->nullable()->after('date_published');
            $table->unsignedBigInteger('category_id')->nullable()->after('pages');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->unsignedBigInteger('author_id')->nullable()->after('category_id');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
            $table->unsignedBigInteger('publisher_id')->nullable()->after('author_id');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('set null');
            $table->string('link', 500)->nullable()->after('publisher_id');
            $table->text('description')->nullable()->after('summary');
            $table->string('database_collection')->nullable()->after('description');
            $table->string('availability')->nullable()->after('database_collection');
        });
    }
};
