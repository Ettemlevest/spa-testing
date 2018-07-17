<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Helpers\UserStamps;

class CreateCfgStatusesTable extends Migration
{
    use UserStamps;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfg_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->string('description');
            $table->unsignedSmallInteger('order');
            $table->timestamps();
        });

        $this->addCreatedByUpdatedByColumns('cfg_statuses');

        $this->addDefaultUserStatuses();
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

    protected function addDefaultUserStatuses()
    {
        $insertData = [
            // User statuses
            ['model' => App\Common\Models\User::class, 'description' => 'Active', 'order' => 1],
            ['model' => App\Common\Models\User::class, 'description' => 'Inactive', 'order' => 2],
            ['model' => App\Common\Models\User::class, 'description' => 'Archived', 'order' => 3],
        ];

        // add created/updated columns
        $now = \Carbon\Carbon::now();
        $adminUID = env('ADMIN_ID', 99);

        foreach ($insertData as $key => $row) {
            $insertData[$key]['created_at'] = $now;
            $insertData[$key]['created_by'] = $adminUID;
            $insertData[$key]['updated_at'] = $now;
            $insertData[$key]['updated_by'] = $adminUID;
        }

        DB::table('cfg_statuses')->insert($insertData);
    }
}
