<?php
session_start();
require 'database.php';

$sql = "SELECT * FROM Cards";
$stmt = $conn->query($sql);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);

require 'vendor/autoload.php';

use Carbon\Carbon;

printf("Now: %s", Carbon::now());

require 'header.php';
?>

<div class="bg-blue-600 text-white py-20 px-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-5xl font-bold mb-4">Welkom bij mijn Pokémon Verzameling</h1>
        <p class="text-xl">Ontdek de wonderlijke wereld van Pokémon en bekijk mijn uitgebreide collectie!</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-8 py-12">
    <h2 class="text-3xl font-bold mb-8">Mijn Favoriete Pokémon</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($cards as $card) : ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">

                <div class="p-6">
                    <div class="w-1/2 mx-auto mb-4">
                        <img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/<?php echo str_pad($card['picture'], 3, '0', STR_PAD_LEFT); ?>.png" alt="<?php echo $card['name'] ?>" class="w-full object-contain">
                    </div>
                    <h3 class="text-xl font-bold mb-2"><?php echo $card['name']; ?></h3>
                    <p class="text-gray-600 mb-4">Type: <?php echo $card['type']; ?></p>
                    <p class="text-gray-600 mb-4">Rarity: <?php echo $card['rarity']; ?></p>
                    <p class="text-gray-600 mb-4">Price: <?php echo number_format($card['price'], 2, ',', '') ?> $ </p>
                    <a href="cards_detail.php?card_id=<?php echo $card['card_id']; ?>" class="inline-block bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Meer informatie →</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>







<?php require 'footer.php'; ?>