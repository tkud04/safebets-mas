@extends('layout')

@section('title',"Dashboard")

@section('banner')
@include('dashboard-banner')
@stop

@section('content')
@include('dashboard-content',['tokenBalance' => $tokenBalance,'totalBetSlipsPurchased' => $totalBetSlipsPurchased])
@include('ad-section')
@include('todays-games')
@stop