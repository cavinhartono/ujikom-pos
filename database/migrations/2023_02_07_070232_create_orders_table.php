<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('order_index');
            $table->integer('price');
            $table->integer('return');
            $table->integer('accept');
            $table->timestamps();
        });

        Schema::table('orders', function () {
            DB::unprepared("
                    CREATE TRIGGER `getIdOrder` BEFORE INSERT ON `orders`
                    FOR EACH ROW BEGIN
                    INSERT INTO orders_prefix VALUES (NULL);
                    SET NEW.order_index = CONCAT('SC', LPAD(LAST_INSERT_ID(), 4, '0'));
                    END
            ");
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
};
