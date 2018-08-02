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
            $table->string('name');
            $table->unsignedSmallInteger('order');
            $table->auditable();

            $table->index(['model', 'order', 'name']);
            $table->unique(['model', 'name']);
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
        Schema::table('cfg_users', function (Blueprint $table) {
            $table->dropForeign('cfg_users_status_id_foreign');
        });

        Schema::dropIfExists('cfg_statuses');
    }

    protected function addDefaultStatuses()
    {
        $insertData = [
            // User statuses
            ['model' => App\Common\Models\User::class, 'name' => 'active', 'order' => 1],
            ['model' => App\Common\Models\User::class, 'name' => 'inactive', 'order' => 2],
            ['model' => App\Common\Models\User::class, 'name' => 'locked', 'order' => 3],
            ['model' => App\Common\Models\User::class, 'name' => 'archived', 'order' => 4],
        ];

        // add created/updated columns
        $now = \Carbon\Carbon::now();
        $superuserID = config('common.superuser_id', 99);

        foreach ($insertData as $key => $row) {
            $insertData[$key]['created_at'] = $now;
            $insertData[$key]['created_by'] = $superuserID;
            $insertData[$key]['updated_at'] = $now;
            $insertData[$key]['updated_by'] = $superuserID;
        }

        DB::table('cfg_statuses')->insert($insertData);
    }
}
