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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekly_worklog_id')->nullable()
                ->constrained('weekly_worklogs')->onDelete('cascade');

            $table->foreignId('final_slide_id')->nullable()
                ->constrained('final_slides')->onDelete('cascade');

            $table->foreignId('final_report_id')->nullable()
                ->constrained('final_reports')->onDelete('cascade');
            $table->integer('weekly_worklog_score')->nullable();
            $table->integer('final_slide_score')->nullable();
            $table->integer('final_report_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
