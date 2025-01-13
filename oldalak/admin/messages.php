<div class="row">
    <div class="col-md-6"><h3>Email</h3></div>
    <div class="col-md-6"><h3>Üzenet</h3></div>
</div>
<?php
$oldalak = sqlcall("SELECT * FROM messages ORDER BY mDate DESC;");
?>
<div id="all-messages" style="display: none;">
    <?php while ($row = $oldalak->fetch_assoc()): ?>
        <div class="message">
            <div class="table row">
                <div class="col-md-3">
                    <p><?php echo $row['mEmail']; ?></p>
                </div>
                <div class="col-md-9">
                    <p><?php echo $row['mUzenet']; ?></p>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<div id="messages-container"></div>
        
<div id="pagination-controls" style="text-align: center; margin-top: 20px;"></div>

<script src="js/uzenetek.js"></script>