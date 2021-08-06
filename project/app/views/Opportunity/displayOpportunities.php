<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
    <?php else : ?>
          
         <h1>Your Opportunities</h1>

        <?php if (count($data) > 0): ?>
            <table class="table table-hovrt table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                    <th>Lead id</th>
                    <th>Stage id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Probability</th>
                    <th>Close date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tbody>
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
                <td><?php echo implode('</td><td>', $row); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
                    </tbody>
            </table>
            
       
<?php endif; ?>

<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';