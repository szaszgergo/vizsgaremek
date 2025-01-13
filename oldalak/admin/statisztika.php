<div style="margin-bottom: 20px; text-align: center;">
    <a href="?o=admin&a=statisztika&tp=napi" class="btn btn-warning">Napi látogatottság</a>
    <a href="?o=admin&a=statisztika&tp=oldalak" class="btn btn-warning">Top oldalak</a>
    <a href="?o=admin&a=statisztika&tp=termekek" class="btn btn-warning">Top termékek</a>
</div>

<?php
$tp = isset($_GET['tp']) ? $_GET['tp'] : 'napi';
?>

<?php if ($tp === 'napi'): ?>
    <?php
    $latogatottsag = sqlcall("SELECT DATE(nDatum) AS date, COUNT(DISTINCT nSession) AS latogatas FROM `naplo` GROUP BY DATE(nDatum) ORDER BY date;");
    $labels = [];
    $data = [];

    while ($row = $latogatottsag->fetch_assoc()) {
        $labels[] = $row['date'];
        $data[] = $row['latogatas'];
    }
    ?>
    <h1>Napi látogatottság:</h1>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div style="width: 80%; margin: auto;">
        <canvas id="visitsChart"></canvas>
    </div>

    <script>
        const labels = <?php echo json_encode($labels); ?>;
        const data = <?php echo json_encode($data); ?>;
        const ctx = document.getElementById('visitsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Daily Visits',
                    data: data,
                    borderColor: 'rgba(255, 193, 7, 1)',
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Visits'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
<?php endif; ?>

<?php if ($tp === 'oldalak' || $tp === 'termekek'): ?>
    <div id="all-statistics" style="display: none;">
        <?php
        if ($tp === 'oldalak') {
            $query = "SELECT nURL, COUNT(nURL) as count FROM `naplo` GROUP BY nURL ORDER BY count DESC;";
        } elseif ($tp === 'termekek') {
            $query = "SELECT nURL, COUNT(nURL) as count FROM `naplo` WHERE nURL LIKE '%termek%' GROUP BY nURL ORDER BY count DESC;";
        }
        $oldalak = sqlcall($query);

        while ($row = $oldalak->fetch_assoc()):
            if ($tp === 'termekek') {
                parse_str(parse_url($row['nURL'], PHP_URL_QUERY), $queryParams);
                $id = isset($queryParams['id']) ? intval($queryParams['id']) : null;
                if ($id) {
                    $termekQuery = sqlcall("SELECT teNev FROM termekek WHERE teID = $id");
                    $termek = $termekQuery->fetch_assoc();
                    $termeknev = $termek ? $termek['teNev'] : 'Ismeretlen termék';
                } else {
                    $termeknev = 'Ismeretlen termék';
                }
            }
        ?>
            <div class="stat-item">
                <div class="row">
                    <?php if ($tp === 'termekek'): ?>
                        <div class="col-md-6"><p><?php echo htmlspecialchars($termeknev); ?></p></div>
                    <?php else: ?>
                        <div class="col-md-6"><p><?php echo htmlspecialchars($row['nURL']); ?></p></div>
                    <?php endif; ?>
                    <div class="col-md-6"><p><?php echo $row['count']; ?> látogatás</p></div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <div id="statistics-container"></div>
    <div id="pagination-controls" style="text-align: center; margin-top: 20px;"></div>
    <script src="js/statisztika.js"></script>
<?php endif; ?>
