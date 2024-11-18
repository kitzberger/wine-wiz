<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flavours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->unique();
        });

        // Land
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->unique();
        });

        // Weinbaugebiet
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unique(['name', 'country_id']);
        });

        // Ortschaft
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unique(['name', 'region_id', 'country_id']);
        });

        // Winzer
        Schema::create('winemakers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unique(['name', 'country_id']);
        });

        // Rebsorte
        Schema::create('grapes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->unique();
        });

        Schema::create('wines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name'); // Weinbezeichnung
            $table->string('selling_price')->nullable(); // Preis
            $table->string('purchase_price')->nullable(); // Einkaufspreis
            $table->year('vintage')->nullable(); // Jahrgang
            $table->string('plu')->nullable(); // PLU
            $table->float('bottle_size'); // Gebinde
            $table->float('alcohol')->nullable(); // Alkoholgehalt
            $table->float('acidity')->nullable(); // Säure
            $table->float('sugar')->nullable(); // Süße (in g)
            $table->string('sweetness')->nullable(); // Süße (in human readable)
            $table->string('quality')->nullable(); // Qualität: Bio, Biodyn, etc.
            $table->string('tannin')->nullable(); // Gerbstoff
            $table->string('maturation')->nullable(); // Ausbau
            $table->text('info')->nullable(); // Zusatzinfos
            $table->integer('style')->nullable(); // Weinstil
            #$table->string('Farbe'); // Farbe
            #$table->string('Passt'); // Passt

            $table->unsignedBigInteger('winemaker_id')->nullable();
            $table->foreign('winemaker_id')->references('id')->on('winemakers'); // Winzer

            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries'); // Country

            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions'); // Region

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities'); // Ortschaft

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories'); // Weingattung
        });

        // Aromen
        Schema::create('wine_flavour', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('wine_id')->constrained()->onDelete('cascade');
            $table->foreignId('flavour_id')->constrained()->onDelete('cascade');
        });

        // Aromen
        Schema::create('wine_grape', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->smallInteger('percentage')->nullable();
            $table->foreignId('wine_id')->constrained()->onDelete('cascade');
            $table->foreignId('grape_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wine_flavour');
        Schema::dropIfExists('wine_grape');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('flavours');
        Schema::dropIfExists('grapes');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('wines');
    }
};
