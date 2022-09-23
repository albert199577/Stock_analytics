@extends('layouts.app')

@section('title', '個股資訊')

@section('content')

<ul>
    <li>{{ $data[1]['date'] }}</li>
    <li>{{ $data[1]['stock_id'] }}</li>
    <li>交易量 {{ $data[1]['Trading_Volume'] }}</li>
    <li>交易金額 {{ $data[1]['Trading_money'] }}</li>
    <li>開盤價 {{ $data[1]['open'] }}</li>
    <li>最高 {{ $data[1]['max'] }}</li>
    <li>最低 {{ $data[1]['min'] }}</li>
    <li>收盤 {{ $data[1]['close'] }}</li>
    <li>漲幅 {{ $data[1]['spread'] }}</li>
    <li> {{ $data[1]['Trading_turnover'] }}</li>
</ul>
<div>
    <canvas id="myChart" width="400" height="400"></canvas>
</div>
<script src="https://d3js.org/d3.v7.min.js"></script>
{{-- <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script> --}}
<script>
    
    chart = CandlestickChart(aapl, {
        date: d => d.Date,
        high: d => d.High,
        low: d => d.Low,
        open: d => d.Open,
        close: d => d.Close,
        yLabel: "↑ Price ($)",
        width,
        height: 500
    })
    d = <? $data;?>
    console.log(d);
</script>
@endsection