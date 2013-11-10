<html>
    <body>
        <p>Hi, <?php echo $obj['owner']->first_name ?></p>
        <p>Someone interested in your apartment</p>
        <p>If you want to get full info, follow this link <a href="<?php echo URL::site('payment/index?hash=' . $obj['sending']->hash ) ?>">Link</a></p>
        <p>References:</p>
        <?php if ($obj['application']->ref_name_1 && $obj['application']->ref_rel_1 && $obj['application']->ref_phone_1 && $obj['application']->ref_email_1): ?>
            <h3>Reference #1:</h3>
            <p>Name: <?php echo $obj['application']->ref_name_1 ?></p>
            <p>Relationship: <?php echo $obj['application']->ref_rel_1 ?></p>
            <p>Phone: <?php echo $obj['application']->ref_phone_1 ?></p>
            <p>Email: <?php echo $obj['application']->ref_email_1 ?></p>
        <?php endif; ?>
        <?php if ($obj['application']->ref_name_2 && $obj['application']->ref_rel_2 && $obj['application']->ref_phone_2 && $obj['application']->ref_email_2): ?>
            <h3>Reference #2:</h3>
            <p>Name: <?php echo $obj['application']->ref_name_2 ?></p>
            <p>Relationship: <?php echo $obj['application']->ref_rel_2 ?></p>
            <p>Phone: <?php echo $obj['application']->ref_phone_2 ?></p>
            <p>Email: <?php echo $obj['application']->ref_email_2 ?></p>
        <?php endif; ?>
        <?php if ($obj['application']->ref_name_3 && $obj['application']->ref_rel_3 && $obj['application']->ref_phone_3 && $obj['application']->ref_email_3): ?>
            <h3>Reference #3:</h3>
            <p>Name: <?php echo $obj['application']->ref_name_3 ?></p>
            <p>Relationship: <?php echo $obj['application']->ref_rel_3 ?></p>
            <p>Phone: <?php echo $obj['application']->ref_phone_3 ?></p>
            <p>Email: <?php echo $obj['application']->ref_email_3 ?></p>
        <?php endif; ?>
        <h3>Current Address:</h3>
        <p>Address: <?php echo $obj['application']->cur_addr ?></p>
        <p>City and Province: <?php echo $obj['application']->cur_city_prov ?></p>
        <p>Post: <?php echo $obj['application']->cur_post ?></p>
        <p>Time at Address: <?php echo $obj['application']->cur_time ?></p>
        <h3>Previous Address:</h3>
        <p>Address: <?php echo $obj['application']->prev_addr ?></p>
        <p>City and Province: <?php echo $obj['application']->prev_city_prov ?></p>
        <p>Post: <?php echo $obj['application']->prev_post ?></p>
        <p>Time at Address: <?php echo $obj['application']->prev_time ?></p>
        <h3>Additional info:</h3>
        <p>Pets: <?php echo $obj['application']->pets ?></p>
        <p>Parking Required: <?php echo $obj['application']->parking ?></p>
        <p>Co-Applicants:  <?php echo $obj['application']->co_app ?></p>
        <p>Additional Occupants:  <?php echo $obj['application']->add_app ?></p>
        <p>Income Source:  <?php echo $obj['application']->source ?></p>
        <p>Other:  <?php echo $obj['application']->missed ?></p>
    </body>
</html>