<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

trait UserStamps {
    function addCreatedByUpdatedByColumns($tableName) {
        Schema::table($tableName, function (Blueprint $table) {
            $table->unsignedInteger('created_by')->nullable()->after('created_at');
            $table->unsignedInteger('updated_by')->nullable()->after('updated_at');

            $table->foreign('created_by')->references('id')->on('cfg_users');
            $table->foreign('updated_by')->references('id')->on('cfg_users');
        });
    }
}
