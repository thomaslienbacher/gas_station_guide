<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateCommentsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('comments', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('userid');
                $table->unsignedInteger('stationid');
                $table->text('comment');
                $table->integer('stars');
                $table->timestamps();
            });

            Schema::table('comments', function (Blueprint $table) {
                $table->foreign("userid")->references('id')->on('users');
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
            Schema::dropIfExists('comments');
        }
    }
