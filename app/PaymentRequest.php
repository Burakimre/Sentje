<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentRequest extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'created_by_user_id',
		'to_user_id',
		'deposit_account_id',
		'currencies_id',
		'requested_amount',
		'description',
		'request_type',
		'payment_url',
		'success_url',
		'mollie_id',
		'media',
		'title',
		'date_due'
	];

	public function created_by_user()
	{
		return $this->belongsTo(User::class);
	}

	public function to_user()
	{
		return $this->belongsTo(User::class, 'to_user_id', 'id');
	}

	public function account()
	{
		return $this->hasOne(Account::class, 'id', 'deposit_account_id');
	}

	public function payment()
	{
		return $this->belongsTo(Payment::class);
	}

	public function currency()
	{
		return $this->belongsTo(Currency::class, 'currencies_id');
	}
}
