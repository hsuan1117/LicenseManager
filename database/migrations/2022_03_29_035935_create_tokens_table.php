<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->string('content');
            $table->string('name');
            $table->ipAddress('activated_ip')->nullable();
            $table->text('activated_uname')->nullable();
            $table->longText('activated_cpu')->nullable();
            $table->bigInteger('activated_limit')->default(1);
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('tokens');
    }
};
