<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->bigInteger("owner_id")->default(1);
            $table->string("shopify_url");
            $table->string("domain");
            $table->string("access_token");
            $table->string("status", 50)->default("normal");
            $table->timestamps();
	        $table->softDeletes();
            $table->unique(["shopify_url","deleted_at"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
