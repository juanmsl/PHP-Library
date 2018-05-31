<section class="pw-modal" id="modal-reserve-equipment">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-reserve-equipment-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" id="modal-reserve-equipment-form">
            <h1 class="pw-form-title">¿Necesitas este equipo?</h1>
            <input type="text" class="pw-form-item" placeholder="Usuario" value="<?php echo USER_NAME; ?>" readonly />
            <input type="text" id="modal-reserve-equipment-form-name" class="pw-form-item" placeholder="Equipo" readonly />
            <label for="form-date" class="pw-form-label">¿Para cuando nesecitas el equipo?</label>
            <input id="form-date" type="date" name="time" class="pw-form-item" value="<?php echo $time; ?>" />
            <input type="hidden" name="request-equipment-form"/>
            <input type="hidden" name="equipment_id" id="modal-reserve-equipment-form-id" />
            <output class="pw-form-message" id="modal-reserve-equipment-message-form"></output>
            <button class="pw-form-button">Solicitar equipo</button>
        </form>
    </section>
</section>