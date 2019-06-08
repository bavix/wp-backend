<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RemoveAdminTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'admin_config',
            'admin_menu',
            'admin_operation_log',
            'admin_permissions',
            'admin_role_menu',
            'admin_role_permissions',
            'admin_role_users',
            'admin_roles',
            'admin_user_permissions',
            'admin_users',
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
