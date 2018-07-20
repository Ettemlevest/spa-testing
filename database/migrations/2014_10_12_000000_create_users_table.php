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
            $table->timestamp('password_changed_at');
            $table->rememberToken();
            $table->unsignedInteger('status_id')->default(1);
            $table->string('last_seen_version', 20)->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->auditable();

            $table->index(['password_changed_at']);
        });

        $this->addSuperUser();
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

    /**
     * Add first user (SuperUser) to the users table.
     *
     * @return void
     */
    protected function addSuperUser()
    {
        $now = \Carbon\Carbon::now();
        $superuserID = env('SUPERUSER_ID', 99);

        DB::table('cfg_users')->insert([
            'id' => env('SUPERUSER_ID', 99),
            'last_name' => 'IT Support',
            'first_name' => '',
            'email' => 'support@example.org',
            'password' => Hash::make('secret'),
            'password_changed_at' => $now,
            'remember_token' => str_random(10),
            'created_at' => $now,
            'created_by' => $superuserID,
            'updated_at' => $now,
            'updated_by' => $superuserID
        ]);
    }
}
