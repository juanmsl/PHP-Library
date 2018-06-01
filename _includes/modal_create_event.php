<section class="pw-modal" id="modal-create-event-target">
    <span class="pw-modal-close pwi pwi-times-circle" id="modal-create-event-target-close"></span>
    <section class="pw-form-container">
        <form class="pw-form" id="create-event-form">
            <h1 class="pw-form-title">Agregar un evento</h1>
            <input type="text" name="name" class="pw-form-item" placeholder="Nombre del evento" required />
            <input type="datetime-local" name="date" class="pw-form-item" placeholder="Fecha" required />
            <input type="text" name="place" class="pw-form-item" placeholder="Lugar" required />
            <input type="number" name="guest_number" class="pw-form-item" placeholder="No# invitados" required />
            
            <input type="hidden" name="create-event-form"/>
            <output class="pw-form-message" id="create-event-form-message"></output>
            <button class="pw-form-button">Crear evento</button>
        </form>
    </section>
</section>