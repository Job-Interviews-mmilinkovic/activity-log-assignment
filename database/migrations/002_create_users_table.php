<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class
{
    public function up(): void
    {
        Capsule::schema()->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('name');
            $table->integer('role_id')->default(1);
            $table->boolean('isactive')->default(0);
            $table->timestamp('dt')->useCurrent();
        });
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('users');
    }
};
