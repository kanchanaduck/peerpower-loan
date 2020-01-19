<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_header_id');
            $table->integer('line_no');
            $table->date('date');
            $table->decimal('payment_amount', 21, 6);
            $table->decimal('principal', 21, 6);
            $table->decimal('interest', 21, 6);
            $table->decimal('balance', 21, 6);
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
            $table->foreign('loan_header_id')
                    ->references('id')->on('loan_headers')
                    ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_lines');
    }
}
