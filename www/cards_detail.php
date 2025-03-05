<?php
session_start();

require 'database.php';

if (isset($_GET['card_id'])) {
    $card_id = $_GET['card_id'];
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM Cards WHERE card_id = :card_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['card_id' => $card_id]);
    $card = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row instead of all
}

require 'header.php';
?>

<main class="bg-gray-100 min-h-[80vh] py-12">
    <div class="max-w-7xl mx-auto px-8">
        <?php if (isset($card) && $card) : ?>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="flex-1 flex flex-row">
                        <div class="w-1/2">
                            <img src="https://assets.pokemon.com/assets/cms2/img/pokedex/full/<?php echo str_pad($card['picture'], 3, '0', STR_PAD_LEFT); ?>.png" alt="<?php echo $card['name']; ?>" class="w-full h-64 object-cover">
                        </div>
                        <div class="w-1/2 pl-4">
                            <h3 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($card['name']); ?></h3>
                            <p class="text-gray-600 text-lg mb-2">Type: <?php echo htmlspecialchars($card['type']); ?></p>
                            <p class="text-gray-600 text-lg mb-2">Rarity: <?php echo htmlspecialchars($card['rarity']); ?></p>
                            <p class="text-2xl font-bold text-blue-600 mb-4">€ <?php echo number_format($card['price'], 2, ',', ''); ?></p>
                            <p>
                                <a href="add_to_cart.php?id=<?php echo $card['card_id']; ?>" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-200">Bestel</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <p class="text-xl text-gray-600 text-center">Card not found.</p>
        <?php endif; ?>
    </div>
</main>
<?php require 'footer.php'; ?>