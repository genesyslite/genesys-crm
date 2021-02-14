<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['customers', 'suppliers'])->index();
            $table->string('identity_document_type_id');
            $table->string('number')->index();
            $table->string('name')->index();
            $table->string('trade_name')->nullable();
            $table->char('country_id', 2)->nullable();
            $table->char('department_id', 2)->nullable();
            $table->char('province_id', 4)->nullable();
            $table->char('district_id', 6)->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('condition')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('perception_agent')->default(false);
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('person_type_id')->nullable();
            $table->json('contact')->nullable();
            $table->decimal('percentage_perception', 12, 2)->nullable();
            $table->boolean('enabled')->default(true)->index();

            $table->timestamps();
            $table->tinyInteger('status')->default(1);

            $table->foreign('identity_document_type_id')->references('id')->on('cat_identity_document_types');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('person_type_id')->references('id')->on('person_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
