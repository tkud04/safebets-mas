@extends('layout')

@section('title',"Welcome")

@section('banner')
@include('banner')
@stop

@section('content')
@include('cta')
@include('todays-games')
@include('guide-copy')
@include('services')
@include('ad-section')
@include('about')
@stop