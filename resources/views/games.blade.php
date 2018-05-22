@extends('layout')

@section('title',"Games")

@section('content')
@include('ad-section')
@include('todays-games')
@include('regular-games')
@include('premium-games')
@stop