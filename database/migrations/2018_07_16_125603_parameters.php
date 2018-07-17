<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\UserStamps;

class Parameters extends Migration
{
    use UserStamps;

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
            $table->string('description');
            $table->string('value', 500);
            $table->string('default_value', 500);
            $table->string('role', 100)->nullable()->comment('User role needed for CRUD operations');
            $table->timestamps();

            $table->index(['category', 'name', 'role']);
            $table->unique(['category', 'name']);
        });

        $this->addCreatedByUpdatedByColumns('cfg_parameters');

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
        //         'role' => null,
        //         'created_at' => $now,
        //         'created_by' => $admin_id,
        //         'updated_at' => $now,
        //         'updated_by' => $admin_id
        //     ]
        // ]);
    }
}
