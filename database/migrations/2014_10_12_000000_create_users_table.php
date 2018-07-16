<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfg_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('status_id')->unsigned()->default(1);
            $table->string('last_seen_version', 20)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });

        Schema::table('cfg_users', function (Blueprint $table) {
            $table->integer('created_by')->unsigned()->nullable()->after('created_at');
            $table->integer('updated_by')->unsigned()->nullable()->after('updated_at');

            $table->foreign('created_by')->references('id')->on('cfg_users');
            $table->foreign('updated_by')->references('id')->on('cfg_users');
        });

        $this->addAdminUser();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfg_users');
    }

    protected function addAdminUser()
    {
        $now = \Carbon\Carbon::now();
        $admin_id = env('admin_id', 99);

        DB::table('cfg_users')->insert([
            'id' => env('admin_id', 99),
            'last_name' => 'IT Support',
            'first_name' => '',
            'email' => 'support@example.org',
            'password' => Hash::make('secret'),
            'remember_token' => str_random(10),
            'created_at' => $now,
            'created_by' => $admin_id,
            'updated_at' => $now,
            'updated_by' => $admin_id
        ]);
    }
}
