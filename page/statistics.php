<?php
    session_start();

?>

<?php include('../partial/top.partial.php'); ?>


<style>
    @import "../css/statistics.css";

    #statistics{
        display: flex;
        flex-direction: column;
        padding: var(--spacing-top-bottom) var(--spacing-left-right);
        margin: auto;
        margin-top: 0;
    }
</style>

<div id="statistics">
    <div>
        <h1>STATISTIK</h1>

        <p>
            aktueller score + platzierung<br>
            statistik des users zurücksetzten
        </p>
    </div>
</div>

<?php include('../partial/bottom.partial.php'); ?>