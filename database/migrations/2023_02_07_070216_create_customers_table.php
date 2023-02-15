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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_index');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        Schema::table('customers', function () {
            DB::unprepared("
                    CREATE TRIGGER `getIdCustomer` BEFORE INSERT ON `customers`
                    FOR EACH ROW BEGIN
                    INSERT INTO customers_prefix VALUES (NULL);
                    SET NEW.customer_index = CONCAT('C', LPAD(LAST_INSERT_ID(), 4, '0'));
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
        Schema::dropIfExists('customers');
    }
};
