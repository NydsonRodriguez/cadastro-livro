<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
</head>
<body>
    <h3>{{ $title }}</h3>
    <p>Relatório gerado em: {{ $date }}</p>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
        @foreach($autor as $item)
        <tr>
            <td>{{ $item->CodAu }}</td>
            <td>{{ $item->Nome }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
