<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->string('order_code')->unique()->index();
            $table->string('delivery_order_code')->unique()->index()->nullable();

            $table->unsignedInteger('items_count');
            $table->unsignedInteger('total_price');
            $table->unsignedInteger('discount_price');
            $table->unsignedInteger('tax_price');
            $table->unsignedInteger('sub_total');
            $table->unsignedInteger('grand_total'); // exclude delivery fee
            $table->unsignedInteger('order_total'); // include delivery fee
            $table->unsignedFloat('exchange_rate')->default(1);
            $table->json('exchange_currency')->nullable();
            // 0: unprocessed
            // 1: success => order created
            // 2: canceled => order not created yet
            $table->unsignedTinyInteger('order_success')->default(0);
            $table->boolean('is_paid')->default(false);
            $table->string('transaction_number')->nullable();
            $table->string('bank_tran_number')->nullable();
            $table->string('bank_code')->nullable();

            $table->string('name');
            $table->string('phone');
            $table->unsignedInteger('delivery_service_id');
            $table->unsignedInteger('delivery_fee');
            $table->unsignedInteger('cod_amount')->nullable(); // tiền thu hộ
            $table->tinyInteger('person_pay_delivery_fee')->default(1);  // 1: Shop/Seller, 2: Buyer/Consignee.
            $table->string('address');
            $table->json('api_address');
            $table->string('note')->nullable();
            $table->enum('required_note', [
                'CHOTHUHANG',
                'CHOXEMHANGKHONGTHU',
                'KHONGCHOXEMHANG',
            ])->default('KHONGCHOXEMHANG');

            $table->string('status')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
