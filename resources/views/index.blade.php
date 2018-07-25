@extends('layout')

@section('title',"Welcome")

@section('banner')
@include('banner')
@stop

@section('content')
@include('cta')
@include('services')
@include('todays-games')
@include('guide-copy')
@include('premium-games')
@include('ad-section')
@include('regular-games')
@include('about')
@stop