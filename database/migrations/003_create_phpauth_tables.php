<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class
{
    public function up(): void
    {
        Capsule::schema()->create('phpauth_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->string('hash', 40);
            $table->dateTime('expiredate');
            $table->string('ip', 39);
            $table->string('device_id', 36)->nullable();
            $table->string('agent', 200);
            $table->string('cookie_crc', 40);
        });

        Capsule::schema()->create('phpauth_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 39);
            $table->dateTime('expiredate');
            $table->index('ip');
        });

        Capsule::schema()->create('phpauth_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('uid');
            $table->string('token', 20);
            $table->dateTime('expire');
            $table->enum('type', ['activation', 'reset']);
            $table->index('type');
            $table->index('token');
            $table->index('uid');
        });
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('phpauth_sessions');
        Capsule::schema()->dropIfExists('phpauth_attempts');
        Capsule::schema()->dropIfExists('phpauth_requests');
    }
};
