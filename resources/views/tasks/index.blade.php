@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Tarefas</div>

            <div class="card-body">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Adicionar Tarefa</a>

                <table class="table mt-5" id="tasks-table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th data-order="{{ now()->timestamp }}">Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir essa tarefa?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Não há tarefas cadastradas</td>
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
            $('#tasks-table').DataTable({
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