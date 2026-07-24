<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repository_id')->constrained('repositories')->onDelete('cascade');
            $table->string('oai_identifier')->unique();
            $table->text('title');
            $table->longText('abstract')->nullable();
            $table->year('publication_year')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('source_url', 500);
            $table->string('pdf_url', 500)->nullable();
            $table->enum('cluster', [
                'Transportasi & Multimoda', 
                'Otomotif & Energi Terbarukan', 
                'Sistem Cerdas & Big Data', 
                'Belum Terklasifikasi'
            ])->default('Belum Terklasifikasi');
            $table->timestamps();
        });

        // Add FullText Index using raw statement for title and abstract
        DB::statement('ALTER TABLE articles ADD FULLTEXT INDEX idx_ft_title_abstract (title, abstract)');
        
        // Add normal indices
        Schema::table('articles', function (Blueprint $table) {
            $table->index('cluster');
            $table->index('publication_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
