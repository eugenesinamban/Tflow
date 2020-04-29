<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_id')->nullable();
            $table->string('name');
            $table->string('search_index');
            $table->timestamps();

            $table->foreign('field_id')->references('id')->on('fields')->onDelete('set null');
            $table->index('field_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
