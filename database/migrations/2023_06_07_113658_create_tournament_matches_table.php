<?php

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
        Schema::create('tournament_matches', function (Blueprint $table) {
            $table->id();

            $table->string("round");

            $table->integer("team_1_score")->default(0);
            $table->foreignIdFor(\App\Models\Team::class, 'team_1_id');

            $table->integer("team_2_score")->default(0);
            $table->foreignIdFor(\App\Models\Team::class, 'team_2_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_matches');
    }
};
