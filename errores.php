<?php if (!empty($errores)) { ?>
    <div class="mensaje-error">
        <ul >
        <?php foreach($errores as $error) { ?>
            <li>
                <?= $error ?>
            </li>
        <?php } ?>
        </ul>
    </div>
<?php } ?>