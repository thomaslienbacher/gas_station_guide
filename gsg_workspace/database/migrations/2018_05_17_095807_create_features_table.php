<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateFeaturesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('features', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger("stationid");
                $table->string("key");
                $table->string("value");
                $table->timestamps();
            });

            Schema::table('features', function (Blueprint $table) {
                $table->foreign("stationid")->references('id')->on('stations');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('features');
        }
    }
