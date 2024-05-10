<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <style>
        #myform {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;



        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form class="text-center" action="process_form.php" method="post" id="myform">
            <div class="row">
                <div class="col-6">
                    <h1>ADD NEWS (English)</h1>
                    <div class="mb-3">
                        <label for="exampleInputTitleEn" class="form-label">Title (English)</label>
                        <input type="text" class="form-control" id="exampleInputTitleEn" name="title_en" aria-describedby="titleHelpEn">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputContentEn" class="form-label">Content (English)</label>
                        <textarea class="form-control" id="exampleInputContentEn" name="content_en" rows="10" cols="60"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <h1>AGGIUNGI NOTIZIA (Italiano)</h1>
                    <div class="mb-3">
                        <label for="exampleInputTitleIt" class="form-label">Titolo (Italiano)</label>
                        <input type="text" class="form-control" id="exampleInputTitleIt" name="title_it" aria-describedby="titleHelpIt">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputContentIt" class="form-label">Contenuto (Italiano)</label>
                        <textarea class="form-control" id="exampleInputContentIt" name="content_it" rows="10" cols="60"></textarea>
                    </div>
                </div>
                <div><button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        <a href="index.php"> <button class="btn btn-primary">HOME</button></a>

    </div>

</body>

</html>