<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfgStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfg_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model', 100);
            $table->string('description');
            $table->unsignedSmallInteger('order');
            $table->auditable();

            $table->index(['model', 'order', 'description']);
            $table->unique(['model', 'description']);
        });

        $this->addDefaultStatuses();

        Schema::table('cfg_users', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('cfg_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfg_statuses');
    }

    protected function addDefaultStatuses()
    {
        $insertData = [
            // User statuses
            ['model' => App\Common\Models\User::class, 'description' => 'Active', 'order' => 1],
            ['model' => App\Common\Models\User::class, 'description' => 'Inactive', 'order' => 2],
            ['model' => App\Common\Models\User::class, 'description' => 'Locked', 'order' => 3],
            ['model' => App\Common\Models\User::class, 'description' => 'Archived', 'order' => 4],
        ];

        // add created/updated columns
        $now = \Carbon\Carbon::now();
        $superuserID = env('SUPERUSER_ID', 99);

        foreach ($insertData as $key => $row) {
            $insertData[$key]['created_at'] = $now;
            $insertData[$key]['created_by'] = $superuserID;
            $insertData[$key]['updated_at'] = $now;
            $insertData[$key]['updated_by'] = $superuserID;
        }

        DB::table('cfg_statuses')->insert($insertData);
    }
}
