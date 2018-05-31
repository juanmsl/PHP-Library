<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>">
    <?php $global["TITLE"] .= " - Solicitudes"; ?>
    <?php include(INCLUDES . "head.php") ?>
    <body>
        <?php include(INCLUDES . "navbar.php"); ?>
        <main class="maincontent">
            <h1 class="pw-title">Solicitudes</h1>
            <?php if(count($requests) == 0) { ?>
                <section class="not-found">
                    <h1>No hay solicitudes de prestamo por el momento</h1>
                </section>
            <?php } else { ?>
                <section class="pw-requests-columns">
                    <?php foreach($requests as $item) { ?>
                        <section class="pw-requests-column">
                            <h2 class="pw-subtitle"><?php echo $item["title"] . " (" . $item["data"]->num_rows . ")"; ?></h2>
                            <section class="pw-request-column-content">
                                <?php while($request = $item["data"]->fetch_object()) { ?>
                                    <section class="pw-request">
                                        <form class="pw-form resquest-form" method="POST">
                                            <h6 class="pw-little">Solicitud <?php echo $request->id; ?></h6>
                                            <label class="pw-line"><span class="pw-bold"><?php echo $request->username; ?></span> solicito para el dia</label>
                                            <label class="pw-bold pw-line"><?php echo $request->date_reservation; ?></label>
                                            <input type="hidden" name="aprove-reservation-form" />
                                            <input type="hidden" name="reservation-detail-id" value="<?php echo $request->reservation_detail_id; ?>" />
                                            
                                            <?php if($request->item == "room") { ?>
                                                <label class="pw-line">
                                                    la sala <span class="pw-bold"><?php echo "Piso " . $request->floor_number . " - Sala " . $request->room_number; ?></span>
                                                </label>
                                                <label class="pw-form-label pw-request-top" for="<?php echo $request->item . "-" . $request->id; ?>-time">¿Cuantas <span class="pw-bold">horas</span> de prestamo serán?</label>
                                                <input id="<?php echo $request->item . "-" . $request->id; ?>-time" class="pw-form-item" type="number" name="time" min="1" max="3" value="3" placeholder="Tiempo de prestamo"/>
                                            <?php } else if($request->item == "book") { ?>
                                                <label class="pw-line">
                                                    el libro <span class="pw-bold"><?php echo $request->book_name; ?></span>
                                                </label>
                                                <label class="pw-form-label pw-request-top" for="<?php echo $request->item . "-" . $request->id; ?>-time">¿Cuantos <span class="pw-bold">dias</span> de prestamo serán?</label>
                                                <input id="<?php echo $request->item . "-" . $request->id; ?>-time" class="pw-form-item" type="number" name="time" min="1" max="30" value="15" placeholder="Tiempo de prestamo"/>
                                            <?php } else if($request->item == "equipment") { ?>
                                                <label class="pw-line">
                                                    el equipo <span class="pw-bold"><?php echo $request->equipment_name; ?></span>
                                                </label>
                                                <label class="pw-form-label pw-request-top" for="<?php echo $request->item . "-" . $request->id; ?>-time">¿Cuantas <span class="pw-bold">horas</span> de prestamo serán?</label>
                                                <input id="<?php echo $request->item . "-" . $request->id; ?>-time" class="pw-form-item" type="number" name="time" min="1" max="3" value="3" placeholder="Tiempo de prestamo"/>
                                            <?php } ?>
                                            
                                            <section class="pw-request-buttons">
                                                <button type="submit" class="pw-button thin">Aprobar</button>
                                                <button class="pw-button thin transparent">Denegar</button>
                                            </section>
                                        </form>
                                    </section>
                                <?php } ?>
                            </section>
                        </section>
                    <?php } ?>
                </section>
            <?php } ?>
        </main>
        <?php include(INCLUDES . "footer.php"); ?>
    </body>
    <?php include(INCLUDES . "scripts.php"); ?>
</html>