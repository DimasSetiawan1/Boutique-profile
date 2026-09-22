<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLogoDimensionsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            if (!Schema::hasColumn('clients', 'logo_width')) {
                $table->unsignedInteger('logo_width')->nullable()->default(80)->comment('Custom width for client logo in px');
            }
            if (!Schema::hasColumn('clients', 'logo_height')) {
                $table->unsignedInteger('logo_height')->nullable()->default(80)->comment('Custom height for client logo in px');
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
        Schema::table('clients', function (Blueprint $table) {
            $cols = [];
            if (Schema::hasColumn('clients', 'logo_width')) $cols[] = 'logo_width';
            if (Schema::hasColumn('clients', 'logo_height')) $cols[] = 'logo_height';
            if (!empty($cols)) {
                $table->dropColumn($cols);
            }
        });
    }
}
?>
