<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDimensionsToClientProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_products', function (Blueprint $table) {
            if (!Schema::hasColumn('client_products', 'width')) {
                $table->unsignedInteger('width')->nullable()->default(120)->comment('Custom width for product image in px');
            }
            if (!Schema::hasColumn('client_products', 'height')) {
                $table->unsignedInteger('height')->nullable()->default(100)->comment('Custom height for product image in px');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_products', function (Blueprint $table) {
            $cols = [];
            if (Schema::hasColumn('client_products', 'width')) $cols[] = 'width';
            if (Schema::hasColumn('client_products', 'height')) $cols[] = 'height';
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
}
