@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if(isset($task))
                    Editar Tarefa
                @else
                    Criar Tarefa
                @endif
            </div>

            <div class="card-body">
                <form action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}" method="POST">
                    @csrf
                    @if(isset($task))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ isset($task) ? $task->title : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ isset($task) ? $task->description : '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        @if(isset($task))
                            Atualizar
                        @else
                            Criar
                        @endif
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
@endsection