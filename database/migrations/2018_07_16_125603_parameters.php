<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Parameters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfg_parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category', 100);
            $table->string('name', 100);
            $table->string('value', 500);
            $table->string('default_value', 500);
            $table->string('role')->nullable()->comment('Comma separated list of user roles needed for CRUD operations');
            $table->auditable();

            $table->index(['category', 'name', 'role']);
            $table->unique(['category', 'name']);
        });

        $this->addDefaultParameters();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfg_parameters');
    }

    /**
     * Adding default parameters to the table.
     *
     * @return void
     */
    protected function addDefaultParameters()
    {
        $now = \Carbon\Carbon::now();
        $superuserID = config('common.superuser_id', 99);

        // example:
        // DB::table('cfg_parameters')->insert([
        //     [
        //         'category' => '',
        //         'name' => '',
        //         'description' => '',
        //         'value' => '',
        //         'default_value' => '',
        //         'role' => null,
        //         'created_at' => $now,
        //         'created_by' => $superuserID,
        //         'updated_at' => $now,
        //         'updated_by' => $superuserID
        //     ]
        // ]);
    }
}
