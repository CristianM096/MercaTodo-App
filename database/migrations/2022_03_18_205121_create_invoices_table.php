<?php

use App\Constants\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->decimal('total', 10, 2);
            $table->string('reference');
            $table->enum('payment_status', (new PaymentStatus())->toArray());
            $table->string('payment_url');
            $table->foreignId('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('users');
            $table->foreignId('user_id')
                ->references('id')
                ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
