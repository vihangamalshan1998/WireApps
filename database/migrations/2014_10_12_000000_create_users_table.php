<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [User::TYPE_ADMIN, User::TYPE_TEACHER, User::TYPE_STUDENT, User::TYPE_USER]);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dob')->nullable(); // date of birth
            $table->string('email')->unique();
            $table->string('password');
            $table->string('qualification')->nullable();
            $table->string('class')->nullable();
            $table->string('subject')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
