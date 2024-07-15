<header>Animes Isekai</header>
<div class="cards">
<?php
// Função para buscar animes do gênero isekai usando a Kitsu API 
function getIsekaiAnimes() {
    $base_url = "https://kitsu.io/api/edge/anime";
    $url = "$base_url?filter[categories]=isekai&sort=-averageRating&page[limit]=10";
    
    // Faz a requisição usando file_get_contents
    $response = file_get_contents($url);
    
    // Decodifica o JSON retornado
    $data = json_decode($response, true);
    
    return $data;
}

// Exemplo de uso para exibir os cards de animes isekai
$isekai_animes = getIsekaiAnimes();

if ($isekai_animes && isset($isekai_animes['data'])) {
    foreach ($isekai_animes['data'] as $anime) {
        // Obtém o título do anime em japonês (ja_jp) se disponível, senão, em inglês (en_jp)
        if (isset($anime['attributes']['titles']['ja_jp'])) {
            $title = $anime['attributes']['titles']['ja_jp'];
        } elseif (isset($anime['attributes']['titles']['en_jp'])) {
            $title = $anime['attributes']['titles']['en_jp'];
        } else {
            $title = 'Título não disponível';
        }
        
        $synopsis = isset($anime['attributes']['synopsis']) ? substr($anime['attributes']['synopsis'], 0, 100) . '...' : 'Sinopse não disponível';
        $episodes = $anime['attributes']['episodeCount'];
        $rating = isset($anime['attributes']['averageRating']) ? $anime['attributes']['averageRating'] : 'N/A';
        $image_url = isset($anime['attributes']['posterImage']['original']) ? $anime['attributes']['posterImage']['original'] : '';

        echo '<div class="card">';
        echo '<img src="' . $image_url . '" alt="' . $title . '">';
        echo '<h2>' . $title . '</h2>';
        echo '<p>' . $synopsis . '</p>';
        echo '<p><strong>Episódios:</strong> ' . $episodes . '</p>';
        echo '<p><strong>Avaliação Média:</strong> ' . $rating . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>Nenhum anime isekai encontrado.</p>';
}
?>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">            
</head>
<body>
    <header>

    </header>
    <main>