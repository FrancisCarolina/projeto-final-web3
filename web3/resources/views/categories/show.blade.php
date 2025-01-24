@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<h1>{{ $category->name }}</h1>
<p><strong>Description:</strong> {{ $category->description }}</p>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
@endsection