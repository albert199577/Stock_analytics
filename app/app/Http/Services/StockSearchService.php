<?php
namespace App\Http\Services;

class StockSearchService
{
    public function priceGreater(int $price,array $data)
    {
        foreach ($data as $key => $value) {
            $lastDayPrice = count($value) - 1;
            if ($value[$lastDayPrice]['close'] < $price) unset($data[$key]);
        }
        return $data;
    }

    public function priceLess(int $price,array $data)
    {
        foreach ($data as $key => $value) {
            $lastDayPrice = count($value) - 1;
            if ($value[$lastDayPrice]['close'] > $price) unset($data[$key]);
        }
        return $data;
    }

    public function gainByWeekend(int $weekend,int $percent, array $data)
    {
        $days = $weekend * 5;
        foreach ($data as $key => $fewStock) {
            $argGain = $this->ArgGainByDay($days, $fewStock);
            if ($argGain < $percent) unset($data[$key]);
        }
        return $data;
    }
    
    public function tradingVolume (int $day, int $volume, array $data)
    {
        foreach ($data as $key => $fewStock) {
            $count = count($fewStock);
            $tradingVolumeSum = 0;
            if ($count < $day) continue;
            for ($i = $count - $day; $i < $count; $i ++) {
                $tradingVolumeSum += $fewStock[$i]['Trading_Volume'];
            }
            if ($tradingVolumeSum < $volume) unset($data[$key]);
        }
        return $data;
    }

    public function bull (int $s_ma, int $m_ma, int $l_ma,int $close_price, array $data)
    {
        $day = $close_price;

        foreach ($data as $key => $fewStock) {
            $count = count($fewStock);
            $s = 0;
            $m = 0;
            $l = 0;
            $temp = [];
            foreach ($fewStock as $k => $v) {
                $temp[$k] = $v['close'];
            }
            
            for ($i = $count - $day; $i < $count; $i ++) {
                $s_arr = array_slice($temp, $i-$s_ma+1, $s_ma);
                $s = round(array_sum($s_arr) / $s_ma, 2);

                $m_arr = array_slice($temp, $i-$m_ma+1, $m_ma);
                $m = round(array_sum($m_arr) / $m_ma, 2);

                $l_arr = array_slice($temp, $i-$l_ma+1, $l_ma);
                $l = round(array_sum($l_arr) / $l_ma, 2);

                if ($s < $m || $s < $l || $m < $l) unset($data[$key]);
            }
        }
        return $data;
    }

    public function sideway(int $percent, int $weekend, array $data)
    {
        $days = $weekend * 5;
        foreach ($data as $key => $fewStock) {
            $argGain = $this->ArgGainByDay($days, $fewStock);
            // echo "<pre>";
            // print_r($fewStock[0]['stock_id']);
            // echo PHP_EOL;
            // print_r($argGain);
            // echo "</pre>";

            $positive = $percent / 2;
            $negative = $positive * -1;

            if ($argGain < $positive || $argGain > $negative) unset($data[$key]);
        }
        return $data;
    }

    public function ArgGainByDay(int $day, array $data)
    {
        $count = count($data);
        $gain = 0;
        if ($count < $day) return;

        for ($i = $count - $day; $i < $count; $i ++) {
            $temp = $data[$i-1]['close'] * $data[$i]['spread'] / 100;
            $gain += round($temp, 2);
        }
        $argGain = round($gain / $day, 2);

        // return $gain;
        return $argGain;
    }
}

