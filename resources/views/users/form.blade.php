@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                @if(isset($user))
                    Editar Usuário
                @else
                    Criar Usuário
                @endif
            </div>

            <div class="card-body">
                <form action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" method="POST">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? $user->name : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        @if(isset($user))
                            Atualizar
                        @else
                            Criar
                        @endif
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', '', { "toastClass": "toast-error" });
            @endforeach
        </script>
    @endif
@endsection