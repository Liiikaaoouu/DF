<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class ChangePermissionColumnsCollation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE permissions MODIFY name VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL');
        DB::statement('ALTER TABLE permissions MODIFY guard_name VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE permissions MODIFY name VARCHAR(191) CHARACTER SET utf8 NOT NULL');
        DB::statement('ALTER TABLE permissions MODIFY guard_name VARCHAR(191) CHARACTER SET utf8 NOT NULL');
    }
}

