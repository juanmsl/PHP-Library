<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Salas"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Salas</h1>
            <form class="pw-form inline pw-room-serch-form" method="GET">
                <section class="pw-room-fields">
                    <input type="datetime-local" name="time" class="pw-form-item" value="<?php echo $time; ?>" />
                    <section class="pw-room-selects">
                        <select name="tv" class="pw-form-item" id="room-form-tv">
                            <option value="n">Con/Sin televisor</option>
                            <option value="1">Con televisor</option>
                            <option value="0">Sin televisor</option>
                        </select>
                        <select name="available" class="pw-form-item" id="room-form-available">
                            <option value="n">Disponible/No disponible</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                    </section>
                </section>
                <button type="submit" class="pw-form-button pw-form-center" name="find-room-form">Buscar</button>
            </form>
            <?php foreach ($roomsFloors as $rooms) { ?>
                <h2>Piso <?php echo $rooms["floor_number"]; ?></h2>
                <section class="pw-floor-rooms">
                    <?php while ($room = $rooms["floor_rooms"]->fetch_object()) {?>
                        <section class="pw-floor-room">
                            <span>Sala <?php echo $room->room_number; ?></span>
                            <span>
                                <span class="pwi pwi-television <?php echo ($room->tv ? "pw-green" : "pw-red");?>"></span>
                                <?php echo ($room->tv ? "Con" : "Sin");?> televisor
                            </span>
                            <span>
                                <span class="pwi pwi-<?php echo ($room->available ? "check-circle-o pw-green" : "times-circle-o pw-red");?>"></span>
                                 <?php echo ($room->available ? "Disponible" : "No disponible");?>
                            </span>
                            
                            <?php if($room->available) { ?>
                                <button class="pw-button thin transparent modal-reserve-room"
                                    room_id="<?php echo $room->room_id; ?>"
                                    floor_number="<?php echo $rooms["floor_number"]; ?>"
                                    room_number="<?php echo $room->room_number; ?>">Reservar</button>
                            <?php } ?>
                        </section>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "modal_reserve_room.php"); ?>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
    <script>
        $("#room-form-tv").val("<?php echo $tv; ?>");
        $("#room-form-available").val("<?php echo $available; ?>");
    </script>
</html>