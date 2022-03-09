<?php
namespace App\Services;

use App\MutualFund;
use App\MutualFundPrice;

use Carbon\Carbon;

class CustomFundData
{

    /**
     * Finds latest price for fund
     *
     * @param string $symbol
     * @return float
     */
    function price($symbol)
    {

        /**
         * Find Fund
         */
        $fund = MutualFund::query()
            ->where('symbol', $symbol)
            ->first();

        /**
         * Return Mutual Fund Price
         */
        return MutualFundPrice::query()
            ->where('mutual_fund_id', $fund->id)
            ->latest()
            ->first()
            ->price;

    }

    /**
     * Returns change percentage for mutual fund
     * @param  string $symbol
     * @return mixed
     */
    function changePercentage($symbol)
    {

        /**
         * Find Mutual Fund
         */
        $fund = MutualFund::query()
            ->where('symbol', $symbol)
            ->first();

        /**
         * Get Yesterdays Price
         */
        $fund_price_yesterday = MutualFundPrice::query()
            ->where('mutual_fund_id', $fund->id)
            ->where('date', Carbon::yesterday())
            ->first();

        /**
         * Get Todays Price
         */
        $fund_price_today = MutualFundPrice::query()
            ->where('mutual_fund_id', $fund->id)
            ->where('date', Carbon::today())
            ->first();

        /**
         * Show change percentage if both are available
         */
        if(isset($fund_price_today) && isset($fund_price_yesterday)){

            return (1 - floatval($fund_price_yesterday->price) / floatval($fund_price_today->price));

        } else {

            return 0;

        }

    }

    /**
     * Prepare chart
     *
     * @param  string $symbol
     * @param  string $range
     * @return array
     */
    function chart($symbol, $range)
    {

        /**
         * Determine start and end date
         */
        switch ($range) {

            case '1m':
                $start_date = Carbon::now()->subMonths(1);
                $end_date = Carbon::now();
            break;

            case '3m':
                $start_date = Carbon::now()->subMonths(3);
                $end_date = Carbon::now();
            break;

            case '6m':
                $start_date = Carbon::now()->subMonths(3);
                $end_date = Carbon::now();

            case 'ytd':
                $start_date = Carbon::now()->startOfYear();
                $end_date = Carbon::now();
            break;

            case '1y':
                $start_date = Carbon::now()->subYears(1);
                $end_date = Carbon::now();
            break;

            case '2y':
                $start_date = Carbon::now()->subYears(2);
                $end_date = Carbon::now();
            break;

            case '5y':
                $start_date = Carbon::now()->subYears(5);
                $end_date = Carbon::now();
            break;

            default:
                return [];
            break;

        }

        /**
         * Find Mutual Fund
         */
        $fund = MutualFund::query()
            ->where('symbol', $symbol)
            ->first();

        /**
         * Get all mutual fund prices between those dates
         */
        $prices = MutualFundPrice::query()
            ->where('mutual_fund_id', $fund->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item, $key) {
                return [
                    'date' => $item->date->toDateString(),
                    'fClose' => floatval($item->price),
                ];
            });

        /**
         * Return Prices
         */
        return $prices;

    }
}
