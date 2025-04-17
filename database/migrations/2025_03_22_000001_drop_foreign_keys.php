<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        try {
            // Drop foreign keys from order_items
            if (Schema::hasTable('order_items')) {
                Schema::table('order_items', function (Blueprint $table) {
                    // Get existing foreign keys
                    $foreignKeys = $this->getForeignKeys('order_items');
                    
                    // Drop foreign keys if they exist
                    if (in_array('order_items_product_id_foreign', $foreignKeys)) {
                        $table->dropForeign('order_items_product_id_foreign');
                    }
                    if (in_array('order_items_order_id_foreign', $foreignKeys)) {
                        $table->dropForeign('order_items_order_id_foreign');
                    }
                });
            }

            // Drop foreign keys from product_variants
            if (Schema::hasTable('product_variants')) {
                Schema::table('product_variants', function (Blueprint $table) {
                    $foreignKeys = $this->getForeignKeys('product_variants');
                    
                    if (in_array('product_variants_product_id_foreign', $foreignKeys)) {
                        $table->dropForeign('product_variants_product_id_foreign');
                    }
                });
            }

            // Drop foreign keys from products
            if (Schema::hasTable('products')) {
                Schema::table('products', function (Blueprint $table) {
                    $foreignKeys = $this->getForeignKeys('products');
                    
                    if (in_array('products_category_id_foreign', $foreignKeys)) {
                        $table->dropForeign('products_category_id_foreign');
                    }
                });
            }
        } finally {
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    public function down()
    {
        // Add back foreign keys if needed
        if (Schema::hasTable('products')) {
            Schema::table('products', function (Blueprint $table) {
                if (!$this->hasForeignKey('products', 'category_id')) {
                    $table->foreign('category_id')
                          ->references('id')
                          ->on('categories')
                          ->onDelete('cascade');
                }
            });
        }
        
        if (Schema::hasTable('product_variants')) {
            Schema::table('product_variants', function (Blueprint $table) {
                if (!$this->hasForeignKey('product_variants', 'product_id')) {
                    $table->foreign('product_id')
                          ->references('id')
                          ->on('products')
                          ->onDelete('cascade');
                }
            });
        }
        
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $table) {
                if (!$this->hasForeignKey('order_items', 'product_id')) {
                    $table->foreign('product_id')
                          ->references('id')
                          ->on('products')
                          ->onDelete('cascade');
                }
                if (!$this->hasForeignKey('order_items', 'order_id')) {
                    $table->foreign('order_id')
                          ->references('id')
                          ->on('orders')
                          ->onDelete('cascade');
                }
            });
        }
    }

    private function hasForeignKey($table, $column)
    {
        return DB::select("
            SELECT COUNT(*) as count
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = '{$table}'
            AND COLUMN_NAME = '{$column}'
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ")[0]->count > 0;
    }

    private function getForeignKeys($table)
    {
        return DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_TYPE = 'FOREIGN KEY'
            AND TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = '{$table}'
        ");
    }
};