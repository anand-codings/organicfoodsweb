<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->longText('description')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('timezone')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('fb_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('since')->nullable();
            $table->boolean('is_web')->default(0);
            $table->enum('type', ['user', 'farmer']);
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('language')->nullable();
            $table->string('account_status')->nullable();
            $table->string('stripe_payout_account_id')->nullable();
            $table->string('stripe_payout_account_public_key')->nullable();
            $table->string('stripe_payout_account_secret_key')->nullable();
            $table->string('stripe_payout_account_info')->nullable();
            $table->string('exp_month')->nullable();
            $table->string('exp_year')->nullable();
            $table->string('card_id')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->boolean('is_bank_account_verified')->default(0);
            $table->boolean('is_online')->default(1);
            $table->boolean('is_active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
