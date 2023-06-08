@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Usuários</div>

            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Adicionar Usuário</a>

                <table class="table mt-5" id="users-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td data-order="{{ now()->timestamp }}">{{ $user->created_at }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esse usuário?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Não há usuários cadastrados</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
                },
                columnDefs: [
                    {
                        targets: 2,
                        render: function(data) {
                            const date = new Date(data + 'Z');
                            return date.toLocaleString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
                        },
                        type: 'date',
                        orderDataType: 'dom-data-order',
                        orderSequence: ['desc', 'asc']
                    }
                ],
                order: [[2, 'desc']]
            });
        });
    </script>
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', '', { "toastClass": "toast-success" });
        </script>
    @endif
@endsection