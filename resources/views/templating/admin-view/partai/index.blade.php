@extends('templating.components.master')

@section('css-page')
@endsection

@section('main-content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Partai</h5>

        @if(session('message'))
            <div class="alert alert-{{ session('message')['class'] }} alert-dismissible fade show"  role="alert">
                {{ session('message')['text'] }}
            </div>
        @endif

        <table id="example" class="display nowrap cell-border row-border" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Partai</th>
                    <th >Akronim</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parties as $item)
                    <tr>
                        <th></th>
                        <td>{{ $item->party_name }}</td>
                        <td>{{ $item->party_acronym }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection


@section('js-page')
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
               
                'copy', 'csv', 'excel', 'pdf', 'print',
            ]
        });
        function updateRowNumbers() {
            var i = 1;
            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, k) {
                cell.innerHTML = i++;
            });
        }

        table.on('order.dt search.dt', updateRowNumbers).draw();
        updateRowNumbers();

        $('#example td').css({
            'word-wrap': 'break-word',
            'white-space': 'normal',
            'text-align' : 'justify'
        });
    } );
</script>

@endsection