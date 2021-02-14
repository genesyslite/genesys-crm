<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePersonTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_types', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->timestamps();
        });

        DB::table('person_types')->insert([
            ['id'=> '1','description' => 'Interno', 'created_at'=>now(), 'updated_at'=>now()],
            ['id'=> '2','description' => 'Distribuidor', 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_types');
    }
}
