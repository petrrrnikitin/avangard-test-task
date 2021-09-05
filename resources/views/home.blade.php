<?php
/* @var array $weather */
?>
@extends('layouts.app')

@section('content')
    <h1 class="h2 text-center pt-2">Панель управления</h1>
    <h4>Текущая температура в Брянске: @temperature($weather->main->temp), ощущается
        как  @temperature($weather->main->feels_like).</h4>
@endsection
