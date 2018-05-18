<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateStationsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('stations', function (Blueprint $table) {
                $table->increments('id');
                $table->string("name");
                $table->point("position");
                $table->string("imageurl");
                $table->unsignedInteger("userid");
                $table->timestamps();
            });

            Schema::table('stations', function (Blueprint $table) {
                $table->foreign("userid")->references('id')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('stations');
        }
    }
