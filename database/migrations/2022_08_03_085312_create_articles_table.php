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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('source_id')->nullable();
            $table->string('source_name')->nullable();
            $table->string('author')->default('default');
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('img_url');
            $table->mediumText('description');
            $table->longText('content')->default('');
            $table->dateTime('published_at');
            $table->boolean('breaking')->default(false);
            $table->string('breaking_text')->nullable()->default('Breaking News');
            $table->string('color')->default('#eb1515');
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
        Schema::dropIfExists('articles');
    }
};
