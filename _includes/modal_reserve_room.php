<section class="pw-modal" id="modal-reserv-room-target">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-reserv-room-target-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" method="POST" action="<?php echo SERVICES . "reserve_room.php"; ?>" id="reserv-form">
            <h1 class="pw-form-title">¿Necesitas una sala?</h1>
            <input type="text" class="pw-form-item" placeholder="Usuario" value="<?php echo USER_NAME; ?>" readonly />
            <input id="form-floor" type="text" class="pw-form-item" placeholder="Piso" readonly />
            <label for="form-date" class="pw-form-label">¿Para cuando nesecitas la reserva?</label>
            <input id="form-date" type="datetime-local" name="time" class="pw-form-item" value="<?php echo $time; ?>" />
            <input type="hidden" name="request-room-form"/>
            <input type="hidden" name="room_id" id="reserve-form-room_id" />
            <output class="pw-form-message" id="reserve-form-room-message"></output>
            <button class="pw-form-button">Solicitar sala</button>
        </form>
    </section>
</section>