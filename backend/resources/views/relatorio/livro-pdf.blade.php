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
            <th>Título</th>
            <th>Editora</th>
            <th>Edição</th>
            <th>Ano Publicação</th>
            <th>Autor</th>
            <th>Assunto</th>
        </tr>
        @foreach($livro as $item)
        <tr>
            <td>{{ $item["Codl"] }}</td>
            <td>{{ $item["Titulo"] }}</td>
            <td>{{ $item["Editora"] }}</td>
            <td>{{ $item["Edicao"] }}</td>
            <td>{{ $item["AnoPublicacao"] }}</td>
            @if(count($item["autor"]) > 0)
                <?php $nomeAutor = "" ?>
                @foreach($item["autor"] as $autor)
                    <?php $nomeAutor .= $autor["Nome"] . ', ' ?>
                @endforeach
                <td>{{ $nomeAutor }}</td>
            @endif
            @if(count($item["assunto"]) > 0 && isset($item["assunto"][0]))
                <td>{{ $item["assunto"][0]["Descricao"] }}</td>
            @endif
        </tr>
        @endforeach
    </table>

</body>
</html>
