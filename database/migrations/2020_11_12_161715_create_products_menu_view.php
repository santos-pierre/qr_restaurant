<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsMenuView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE OR REPLACE VIEW products_menu AS
                      (SELECT  p.id as 'p_id', p.name as 'p_name', p.description as 'p_description', p.price as 'p_price', c.id as 'c_id', c.name as 'c_name', p.restaurant_id as 'r_id', c.`order` as 'order'
                        FROM products as p
	                    LEFT JOIN category_product as cp ON p.id = cp.id
	                    LEFT JOIN categories as c ON cp.category_id = c.id
                        ORDER BY c.`order` ASC)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW products_menu");
    }
}
