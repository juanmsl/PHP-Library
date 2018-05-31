<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Libros"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Libros</h1>
            <?php if(USER_IS_ADMIN) { ?>
                <section class="pw-buttons-container">
                    <button class="pw-button" id="create-book">Agregar un libro</button>
                </section>
                <span class="pw-horizontal-line"></span>
            <?php } ?>
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
                            <p class="pw-books-book-item"><?php echo $book->author_name; ?></p>
                            <p class="pw-books-book-item"><?php echo "Editorial " . $book->editorial_name . " - Edición " . $book->edition; ?></p>
                            <p class="pw-books-book-item"><?php echo $book->pages; ?> paginas</p>
                            <p class="pw-books-book-item"><?php echo ($book->quantity - $book->reserved); ?> disponibles</p>
                            <p class="pw-books-book-item">ISBN <?php echo $book->isbn; ?></p>
                            <section class="pw-books-buttons">
                                <?php if($book->quantity - $book->reserved > 0) { ?>
                                    <button 
                                        bookid="<?php  echo $book->id; ?>"
                                        bookname="<?php  echo $book->name; ?>"
                                        class="pw-button select-book thin expanded" target="#modal-reserve-book">Solicitar</button>
                                <?php } ?>
                                <?php if(USER_IS_ADMIN) { ?>
                                    <button bookid="<?php  echo $book->id; ?>" class="pw-button thin transparent expanded delete-book">Eliminar</button>
                                <?php } ?>
                            </section>
                        </arcticle>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "modal_reserve_book.php"); ?>
        <?php include(INCLUDES . "modal_create_book.php"); ?>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
    <script>
        $("#book-category").val("<?php echo $field; ?>");
    </script>
</html>