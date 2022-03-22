<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Transaction extends Model
{

    /**
     * Format Created At
     */
    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)->format('j F Y');
    }

    /**
     * Get the user that made the transaction.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the stock of the transaction
     */
    public function stock()
    {
        return $this->belongsTo('App\Stock');
    }

    /**
     * Get the fund of the transaction
     */

    public function fund()
    {
        return $this->belongsTo('App\Fund');
    }

    public function crypto()
    {
        return $this->belongsTo('App\CryptoCurrency');
    }

    public function formatPrice($price, $decimals = 2)
    {
        $currency = $this->wherefrom == 0 ? $this->stock->gcurrency : ($this->wherefrom == 1 ? $this->fund->gcurrency:$this->crypto->gcurrency);
        switch ($currency) {
            case 'USD':
                return '$' . number_format($price, $decimals);
                break;

            case 'GBP':
                return number_format(($price * 100), $decimals) . 'p';
                break;
            case 'EUR':
                return number_format(($price * 100), $decimals) . '€';
                break;

            default:
                return $price;
                break;
        }
    }
}
