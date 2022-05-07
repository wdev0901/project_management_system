<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->nullable(false)->comment('Title');
            $table->unsignedBigInteger('priority')->nullable('false')->comment('Task Priority');
            $table->unsignedBigInteger('project_id')->nullable('false')->comment('Project ID');
            $table->timestamps();
            $table->softDeletes();
        });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
