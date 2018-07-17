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
            $table->string('name');
            $table->string('description');
            $table->string('value', 500);
            $table->string('default_value', 500);
            $table->boolean('admin')->default(1);
            $table->timestamps();
        });

        Schema::table('cfg_parameters', function (Blueprint $table) {
            $table->unsignedInteger('created_by')->nullable()->after('created_at');
            $table->unsignedInteger('updated_by')->nullable()->after('updated_at');

            $table->foreign('created_by')->references('id')->on('cfg_users');
            $table->foreign('updated_by')->references('id')->on('cfg_users');
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
        $admin_id = env('admin_id', 99);

        // example:
        // DB::table('cfg_parameters')->insert([
        //     [
        //         'category' => '',
        //         'name' => '',
        //         'description' => '',
        //         'value' => '',
        //         'default_value' => '',
        //         'admin' => 0,
        //         'created_at' => $now,
        //         'created_by' => $admin_id,
        //         'updated_at' => $now,
        //         'updated_by' => $admin_id
        //     ]
        // ]);
    }
}
