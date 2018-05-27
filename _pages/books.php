<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Libros"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Libros</h1>
            <form method="GET" class="pw-form inline">
                <section class="pw-form-fields">
                    <input type="text" name="search" class="pw-form-item" value="<?php echo $value; ?>" placeholder="Busqueda"/>
                    <select name="category" class="pw-form-item" id="book-category">
                        <option value="">Categoria</option>
                        <option value="name">Nombre</option>
                        <option value="author">Author</option>
                        <option value="editorial">Editorial</option>
                        <option value="edition">Edición</option>
                        <option value="pages">Paginas</option>
                        <option value="isbn">ISBN</option>
                    </select>
                </section>
                <button type="submit" class="pw-form-button pw-form-center" name="search-book">Buscar</button>
            </form>
            <?php if($books->num_rows == 0) { ?>
                <section class="not-found">
                    <h1>No se encontraron libros registrados</h1>
                </section>
            <?php } else { ?>
                <section class="pw-books-gallery">
                    <?php while($book = $books->fetch_object()) { ?>
                        <arcticle class="pw-books-book">
                            <h4 class="pw-books-book-name"><?php echo $book->name; ?></h4>
                            <p class="pw-books-book-item"><?php echo $book->author_surnames . " " . $book->author_names; ?></p>
                            <p class="pw-books-book-item"><?php echo "Editorial " . $book->editorial . " - Edición " . $book->edition; ?></p>
                            <p class="pw-books-book-item"><?php echo $book->pages; ?> paginas</p>
                            <p class="pw-books-book-item"><?php echo $book->quantity; ?> disponibles</p>
                            <p class="pw-books-book-item">ISBN <?php echo $book->isbn; ?></p>
                            <button class="pw-button thin expanded">Solicitar</button>
                        </arcticle>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
    <script>
        $("#book-category").val("<?php echo $field; ?>");
    </script>
</html>