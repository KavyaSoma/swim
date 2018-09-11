@extends('layouts.main')
@section('content')

<div id="perf_div" style="width:800px;height:800px;"></div>

{!! \Lava::render('ColumnChart', 'Finances', 'perf_div') !!}

@endsection('content')