{% extends "partials/body.twig.php" %}

{% block title %}Novo Produto - Mini Framework{% endblock %}

{% block body %}
<div class="max-width center-screen bg-white padding">

    <h1>Novo produto</h1>
    
    <hr>

    <form action="{{BASE}}insert-produto" method="post">
        <div class="mt-3">
            <label for="txtTitulo">Nome do produto</label>
            <input type="text" id="txtTitulo" name="txtTitulo" class="form-control" placeholder="Placa de vídeo" required>
        </div>
        
        <div class="mt-3">
            <label for="txtImagem">Imagem</label>
            <input type="text" id="txtImagem" name="txtImagem" class="form-control" placeholder="URL da imagem">
        </div>

        <div class="mt-3">
            <label for="txtDescricao">Descrição</label>
            <textarea id="txtDescricao" name="txtDescricao" class="form-control" placeholder="Descrição do produto" rows="5" required></textarea>
        </div>

        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>

</div>
{% endblock %}