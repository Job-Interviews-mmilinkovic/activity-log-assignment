<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class
{
    public function up(): void
    {
        Capsule::schema()->create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Capsule::table('roles')->insert([
            ['name' => 'admin'],
            ['name' => 'user'],
        ]);
    }

    public function down(): void
    {
        Capsule::schema()->dropIfExists('roles');
    }
};
