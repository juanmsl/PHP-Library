<section class="pw-modal" id="modal-reserve-book">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-reserve-book-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" id="modal-reserve-book-form">
            <h1 class="pw-form-title">¿Necesitas este libro?</h1>
            <input type="text" class="pw-form-item" placeholder="Usuario" value="<?php echo USER_NAME; ?>" readonly />
            <input type="text" id="modal-reserve-book-form-name" class="pw-form-item" placeholder="Libro" readonly />
            <label for="form-date" class="pw-form-label">¿Para cuando nesecitas el libro?</label>
            <input id="form-date" type="date" name="time" class="pw-form-item" value="<?php echo $time; ?>" />
            <input type="hidden" name="request-book-form"/>
            <input type="hidden" name="book_id" id="modal-reserve-book-form-id" />
            <output class="pw-form-message" id="modal-reserve-book-message-form"></output>
            <button class="pw-form-button">Solicitar libro</button>
        </form>
    </section>
</section>