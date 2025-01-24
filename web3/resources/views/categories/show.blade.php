@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<h1>{{ $category->name }}</h1>
<p><strong>Descrição:</strong> {{ $category->description }}</p>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Voltar</a>
@endsection