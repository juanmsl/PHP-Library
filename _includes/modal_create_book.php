<section class="pw-modal" id="modal-create-book-target">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-create-book-target-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" id="create-book-form">
            <h1 class="pw-form-title">Agregar un libro</h1>
            <input type="text" name="name" class="pw-form-item" placeholder="Nombre del libro" required />
            <input type="number" name="edition" class="pw-form-item" placeholder="No# de edición" required />
            <input type="number" name="pages" class="pw-form-item" placeholder="No# de paginas" required />
            <input type="number" name="isbn" class="pw-form-item" placeholder="ISBN" required />
            <select name="editorial_id" id="" class="pw-form-item" required>
                <option value="">Editorial</option>
                <?php while($editorial = $editorials->fetch_object()) { ?>
                    <option value="<?php echo $editorial->id; ?>"><?php echo $editorial->name; ?></option>
                <?php } ?>
                <option value="other">Nueva editorial</option>
            </select>
            <input type="text" name="editorial_name" class="pw-form-item" placeholder="Nueva editorial" />
            <select name="author_id" id="" class="pw-form-item" required>
                <option value="">Autor</option>
                <?php while($author = $authors->fetch_object()) { ?>
                    <option value="<?php echo $author->id; ?>"><?php echo $author->name; ?></option>
                <?php } ?>
                <option value="other">Nuevo autor</option>
            </select>
            <input type="text" name="author_name" class="pw-form-item" placeholder="Nuevo autor" />
            <input type="number" name="quantity" class="pw-form-item" placeholder="Cantidad de copias" required />
            
            <input type="hidden" name="create-book-form"/>
            <output class="pw-form-message" id="create-book-form-message"></output>
            <button class="pw-form-button">Crear libro</button>
        </form>
    </section>
</section>