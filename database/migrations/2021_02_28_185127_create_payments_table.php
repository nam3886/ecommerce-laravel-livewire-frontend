<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('client_id')->nullable();
            $table->string('secret_id')->nullable();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('code')->unique()->index();
            $table->unsignedBigInteger('price')->nullable();
            $table->text('description');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
