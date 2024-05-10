<?php
session_start();

$supported_languages = ['en', 'it'];
$default_language = 'en';

if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $supported_languages)) {
    $current_language = $_COOKIE['lang'];
} else {
    $current_language = $default_language;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "session";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connessione fallita: " . $e->getMessage());
}

function translate($label_key, $conn, $current_language)
{
    $query = "SELECT $current_language FROM labels WHERE label_key = :label_key";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':label_key', $label_key);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result[$current_language];
    } else {
        return $label_key;
    }
}

function getNews($conn, $current_language)
{
    $news = array();
    $query = "SELECT id, title_$current_language AS title, content_$current_language AS content FROM news";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

setcookie('lang', $current_language, time() + (86400 * 30), "/");


?>
<!DOCTYPE html>
<html lang="<?php echo $current_language; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('page_title', $conn, $current_language); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container text-center mt-auto" style="
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction:column">

        <div class="card p-5" style="border-radius:15%">
            <div class="card-body " style="gap: 50px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        ">
                <h1><?php echo translate('welcome_message', $conn, $current_language); ?></h1>

                <div>
                    <h2><?php echo translate('latest_news', $conn, $current_language); ?></h2>
                    <ul class="my-5 text-start">
                        <?php
                        $news = getNews($conn, $current_language);
                        foreach ($news as $article) {
                            echo "<li><strong>{$article['title']}</strong>: {$article['content']}</li>";
                        }
                        ?>
                    </ul>
                    <a href="add_news.php"><button class="btn btn-primary">Aggiungi news</button></a>
                </div>


                <p><?php echo translate('footer_message', $conn, $current_language); ?></p>

            </div>
            <div>
                <form id="language-form" method="post" style="
        display: flex;
        align-items: center;
        gap: 20px;">
                    <label for=" language-select">Seleziona lingua:</label>
                    <select name="lang" id="language-select">
                        <option value="en" <?php echo ($current_language === 'en') ? 'selected' : ''; ?>>English</option>
                        <option value="it" <?php echo ($current_language === 'it') ? 'selected' : ''; ?>>Italiano</option>
                    </select>
                    <input class=" btn btn-success" type="submit" value="Cambia lingua">
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('language-form').addEventListener('submit', function(event) {
            event.preventDefault();

            let selectedLanguage = document.getElementById('language-select').value;


            document.cookie = "lang=" + selectedLanguage + ";path=/";


            window.location.reload();
        });
    </script>
</body>

</html>

<?php
$conn = null;
?>